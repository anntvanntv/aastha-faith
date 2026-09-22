document.addEventListener("DOMContentLoaded", () => {
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
