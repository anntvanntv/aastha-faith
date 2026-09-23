


const shareButton = document.getElementById("share-story");
const shareDialog = document.getElementById("share-dialog");

const shareUrl = document.getElementById("share-url");

const copyButton = document.getElementById("copy-link");

const closeDialog = document.getElementById("close-dialog");


const wppButton = document.getElementById("share-whatsapp");
const fbButton = document.getElementById("share-facebook");
const linkedinButton = document.getElementById("share-linkedin");

copyButton.addEventListener("click", async () => {
    try {
        shareUrl.select();
        shareUrl.setSelectionRange(0, 99999);


        await navigator.clipboard.writeText(shareUrl.value);

    } catch (err) {
        console.error(err);
    }

});


shareButton.addEventListener("click", () => {
    shareUrl.value = window.location.href;
    shareDialog.classList.toggle("hidden-story");
} )


closeDialog.addEventListener("click", () => {
    shareDialog.classList.toggle("hidden-story");
} )

wppButton.addEventListener("click", () => {
    const url = encodeURIComponent(window.location.href);

    window.open(
        `https://wa.me/?text=${url}`,
        "_blank"
    );
});


fbButton.addEventListener("click", () => {
    const url = encodeURIComponent(shareUrl.value);

    window.open(
        `https://www.facebook.com/sharer/sharer.php?u=${url}`,
        "_blank"
    );
});


linkedinButton.addEventListener("click", () => {
    const url = encodeURIComponent(shareUrl.value);

    window.open(
        `https://www.linkedin.com/sharing/share-offsite/?url=${url}`,
        "_blank"
    );
});

