function myMenu() {
    const menu = document.getElementById('menu-icon');
    const close = document.getElementById('close-icon');
    const links = document.querySelector('ul');
    const icon = document.querySelector('.icon');

   
    links.classList.toggle('active');

    menu.classList.toggle('hidden');
    close.classList.toggle('hidden');
 
}

/*        NAV COLOR CHANGE                     */

window.addEventListener("scroll", () => {

    if (window.innerWidth <= 900) return;

    const sections = document.querySelectorAll('section');

    const navs = document.querySelectorAll('nav ul li a');

    sections.forEach(section => {

       const topsection = section.getBoundingClientRect().top;

       if (topsection <= 0 && section.dataset.navColor === "dark") {
        
     

         navs.forEach(nav => {
            nav.classList.add("dark");
            nav.classList.remove("light");
         })
        
        
            
    
       }  else if (topsection <= 0 && section.dataset.navColor === "light") {
        
        navs.forEach(nav => {
            nav.classList.add("light");
            nav.classList.remove("dark");
         })

       } else if (topsection <= 0 && section.dataset.navColor !== "dark" && section.dataset.navColor !== "light") {
        navs.forEach(nav => {
            nav.classList.remove("dark");
            nav.classList.remove("light");
         })
        } 

    })

   
})




/* impact stats — count-up on scroll into view (home + impact pages) */
const statNumbers = document.querySelectorAll(".static-card h2");
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
