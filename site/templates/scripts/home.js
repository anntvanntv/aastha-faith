




document.addEventListener("DOMContentLoaded", () => {

// Hero slideshow — auto-rotate background slides every 3s
const heroSlides = document.querySelectorAll(".hero-slide");
if (heroSlides.length > 1) {
    let cur = 0;
    setInterval(() => {
        heroSlides[cur].classList.remove("active");
        cur = (cur + 1) % heroSlides.length;
        heroSlides[cur].classList.add("active");
    }, 3000);
}

const video = document.getElementById("myVideo");
const btn = document.querySelector(".play-btn");


    btn.addEventListener("click", () => {
        video.play();
        video.setAttribute("controls", "");
        btn.style.display = "none";
    });

// Clamp long card text to 6 lines with a Read more / Show less toggle.
// Works for every .clamp-wrap; the button only appears when text overflows.
document.querySelectorAll(".clamp-wrap").forEach((wrap) => {
    const p = wrap.querySelector(".clamp-text");
    const toggle = wrap.querySelector(".expand-text-btn");
    if (!p || !toggle) return;
    p.classList.add("clamped");
    if (p.scrollHeight > p.clientHeight + 4) {
        toggle.style.display = "inline-block";
    }
    toggle.addEventListener("click", () => {
        const nowClamped = p.classList.toggle("clamped");
        toggle.textContent = nowClamped ? "Read more" : "Show less";
        toggle.setAttribute("aria-expanded", String(!nowClamped));
    });
});
});



let section = document.getElementsByClassName('in-numbers');

console.log(section);



const links = document.querySelectorAll('.vertical-card-link');

links.forEach(link => {
    link.addEventListener('click', (e) => {
        if(link.querySelector('.pw-edit-attr')) {
          
            e.preventDefault();
            
        }
    })

})


/* logo carousel */

const track = document.querySelector('.carousel-track');
const prevButton = document.querySelector('.car-prev-ar');
const nextButton = document.querySelector('.car-next-ar');

prevButton.addEventListener('click', () => {
    track.scrollBy({
        left: -400,
        behavior: 'smooth'
    })
})

nextButton.addEventListener('click', () => {
    track.scrollBy({
        left: 400,
        behavior: 'smooth'
    })
})


/* impact stats — count-up on scroll into view */
const statNumbers = document.querySelectorAll("#stats .static-card h2");
if (statNumbers.length && "IntersectionObserver" in window) {
    const animateStat = (el) => {
        const raw = el.textContent.trim();
        const match = raw.match(/^([\d,]+)(.*)$/);
        if (!match) return;
        const target = parseInt(match[1].replace(/,/g, ""), 10);
        const suffix = match[2];
        const duration = 1600;
        const start = performance.now();
        const step = (now) => {
            const p = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased).toLocaleString("en-US") + suffix;
            if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    };
    const statObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                animateStat(entry.target);
                statObserver.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    statNumbers.forEach((el) => statObserver.observe(el));
}