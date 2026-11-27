(() => {
    const dialog = document.getElementById('site-notice-dialog');
    if (!dialog || typeof dialog.showModal !== 'function') return;

    const storageKey = 'faith-site-notices-dismissed';
    const signature = dialog.dataset.noticeSignature;
    let storageAvailable = true;

    try {
        if (window.sessionStorage.getItem(storageKey) === signature) return;
    } catch (error) {
        if (!(error instanceof DOMException) || error.name !== 'SecurityError') throw error;
        storageAvailable = false;
    }

    const cards = [...dialog.querySelectorAll('[data-notice-card]')];
    let currentIndex = 0;
    let pdfJsPromise;

    const setOrientation = (orientation) => {
        dialog.dataset.noticeOrientation = orientation;
    };

    const reportPdfFailure = (preview) => {
        const status = preview.querySelector('[data-pdf-status]');
        status.textContent = 'PDF preview unavailable. Open the full PDF to view it.';
        status.setAttribute('role', 'alert');
        preview.dataset.failed = 'true';
        console.error('Site notice PDF preview failed to load.');
    };

    const loadPdfJs = () => {
        if (!pdfJsPromise) {
            pdfJsPromise = import('../vendor/pdfjs/pdf.min.mjs').then((pdfjs) => {
                pdfjs.GlobalWorkerOptions.workerSrc = new URL('../vendor/pdfjs/pdf.worker.min.mjs', import.meta.url).href;
                return pdfjs;
            });
        }
        return pdfJsPromise;
    };

    const initializePdfPreview = async (preview) => {
        if (preview.dataset.initialized || preview.dataset.failed) return;
        preview.dataset.initialized = 'true';

        const canvas = preview.querySelector('[data-pdf-canvas]');
        const pageArea = preview.querySelector('[data-pdf-page]');
        const pageStatus = preview.querySelector('[data-pdf-status]');
        const previousButton = preview.querySelector('[data-pdf-previous]');
        const nextButton = preview.querySelector('[data-pdf-next]');
        const thumbnailsToggle = preview.querySelector('[data-pdf-thumbnails-toggle]');
        const thumbnailsPanel = preview.querySelector('[data-pdf-thumbnails]');
        const card = preview.closest('[data-notice-card]');

        try {
            const pdfjs = await loadPdfJs();
            const pdf = await pdfjs.getDocument({
                url: preview.dataset.pdfUrl,
                cMapUrl: new URL('../vendor/pdfjs/cmaps/', import.meta.url).href,
                cMapPacked: true,
                standardFontDataUrl: new URL('../vendor/pdfjs/standard_fonts/', import.meta.url).href,
                wasmUrl: new URL('../vendor/pdfjs/wasm/', import.meta.url).href,
                isEvalSupported: false,
            }).promise;

            let currentPage = 1;
            let activeRenderTask = null;
            let renderRequest = 0;
            const thumbnailButtons = [];
            const thumbnailObserver = 'IntersectionObserver' in window
                ? new IntersectionObserver((entries) => {
                    entries.filter((entry) => entry.isIntersecting).forEach((entry) => {
                        const button = entry.target;
                        thumbnailObserver.unobserve(button);
                        void renderThumbnail(Number(button.dataset.pdfThumbnail)).catch(() => reportPdfFailure(preview));
                    });
                }, { root: thumbnailsPanel, rootMargin: '80px' })
                : null;

            const updatePageControls = (rendered = true) => {
                previousButton.disabled = currentPage <= 1;
                nextButton.disabled = currentPage >= pdf.numPages;
                pageStatus.textContent = rendered
                    ? `Page ${currentPage} of ${pdf.numPages}`
                    : `Loading page ${currentPage} of ${pdf.numPages}…`;
                canvas.setAttribute('aria-label', `PDF page ${currentPage} of ${pdf.numPages}`);
                thumbnailButtons.forEach((button, index) => {
                    if (index + 1 === currentPage) {
                        button.setAttribute('aria-current', 'page');
                    } else {
                        button.removeAttribute('aria-current');
                    }
                });
            };

            const renderPage = async (pageNumber) => {
                const request = ++renderRequest;
                const page = await pdf.getPage(pageNumber);
                if (request !== renderRequest) return;

                const baseViewport = page.getViewport({ scale: 1 });
                const orientation = baseViewport.width > baseViewport.height ? 'landscape' : 'portrait';
                preview.dataset.pageOrientation = orientation;
                if (cards[currentIndex] === card) setOrientation(orientation);
                currentPage = pageNumber;
                updatePageControls(false);

                const area = pageArea.getBoundingClientRect();
                const scale = area.width / baseViewport.width;
                if (!Number.isFinite(scale) || scale <= 0) return;

                const viewport = page.getViewport({ scale });
                const pixelRatio = Math.min(window.devicePixelRatio || 1, 2);
                if (activeRenderTask) {
                    const previousTask = activeRenderTask;
                    activeRenderTask = null;
                    previousTask.cancel();
                    try {
                        await previousTask.promise;
                    } catch (error) {
                        if (error.name !== 'RenderingCancelledException') throw error;
                    }
                }
                if (request !== renderRequest) return;

                const context = canvas.getContext('2d');
                canvas.width = Math.ceil(viewport.width * pixelRatio);
                canvas.height = Math.ceil(viewport.height * pixelRatio);
                canvas.style.width = `${viewport.width}px`;
                canvas.style.height = `${viewport.height}px`;

                const task = page.render({
                    canvasContext: context,
                    viewport,
                    transform: [pixelRatio, 0, 0, pixelRatio, 0, 0],
                });
                activeRenderTask = task;

                try {
                    await task.promise;
                } catch (error) {
                    if (error.name === 'RenderingCancelledException') return;
                    throw error;
                }

                if (activeRenderTask === task) activeRenderTask = null;
                if (request !== renderRequest) return;
                updatePageControls();
            };

            const renderThumbnail = async (pageNumber) => {
                const button = thumbnailButtons[pageNumber - 1];
                const thumbnailCanvas = button.querySelector('canvas');
                if (thumbnailCanvas.dataset.rendered) return;

                const page = await pdf.getPage(pageNumber);
                const baseViewport = page.getViewport({ scale: 1 });
                const scale = Math.min(88 / baseViewport.width, 112 / baseViewport.height);
                const viewport = page.getViewport({ scale });
                const context = thumbnailCanvas.getContext('2d');
                thumbnailCanvas.width = Math.ceil(viewport.width);
                thumbnailCanvas.height = Math.ceil(viewport.height);
                await page.render({ canvasContext: context, viewport }).promise;
                thumbnailCanvas.dataset.rendered = 'true';
            };

            const addThumbnailButtons = () => {
                const fragment = document.createDocumentFragment();
                for (let pageNumber = 1; pageNumber <= pdf.numPages; pageNumber += 1) {
                    const button = document.createElement('button');
                    button.className = 'site-notice-pdf-thumbnail';
                    button.type = 'button';
                    button.dataset.pdfThumbnail = String(pageNumber);
                    button.setAttribute('aria-label', `Go to PDF page ${pageNumber}`);

                    const thumbnailCanvas = document.createElement('canvas');
                    thumbnailCanvas.setAttribute('aria-hidden', 'true');
                    const label = document.createElement('span');
                    label.textContent = `Page ${pageNumber}`;
                    button.append(thumbnailCanvas, label);
                    button.addEventListener('click', () => {
                        void renderPage(pageNumber).catch(() => reportPdfFailure(preview));
                        button.scrollIntoView({ block: 'nearest' });
                    });
                    thumbnailButtons.push(button);
                    fragment.append(button);
                }
                thumbnailsPanel.replaceChildren(fragment);
            };

            const renderVisibleThumbnails = () => {
                if (thumbnailObserver) {
                    thumbnailButtons.forEach((button) => thumbnailObserver.observe(button));
                    return;
                }

                const panelBounds = thumbnailsPanel.getBoundingClientRect();
                thumbnailButtons.forEach((button) => {
                    const bounds = button.getBoundingClientRect();
                    if (bounds.bottom >= panelBounds.top && bounds.top <= panelBounds.bottom) {
                        void renderThumbnail(Number(button.dataset.pdfThumbnail)).catch(() => reportPdfFailure(preview));
                    }
                });
            };

            previousButton.addEventListener('click', () => {
                if (currentPage > 1) void renderPage(currentPage - 1).catch(() => reportPdfFailure(preview));
            });
            nextButton.addEventListener('click', () => {
                if (currentPage < pdf.numPages) void renderPage(currentPage + 1).catch(() => reportPdfFailure(preview));
            });
            thumbnailsToggle.addEventListener('click', () => {
                const showThumbnails = thumbnailsToggle.getAttribute('aria-expanded') !== 'true';
                thumbnailsToggle.setAttribute('aria-expanded', String(showThumbnails));
                thumbnailsToggle.textContent = showThumbnails ? 'Hide pages' : 'Show pages';
                preview.dataset.thumbnailsOpen = String(showThumbnails);
                thumbnailsPanel.hidden = !showThumbnails;
                if (showThumbnails) renderVisibleThumbnails();
            });
            thumbnailsPanel.addEventListener('scroll', renderVisibleThumbnails, { passive: true });

            addThumbnailButtons();
            await renderPage(currentPage);
            thumbnailsToggle.disabled = false;
            if ('ResizeObserver' in window) {
                const resizeObserver = new ResizeObserver(() => {
                    void renderPage(currentPage).catch(() => reportPdfFailure(preview));
                });
                resizeObserver.observe(pageArea);
            }
        } catch {
            reportPdfFailure(preview);
        }
    };

    const showCard = () => {
        cards.forEach((card, cardIndex) => {
            card.hidden = cardIndex !== currentIndex;
        });
        const card = cards[currentIndex];
        const heading = card.querySelector('h2');
        dialog.setAttribute('aria-labelledby', heading.id);
        delete dialog.dataset.noticeOrientation;

        const image = card.querySelector('.site-notice-image');
        if (image) {
            const setImageOrientation = () => {
                if (cards[currentIndex] !== card || !image.naturalWidth || !image.naturalHeight) return;
                setOrientation(image.naturalWidth > image.naturalHeight ? 'landscape' : 'portrait');
            };
            if (image.complete) setImageOrientation();
            else image.addEventListener('load', setImageOrientation, { once: true });
        }

        const pdfPreview = card.querySelector('[data-pdf-preview]');
        if (pdfPreview) void initializePdfPreview(pdfPreview);
    };

    const openCurrentCard = () => {
        showCard();
        dialog.showModal();
    };

    dialog.querySelector('[data-notice-close]').addEventListener('click', () => dialog.close());
    dialog.addEventListener('click', (event) => {
        if (event.target === dialog) dialog.close();
    });
    dialog.addEventListener('close', () => {
        if (currentIndex < cards.length - 1) {
            currentIndex += 1;
            requestAnimationFrame(openCurrentCard);
            return;
        }

        if (!storageAvailable) return;
        try {
            window.sessionStorage.setItem(storageKey, signature);
        } catch (error) {
            if (!(error instanceof DOMException) || error.name !== 'SecurityError') throw error;
        }
    });

    openCurrentCard();
})();
