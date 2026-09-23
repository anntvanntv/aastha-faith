document.addEventListener("DOMContentLoaded", () => {
    const canHover = window.matchMedia("(hover: hover) and (pointer: fine)").matches;
    const reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    document.querySelectorAll(".team .member").forEach((member) => {
        const setFlipped = (v) => {
            member.classList.toggle("flipped", v);
            member.setAttribute("aria-pressed", v);
        };

        if (canHover) {
            // desktop: hover flips, leaving flips back
            member.addEventListener("mouseenter", () => setFlipped(true));
            member.addEventListener("mouseleave", () => setFlipped(false));
        } else {
            // touch: tap toggles
            member.addEventListener("click", () => setFlipped(!member.classList.contains("flipped")));
        }
        member.addEventListener("keydown", (e) => {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                setFlipped(!member.classList.contains("flipped"));
            }
        });

        if (!canHover || reducedMotion) return;

        // Pointer-tracked 3D tilt — the card rotates toward the cursor and the
        // face shadow shifts opposite the tilt, like a fixed light source.
        member.addEventListener("mousemove", (e) => {
            const r = member.getBoundingClientRect();
            const x = (e.clientX - r.left) / r.width - 0.5;
            const y = (e.clientY - r.top) / r.height - 0.5;
            member.style.transform =
                `perspective(1000px) rotateX(${(-y * 8).toFixed(2)}deg) rotateY(${(x * 8).toFixed(2)}deg) translateY(-6px)`;
            member.style.setProperty("--shx", (-x * 14).toFixed(1) + "px");
            member.style.setProperty("--shy", (y * 8).toFixed(1) + "px");
        });
        member.addEventListener("mouseleave", () => {
            member.style.transform = "";
            member.style.removeProperty("--shx");
            member.style.removeProperty("--shy");
        });
    });
});
