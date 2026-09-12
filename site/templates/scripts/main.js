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


