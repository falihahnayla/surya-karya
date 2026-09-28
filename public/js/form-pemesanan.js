document.addEventListener("DOMContentLoaded", function () {
    const yearElement = document.getElementById("current-year");

    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }
});

function handleFormSubmit(event) {
    event.preventDefault();

    const modal = document.getElementById("success-modal");

    if (modal) {
        modal.classList.remove("hidden");
    }
}

function closeModal() {
    const modal = document.getElementById("success-modal");
    const form = document.getElementById("order-form");
    const denahLabel = document.getElementById("denah-label");
    const lahanLabel = document.getElementById("lahan-label");

    if (modal) {
        modal.classList.add("hidden");
    }

    if (form) {
        form.reset();
    }

    if (denahLabel) {
        denahLabel.textContent = "Upload Denah / Foto";
        denahLabel.classList.remove("text-navy-900");
    }

    if (lahanLabel) {
        lahanLabel.textContent = "Upload Foto Lahan";
        lahanLabel.classList.remove("text-navy-900");
    }
}

function updateFileName(input, targetLabelId) {
    const label = document.getElementById(targetLabelId);

    if (input.files && input.files[0] && label) {
        label.textContent = input.files[0].name;
        label.classList.add("text-navy-900");
    }
}
