// sidebar news list: live search + date filters (same behavior as /news/ archive)
document.addEventListener("DOMContentLoaded", () => {
    const items = document.querySelectorAll(".onenews .news-side-item");
    if (!items.length) return;

    const form = document.querySelector(".onenews .news-side .news-search");
    const input = form?.querySelector("input[name='q']");
    const filterBtns = document.querySelectorAll(".onenews .news-side .news-filter");
    const allBtn = document.querySelector(".onenews .news-side .news-all");
    const DAY = 864e5;

    let activeRange = "all";

    const applyFilters = () => {
        const q = input ? input.value.trim().toLowerCase() : "";
        const now = new Date();
        const todayStart = new Date(now.getFullYear(), now.getMonth(), now.getDate()).getTime();

        items.forEach((item) => {
            const text = item.textContent.toLowerCase();
            const ts = parseInt(item.dataset.date, 10) * 1000;

            let dateOk = true;
            if (activeRange === "today") {
                dateOk = ts >= todayStart;
            } else if (activeRange === "week") {
                dateOk = ts >= todayStart - 6 * DAY;
            } else if (activeRange === "month") {
                dateOk = ts >= todayStart - 29 * DAY;
            }

            item.style.display = text.includes(q) && dateOk ? "" : "none";
        });
    };

    if (form && input) {
        form.addEventListener("submit", (e) => e.preventDefault());
        input.addEventListener("input", applyFilters);
    }

    filterBtns.forEach((b) => {
        b.addEventListener("click", () => {
            activeRange = b.dataset.range;
            filterBtns.forEach((x) => x.classList.toggle("active", x === b));
            if (allBtn) allBtn.classList.remove("active");
            applyFilters();
        });
    });

    if (allBtn) {
        allBtn.addEventListener("click", (e) => {
            e.preventDefault();
            activeRange = "all";
            if (input) input.value = "";
            filterBtns.forEach((x) => x.classList.remove("active"));
            allBtn.classList.add("active");
            applyFilters();
        });
    }

    // sort dropdown: date desc/asc, title a-z/z-a
    const sortBtn = document.querySelector(".onenews .news-side .news-sort");
    const sortLabel = sortBtn?.querySelector(".news-sort-label");
    const sortMenu = document.querySelector(".onenews .news-sort-menu");
    const sortOptions = document.querySelectorAll(".onenews .news-sort-option");
    const list = document.querySelector(".onenews .news-side-list");

    const titleOf = (el) =>
        (el.querySelector("h4")?.textContent || "").trim().toLowerCase();
    const dateOf = (el) => parseInt(el.dataset.date, 10) || 0;

    const sorters = {
        "date-desc": (a, b) => dateOf(b) - dateOf(a),
        "date-asc": (a, b) => dateOf(a) - dateOf(b),
        "title-asc": (a, b) => titleOf(a).localeCompare(titleOf(b)),
        "title-desc": (a, b) => titleOf(b).localeCompare(titleOf(a)),
    };

    if (sortBtn && sortMenu && list) {
        sortBtn.addEventListener("click", (e) => {
            e.stopPropagation();
            const open = !sortMenu.classList.contains("open");
            sortMenu.classList.toggle("open", open);
            sortBtn.classList.toggle("open", open);
            sortBtn.setAttribute("aria-expanded", open);
        });

        sortOptions.forEach((opt) => {
            opt.addEventListener("click", () => {
                const fn = sorters[opt.dataset.sort];
                if (fn) {
                    Array.from(items).sort(fn).forEach((el) => list.appendChild(el));
                }
                sortOptions.forEach((x) => x.classList.toggle("active", x === opt));
                if (sortLabel) sortLabel.textContent = opt.textContent;
                sortMenu.classList.remove("open");
                sortBtn.classList.remove("open");
                sortBtn.setAttribute("aria-expanded", "false");
            });
        });

        document.addEventListener("click", (e) => {
            if (!sortMenu.classList.contains("open")) return;
            if (!e.target.closest(".news-side-listhead")) {
                sortMenu.classList.remove("open");
                sortBtn.classList.remove("open");
                sortBtn.setAttribute("aria-expanded", "false");
            }
        });
    }
});

const shareButton = document.getElementById("share-story");
const shareDialog = document.getElementById("share-dialog");

if (shareButton && shareDialog) {
    const shareUrl = document.getElementById("share-url");
    const copyButton = document.getElementById("copy-link");
    const closeDialog = document.getElementById("close-dialog");
    const wppButton = document.getElementById("share-whatsapp");
    const fbButton = document.getElementById("share-facebook");
    const linkedinButton = document.getElementById("share-linkedin");

    const openShare = () => {
        if (shareUrl) shareUrl.value = window.location.href;
        shareDialog.classList.remove("hidden-story");
    };
    const closeShare = () => shareDialog.classList.add("hidden-story");

    shareButton.addEventListener("click", openShare);
    if (closeDialog) closeDialog.addEventListener("click", closeShare);

    // close on Escape or click outside the dialog
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeShare();
    });
    document.addEventListener("click", (e) => {
        if (shareDialog.classList.contains("hidden-story")) return;
        if (!shareDialog.contains(e.target) && !shareButton.contains(e.target)) closeShare();
    });

    if (copyButton && shareUrl) {
        copyButton.addEventListener("click", async () => {
            try {
                shareUrl.select();
                shareUrl.setSelectionRange(0, 99999);
                await navigator.clipboard.writeText(shareUrl.value);
                const label = copyButton.textContent;
                copyButton.textContent = "Copied!";
                setTimeout(() => { copyButton.textContent = label; }, 1500);
            } catch (err) {
                console.error(err);
            }
        });
    }

    if (wppButton) wppButton.addEventListener("click", () => {
        const text = encodeURIComponent(document.title + " " + window.location.href);
        window.open(`https://wa.me/?text=${text}`, "_blank");
    });

    if (fbButton) fbButton.addEventListener("click", () => {
        const url = encodeURIComponent(shareUrl.value);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, "_blank");
    });

    if (linkedinButton) linkedinButton.addEventListener("click", () => {
        const url = encodeURIComponent(shareUrl.value);
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, "_blank");
    });
}

