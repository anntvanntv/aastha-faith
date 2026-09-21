document.addEventListener('DOMContentLoaded', () => {
    const viewer = document.querySelector('.pdf-viewer');
    if (!viewer) return;

    const PDFJS = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@3.11.174';
    const PAGEFLIP = 'https://cdn.jsdelivr.net/npm/page-flip@2.0.7/dist/js/page-flip.browser.min.js';

    const loadScript = (src) => new Promise((resolve, reject) => {
        const s = document.createElement('script');
        s.src = src;
        s.onload = resolve;
        s.onerror = reject;
        document.head.appendChild(s);
    });

    let libsPromise = null;
    const loadLibs = () => libsPromise ||= Promise.all([
        loadScript(`${PDFJS}/build/pdf.min.js`),
        loadScript(PAGEFLIP),
    ]).then(() => {
        window.pdfjsLib.GlobalWorkerOptions.workerSrc = `${PDFJS}/build/pdf.worker.min.js`;
    });

    const book = viewer.querySelector('.pdf-book');
    const thumbsRail = viewer.querySelector('.pdf-thumbs');
    const loading = viewer.querySelector('.pdf-viewer-loading');
    const loadingText = loading.querySelector('span');
    const pageInput = viewer.querySelector('.pdf-page-input');
    const prevBtn = viewer.querySelector('.pdf-prev');
    const nextBtn = viewer.querySelector('.pdf-next');
    const firstBtn = viewer.querySelector('.pdf-first');
    const lastBtn = viewer.querySelector('.pdf-last');
    const zoomInBtn = viewer.querySelector('.pdf-zoom-in');
    const zoomOutBtn = viewer.querySelector('.pdf-zoom-out');
    const fullscreenBtn = viewer.querySelector('.pdf-fullscreen');
    const thumbsToggle = viewer.querySelector('.pdf-thumbs-toggle');
    const soundBtn = viewer.querySelector('.pdf-sound');
    const shareBtn = viewer.querySelector('.pdf-share');
    const moreToggle = viewer.querySelector('.pdf-more-toggle');
    const moreMenu = viewer.querySelector('.pdf-more-menu');

    const ICON_SOUND_ON = '<svg viewBox="0 0 24 24"><polygon points="11 5 6 9 3 9 3 15 6 15 11 19" fill="currentColor" stroke="none"/><path d="M15.5 8.5a5 5 0 0 1 0 7"/><path d="M18.5 5.5a9 9 0 0 1 0 13"/></svg>';
    const ICON_SOUND_OFF = '<svg viewBox="0 0 24 24"><polygon points="11 5 6 9 3 9 3 15 6 15 11 19" fill="currentColor" stroke="none"/><line x1="15" y1="9" x2="21" y2="15"/><line x1="21" y1="9" x2="15" y2="15"/></svg>';
    soundBtn.innerHTML = ICON_SOUND_ON;

    let flip = null;
    let pageW = 0;
    let pageH = 0;
    let zoom = 1;
    let panX = 0;
    let panY = 0;
    let dragging = null;
    let soundOn = true;
    let audioCtx = null;

    // rustled noise with flutter approximating a newspaper page turn
    function playFlipSound() {
        if (!soundOn) return;
        audioCtx ||= new (window.AudioContext || window.webkitAudioContext)();
        const t = audioCtx.currentTime;
        const dur = 0.3;
        const sr = audioCtx.sampleRate;

        // bake the rustle into the samples: noise with soft random flutters
        const buf = audioCtx.createBuffer(1, sr * dur, sr);
        const data = buf.getChannelData(0);
        let env = 0;
        for (let i = 0; i < data.length; i++) {
            const p = i / data.length;
            // soft attack, even decay — no harsh spike
            const shape = Math.min(1, p / 0.15) * Math.exp(-p * 3.5);
            // heavily smoothed flutter = gentle paper texture, not crackle
            env = env * 0.94 + Math.random() * 0.06;
            data[i] = (Math.random() * 2 - 1) * shape * (0.4 + 0.7 * env);
        }

        const src = audioCtx.createBufferSource();
        src.buffer = buf;

        // darker band keeps it papery instead of hissy
        const bp = audioCtx.createBiquadFilter();
        bp.type = 'bandpass';
        bp.Q.value = 0.5;
        bp.frequency.setValueAtTime(2600, t);
        bp.frequency.exponentialRampToValueAtTime(600, t + dur);

        const gain = audioCtx.createGain();
        gain.gain.value = 0.35;

        src.connect(bp).connect(gain).connect(audioCtx.destination);
        src.start(t);
    }

    function centerBook() {
        if (!flip) return;
        const total = flip.getPageCount();
        const current = flip.getCurrentPageIndex();
        let shift = 0;
        // cover page renders in the right slot of the spread; a lone last
        // page (even page count) renders in the left slot — shift to center
        if (current === 0) shift = -pageW / 2;
        else if (current === total - 1 && total % 2 === 0) shift = pageW / 2;
        book.style.transform = `translate(${shift + panX}px, ${panY}px) scale(${zoom})`;
        book.classList.toggle('zoomed', zoom > 1);
    }

    // clamp pan so the zoomed book can't be dragged fully off-stage
    function clampPan() {
        const stage = viewer.querySelector('.pdf-viewer-stage');
        const r = stage.getBoundingClientRect();
        const maxX = Math.max(0, (pageW * 2 * zoom - r.width) / 2 + pageW * zoom * 0.5);
        const maxY = Math.max(0, (pageH * zoom - r.height) / 2 + 80);
        panX = Math.min(maxX, Math.max(-maxX, panX));
        panY = Math.min(maxY, Math.max(-maxY, panY));
    }

    function updateNav() {
        if (!flip) return;
        const current = flip.getCurrentPageIndex();
        const total = flip.getPageCount();
        pageInput.value = `${current + 1}/${total}`;
        prevBtn.disabled = current <= 0;
        nextBtn.disabled = current >= total - 1;
        firstBtn.disabled = current <= 0;
        lastBtn.disabled = current >= total - 1;
        centerBook();
        thumbsRail.querySelectorAll('img').forEach((img, i) => {
            img.classList.toggle('active', i === current || i === current + 1);
        });
    }

    async function openViewer(url, title) {
        viewer.hidden = false;
        document.body.style.overflow = 'hidden';
        viewer.querySelector('.pdf-viewer-title').textContent = title;
        viewer.querySelector('.pdf-viewer-download').href = url;
        book.innerHTML = '';
        thumbsRail.innerHTML = '';
        viewer.classList.remove('thumbs-open');
        zoom = 1;
        panX = panY = 0;
        loading.style.display = 'flex';
        loadingText.textContent = 'Loading PDF…';
        pageInput.value = '';

        try {
            await loadLibs();
            const doc = await window.pdfjsLib.getDocument(url).promise;
            const numPages = doc.numPages;

            const first = await doc.getPage(1);
            const vp = first.getViewport({ scale: 1 });
            const pageRatio = vp.width / vp.height;

            const stage = viewer.querySelector('.pdf-viewer-stage');
            const stageRect = stage.getBoundingClientRect();
            let pageWCalc = Math.min(stageRect.width / 2 - 20, (stageRect.height - 20) * pageRatio);
            if (stageRect.width < 700) {
                pageWCalc = Math.min(stageRect.width - 40, (stageRect.height - 20) * pageRatio);
            }
            pageW = pageWCalc;
            pageH = pageW / pageRatio;

            const renderScale = (pageW * Math.min(window.devicePixelRatio || 1, 2)) / vp.width;
            const pages = [];
            for (let i = 1; i <= numPages; i++) {
                const page = await doc.getPage(i);
                const viewport = page.getViewport({ scale: Math.max(renderScale, 1) });
                const canvas = document.createElement('canvas');
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;
                pages.push(canvas);

                const thumb = document.createElement('img');
                thumb.src = canvas.toDataURL('image/jpeg', 0.5);
                thumb.alt = `Page ${i}`;
                thumb.dataset.page = i - 1;
                thumbsRail.appendChild(thumb);
                loadingText.textContent = `Loading PDF… ${i}/${numPages}`;
            }

            flip = new St.PageFlip(book, {
                width: pageW,
                height: pageH,
                size: 'fixed',
                autoSize: false,
                usePortrait: false,
                showCover: true,
                maxShadowOpacity: 0.4,
                mobileScrollSupport: false,
            });
            flip.loadFromHTML(pages);
            flip.on('flip', () => { updateNav(); playFlipSound(); });
            loading.style.display = 'none';
            updateNav();
        } catch (err) {
            loadingText.textContent = 'Could not load PDF';
            console.error(err);
        }
    }

    function closeViewer() {
        viewer.hidden = true;
        document.body.style.overflow = '';
        if (flip) {
            try { flip.destroy(); } catch (e) { /* ui may not exist if closed mid-load */ }
            flip = null;
            // PageFlip.destroy() removes the .pdf-book element itself — re-attach it
            viewer.querySelector('.pdf-viewer-stage').prepend(book);
        }
        book.innerHTML = '';
        thumbsRail.innerHTML = '';
        zoom = 1;
        panX = panY = 0;
        if (document.fullscreenElement) document.exitFullscreen();
    }

    document.querySelectorAll('.publication-card').forEach((card) => {
        card.addEventListener('click', (e) => {
            if (e.target.closest('a')) return;
            const url = card.dataset.pdf;
            if (!url) return;
            const title = card.querySelector('.publication-info h4')?.textContent.trim() || '';
            openViewer(url, title);
        });
    });

    viewer.querySelector('.pdf-viewer-backdrop').addEventListener('click', closeViewer);
    viewer.querySelector('.pdf-viewer-close').addEventListener('click', closeViewer);
    prevBtn.addEventListener('click', () => flip && flip.flipPrev());
    nextBtn.addEventListener('click', () => flip && flip.flipNext());
    firstBtn.addEventListener('click', () => flip && flip.flip(0, 'top'));
    lastBtn.addEventListener('click', () => flip && flip.flip(flip.getPageCount() - 1, 'bottom'));

    zoomInBtn.addEventListener('click', () => {
        zoom = Math.min(zoom + 0.25, 2.5);
        centerBook();
    });
    zoomOutBtn.addEventListener('click', () => {
        zoom = Math.max(zoom - 0.25, 1);
        if (zoom === 1) panX = panY = 0;
        clampPan();
        centerBook();
    });

    // drag to pan when zoomed (capture phase so PageFlip doesn't flip)
    book.addEventListener('pointerdown', (e) => {
        if (zoom <= 1) return;
        e.stopPropagation();
        e.preventDefault();
        dragging = { x: e.clientX, y: e.clientY, panX, panY };
        book.setPointerCapture(e.pointerId);
        book.classList.add('dragging');
    }, true);
    book.addEventListener('pointermove', (e) => {
        if (!dragging) return;
        panX = dragging.panX + (e.clientX - dragging.x);
        panY = dragging.panY + (e.clientY - dragging.y);
        clampPan();
        centerBook();
    });
    const endDrag = () => { dragging = null; book.classList.remove('dragging'); };
    book.addEventListener('pointerup', endDrag);
    book.addEventListener('pointercancel', endDrag);
    fullscreenBtn.addEventListener('click', () => {
        if (document.fullscreenElement) document.exitFullscreen();
        else viewer.requestFullscreen();
    });
    thumbsToggle.addEventListener('click', () => {
        viewer.classList.toggle('thumbs-open');
    });
    soundBtn.addEventListener('click', () => {
        soundOn = !soundOn;
        soundBtn.classList.toggle('muted', !soundOn);
        soundBtn.innerHTML = soundOn ? ICON_SOUND_ON : ICON_SOUND_OFF;
    });
    shareBtn.addEventListener('click', () => {
        const url = viewer.querySelector('.pdf-viewer-download').href;
        navigator.clipboard?.writeText(url).then(() => {
            shareBtn.classList.add('copied');
            setTimeout(() => shareBtn.classList.remove('copied'), 1200);
        });
    });
    moreToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        moreMenu.hidden = !moreMenu.hidden;
    });
    viewer.addEventListener('click', (e) => {
        if (!e.target.closest('.pdf-more')) moreMenu.hidden = true;
    });
    pageInput.addEventListener('keydown', (e) => {
        if (e.key !== 'Enter' || !flip) return;
        const n = parseInt(pageInput.value, 10);
        if (n >= 1 && n <= flip.getPageCount()) flip.flip(n - 1, 'top');
        else updateNav();
    });
    thumbsRail.addEventListener('click', (e) => {
        const img = e.target.closest('img');
        if (img && flip) flip.flip(parseInt(img.dataset.page, 10), 'top');
    });

    document.addEventListener('keydown', (e) => {
        if (viewer.hidden) return;
        if (e.key === 'Escape') closeViewer();
        if (e.key === 'ArrowLeft') flip && flip.flipPrev();
        if (e.key === 'ArrowRight') flip && flip.flipNext();
    });
});
