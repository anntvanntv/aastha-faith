
const nameInput = document.getElementById("name");
const warningMessage = document.getElementById("warning-message");



const requiredFields = document.querySelectorAll("[required]");
const emailInput = document.getElementById("email");

function validateForm () {

    let valid = true;

    requiredFields.forEach((field) => {

                if (field.value.trim() === "") {

                    console.log("Name input is empty");
                    field.classList.add("border-red");
                    valid = false;

                } else {
                  
                    field.classList.remove("border-red");
                   
                }
    });

    warningMessage.style.display = valid ? "none" : "flex";
   

    return valid;

}

/* group pills — single-select, show the matching info card on click */
const groupPills = document.querySelectorAll('.pill input[name="group"]');
const pillCards = document.querySelectorAll(".pill-card");

groupPills.forEach((radio) => {
    radio.addEventListener("change", () => {
        document.querySelectorAll(".pill").forEach((p) => p.classList.remove("active"));
        radio.closest(".pill").classList.add("active");
        pillCards.forEach((card) => {
            card.classList.toggle("active", card.dataset.group === radio.value);
        });
    });
});


/* success popup — shown once after form submission (?sent=1) */
const successDialog = document.getElementById("success-dialog");
if (successDialog) {
    successDialog.classList.remove("hidden-story");
    // strip ?sent=1 so a refresh doesn't re-show the popup
    history.replaceState(null, "", window.location.pathname);
    const closeSuccess = () => successDialog.classList.add("hidden-story");
    const closeSuccessBtn = document.getElementById("close-success");
    if (closeSuccessBtn) closeSuccessBtn.addEventListener("click", closeSuccess);
    document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeSuccess();
    });
    document.addEventListener("click", (e) => {
        if (successDialog.classList.contains("hidden-story")) return;
        if (!successDialog.contains(e.target)) closeSuccess();
    });
}

