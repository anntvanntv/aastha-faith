// All card groups are shown at once — the old scroll-driven row
// switching (400vh sticky section, showRow/updateImpact) was removed.

// Extra card rows (4th+) collapse behind a "Show more" arrow
document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("expandCardsBtn");
    const more = document.getElementById("moreCards");
    if (!btn || !more) return;
    btn.addEventListener("click", () => {
        const open = more.classList.toggle("open");
        btn.classList.toggle("open", open);
        btn.querySelector(".expand-cards-label").textContent = open ? "Show less" : "Show more";
        btn.setAttribute("aria-expanded", String(open));
    });
});

