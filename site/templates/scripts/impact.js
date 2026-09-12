let section = document.querySelector('.in-numbers');



let wrapperHeight = section.offsetHeight;

let innerHeight = window.innerHeight;

let rows = document.querySelector('.in-numbers-wrap').children;

document.addEventListener ("scroll", updateImpact);

function showRow(index) {
    for (let i = 0; i < rows.length; i++) {
        rows[i].classList.remove("visible", "hidden");

        if (i === index) {
            rows[i].classList.add("visible");
        } else {
            rows[i].classList.add("hidden");
        }
    }
}
 

function updateImpact() {



let scrolled = window.scrollY-section.offsetTop;

let progress = scrolled / (wrapperHeight - innerHeight);

if (progress < 0.33) {
    showRow(0);
} else if (progress < 0.66) {
    showRow(1);
} else {
    showRow(2);
}


}

window.addEventListener("load", () => {
    window.scrollTo(0, 0);
});

