document.addEventListener("DOMContentLoaded", () => {
    // live filter — same page, only matching cards appear
    const searchForm = document.querySelector(".news-search");
    const searchInput = searchForm?.querySelector("input[name='q']");
    const cards = document.querySelectorAll(".news .news-card");
    const moreBatches = document.querySelectorAll(".news .more-cards");
    const filterBtns = document.querySelectorAll(".news-filter");
    const dateFrom = document.querySelector(".news-date-from");
    const dateTo = document.querySelector(".news-date-to");
    const allBtn = document.querySelector(".news-all");
    const DAY = 864e5;

    const toTs = (v, endOfDay) => {
        if (!v) return null;
        const [y, m, d] = v.split("-").map(Number);
        return new Date(y, m - 1, d).getTime() + (endOfDay ? DAY - 1 : 0);
    };

    let activeRange = "all";
    let rangeFrom = null;
    let rangeTo = null;

    const clearPickerActive = () => {
        filterBtns.forEach((x) => x.classList.remove("active"));
        if (allBtn) allBtn.classList.remove("active");
    };

    const applyFilters = () => {
        const q = searchInput ? searchInput.value.trim().toLowerCase() : "";
        const now = new Date();
        const todayStart = new Date(now.getFullYear(), now.getMonth(), now.getDate()).getTime();
        const filtering = q !== "" || activeRange !== "all" || rangeFrom !== null || rangeTo !== null;

        cards.forEach((card) => {
            const text = card.querySelector(".title-content")?.textContent.toLowerCase() || "";
            const ts = parseInt(card.dataset.date, 10) * 1000;

            let dateOk = true;
            if (rangeFrom !== null || rangeTo !== null) {
                if (rangeFrom !== null && ts < rangeFrom) dateOk = false;
                if (rangeTo !== null && ts > rangeTo) dateOk = false;
            } else if (activeRange === "today") {
                dateOk = ts >= todayStart;
            } else if (activeRange === "week") {
                dateOk = ts >= todayStart - 6 * DAY;
            } else if (activeRange === "month") {
                dateOk = ts >= todayStart - 29 * DAY;
            }

            card.style.display = text.includes(q) && dateOk ? "" : "none";
        });

        moreBatches.forEach((m) => {
            m.style.display = filtering ? "block" : "";
        });

        const expandBtn = document.getElementById("expandCardsBtn");
        if (expandBtn) expandBtn.style.display = filtering ? "none" : "";
    };

    if (searchForm && searchInput && cards.length) {
        searchForm.addEventListener("submit", (e) => e.preventDefault());
        searchInput.addEventListener("input", applyFilters);
    }

    filterBtns.forEach((b) => {
        b.addEventListener("click", () => {
            activeRange = b.dataset.range;
            rangeFrom = null;
            rangeTo = null;
            if (dateFrom) dateFrom.value = "";
            if (dateTo) dateTo.value = "";
            filterBtns.forEach((x) => x.classList.toggle("active", x === b));
            if (allBtn) allBtn.classList.remove("active");
            applyFilters();
        });
    });

    [dateFrom, dateTo].forEach((picker) => {
        if (!picker) return;
        picker.addEventListener("change", () => {
            rangeFrom = toTs(dateFrom?.value, false);
            rangeTo = toTs(dateTo?.value, true);
            activeRange = "";
            clearPickerActive();
            applyFilters();
        });
    });

    if (allBtn) {
        allBtn.addEventListener("click", (e) => {
            e.preventDefault();
            activeRange = "all";
            rangeFrom = null;
            rangeTo = null;
            if (searchInput) searchInput.value = "";
            if (dateFrom) dateFrom.value = "";
            if (dateTo) dateTo.value = "";
            filterBtns.forEach((x) => x.classList.remove("active"));
            allBtn.classList.add("active");
            applyFilters();
        });
    }

    const btn = document.getElementById("expandCardsBtn");
    const label = document.getElementById("expandCardsLabel");
    const allMore = document.querySelectorAll(".more-cards");
    if (!btn || !allMore.length) return;

    const batchSize = 6;

    const updateLabel = () => {
        const hiddenCards = Array.from(allMore)
            .filter(m => !m.classList.contains("open"))
            .reduce((sum, m) => sum + m.querySelectorAll(".news-card").length, 0);

        if (hiddenCards === 0) {
            label.textContent = "See Less";
            btn.classList.add("open");
        } else {
            const nextBatch = Math.min(batchSize, hiddenCards);
            label.textContent = `See ${nextBatch} more (${hiddenCards} remaining)`;
            btn.classList.remove("open");
        }
    };

    updateLabel();

    btn.addEventListener("click", () => {
        if (btn.classList.contains("open")) {
            // collapse back to the initial 6
            allMore.forEach(m => m.classList.remove("open"));
        } else {
            // reveal the next hidden batch
            for (const m of allMore) {
                if (!m.classList.contains("open")) {
                    m.classList.add("open");
                    break;
                }
            }
        }
        updateLabel();
    });
});
