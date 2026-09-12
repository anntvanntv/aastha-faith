
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

