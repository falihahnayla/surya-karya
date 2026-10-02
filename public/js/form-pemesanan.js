document.addEventListener("DOMContentLoaded", function () {
    const yearElement = document.getElementById("current-year");

    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }
});

function handleFormSubmit(event) {
    event.preventDefault();

    // Get input values
    const namaLengkap = document.getElementById("nama_lengkap")?.value.trim() || "";
    const namaPerusahaan = document.getElementById("nama_perusahaan")?.value.trim() || "-";
    const nomorWhatsapp = document.getElementById("nomor_whatsapp")?.value.trim() || "";
    const email = document.getElementById("email")?.value.trim() || "-";
    const alamatProyek = document.getElementById("alamat_proyek")?.value.trim() || "";
    const jenisLayanan = document.getElementById("jenis_layanan")?.value || "";
    const luasBangunan = document.getElementById("luas_bangunan")?.value.trim() || "-";
    const luasLahan = document.getElementById("luas_lahan")?.value.trim() || "-";
    const posisiBangunan = document.getElementById("posisi_bangunan")?.value.trim() || "-";
    const kebutuhanProyek = document.getElementById("kebutuhan_proyek")?.value.trim() || "";
    const catatanTambahan = document.getElementById("catatan_tambahan")?.value.trim() || "-";

    const fileDenah = document.getElementById("file_denah");
    const fileLahan = document.getElementById("file_lahan");
    const denahStatus = (fileDenah && fileDenah.files && fileDenah.files[0]) ? fileDenah.files[0].name : "Tidak diunggah";
    const lahanStatus = (fileLahan && fileLahan.files && fileLahan.files[0]) ? fileLahan.files[0].name : "Tidak diunggah";

    // Build clean & minimal auto message text without emoticons
    let message = `Halo Surya Karya, saya baru saja mengajukan pemesanan jasa melalui website dengan detail berikut:\n\n`;
    message += `*DATA PEMESANAN SURYA KARYA*\n`;
    message += `• *Nama Lengkap:* ${namaLengkap}\n`;
    message += `• *Perusahaan:* ${namaPerusahaan}\n`;
    message += `• *No. WhatsApp:* ${nomorWhatsapp}\n`;
    message += `• *Email:* ${email}\n`;
    message += `• *Alamat Proyek:* ${alamatProyek}\n\n`;
    message += `*DETAIL PROYEK*\n`;
    message += `• *Jenis Layanan:* ${jenisLayanan}\n`;
    message += `• *Luas Bangunan:* ${luasBangunan} m²\n`;
    message += `• *Luas Lahan:* ${luasLahan} m²\n`;
    message += `• *Posisi Bangunan:* ${posisiBangunan}\n`;
    message += `• *Kebutuhan Proyek:* ${kebutuhanProyek}\n`;
    message += `• *Gambar Denah:* ${denahStatus}\n`;
    message += `• *Gambar Lahan:* ${lahanStatus}\n`;
    message += `• *Catatan Tambahan:* ${catatanTambahan}\n\n`;
    message += `Mohon informasi dan konfirmasi tindak lanjut dari Surya Karya. Terima kasih.`;

    // Target WhatsApp Number (62895635040947)
    const waNumber = "62895635040947";
    const waUrl = `https://wa.me/${waNumber}?text=${encodeURIComponent(message)}`;

    // Update WhatsApp button href inside the modal
    const waBtn = document.getElementById("btn-whatsapp-modal");
    if (waBtn) {
        waBtn.href = waUrl;
    }

    // Show success pop-up modal
    const modal = document.getElementById("success-modal");
    if (modal) {
        modal.classList.remove("hidden");
    }
}

function closeModal() {
    const modal = document.getElementById("success-modal");
    const form = document.getElementById("order-form");

    if (modal) {
        modal.classList.add("hidden");
    }

    if (form) {
        form.reset();
    }

    resetUploadPreview("denah");
    resetUploadPreview("lahan");
}

function previewUploadFile(input, type) {
    const file = input.files && input.files[0];
    const defaultUi = document.getElementById(type + "-default-ui");
    const previewContainer = document.getElementById(type + "-preview-container");
    const previewImg = document.getElementById(type + "-preview-img");
    const iconBox = document.getElementById(type + "-file-icon-box");
    const fileNameElement = document.getElementById(type + "-filename");

    if (!file) return;

    if (fileNameElement) {
        fileNameElement.textContent = file.name;
    }

    if (file.type.startsWith("image/")) {
        const reader = new FileReader();
        reader.onload = function (e) {
            if (previewImg) {
                previewImg.src = e.target.result;
                previewImg.classList.remove("hidden");
            }
            if (iconBox) {
                iconBox.classList.add("hidden");
            }
        };
        reader.readAsDataURL(file);
    } else {
        // PDF or non-image
        if (previewImg) {
            previewImg.src = "";
            previewImg.classList.add("hidden");
        }
        if (iconBox) {
            iconBox.classList.remove("hidden");
        }
    }

    if (defaultUi) defaultUi.classList.add("hidden");
    if (previewContainer) previewContainer.classList.remove("hidden");
}

function resetUploadPreview(type) {
    const defaultUi = document.getElementById(type + "-default-ui");
    const previewContainer = document.getElementById(type + "-preview-container");
    const previewImg = document.getElementById(type + "-preview-img");
    const iconBox = document.getElementById(type + "-file-icon-box");
    const fileNameElement = document.getElementById(type + "-filename");

    if (previewImg) {
        previewImg.src = "";
        previewImg.classList.add("hidden");
    }
    if (iconBox) {
        iconBox.classList.remove("hidden");
    }
    if (fileNameElement) {
        fileNameElement.textContent = "";
    }

    if (defaultUi) defaultUi.classList.remove("hidden");
    if (previewContainer) previewContainer.classList.add("hidden");
}

function updateFileName(input, targetLabelId) {
    const type = targetLabelId.includes("denah") ? "denah" : "lahan";
    previewUploadFile(input, type);
}
