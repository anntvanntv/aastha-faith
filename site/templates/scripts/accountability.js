document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".accountability .expand-cards-btn").forEach((btn) => {
        const column = btn.closest(".column");
        const more = column && column.querySelector(".more-cards");
        const label = btn.querySelector(".expand-cards-label");
        if (!more || !label) return;

        btn.addEventListener("click", () => {
            const open = more.classList.toggle("open");
            btn.classList.toggle("open", open);
            label.textContent = open ? "See less" : btn.dataset.more;
        });
    });
});
