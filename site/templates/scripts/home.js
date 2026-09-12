




document.addEventListener("DOMContentLoaded", () => {

const video = document.getElementById("myVideo");
const btn = document.querySelector(".play-btn");


    btn.addEventListener("click", () => {
        video.play();
        video.setAttribute("controls", "");
        btn.style.display = "none";
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