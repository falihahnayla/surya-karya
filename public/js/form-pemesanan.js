// Ganti seluruh isi public/js/formpesan.js dengan file ini.

// Preview file upload (denah / lahan)
function previewUploadFile(input, type) {
    const file = input.files && input.files[0];
    const defaultUi = document.getElementById(type + '-default-ui');
    const container = document.getElementById(type + '-preview-container');
    const img = document.getElementById(type + '-preview-img');
    const iconBox = document.getElementById(type + '-file-icon-box');
    const filename = document.getElementById(type + '-filename');

    if (!file) {
        resetUploadPreview(type);
        return;
    }

    if (file.size > 10 * 1024 * 1024) {
        alert('Ukuran file maksimal 10MB.');
        input.value = '';
        resetUploadPreview(type);
        return;
    }

    defaultUi.classList.add('hidden');
    container.classList.remove('hidden');
    filename.textContent = file.name;

    if (file.type.startsWith('image/')) {
        img.src = URL.createObjectURL(file);
        img.classList.remove('hidden');
        iconBox.classList.add('hidden');
    } else {
        img.classList.add('hidden');
        iconBox.classList.remove('hidden');
    }
}

function resetUploadPreview(type) {
    document.getElementById(type + '-default-ui').classList.remove('hidden');
    document.getElementById(type + '-preview-container').classList.add('hidden');
    const img = document.getElementById(type + '-preview-img');
    img.classList.add('hidden');
    img.removeAttribute('src');
}

function closeModal() {
    const m = document.getElementById('success-modal');
    m.classList.add('hidden');
    m.classList.remove('flex');
}

// Kirim form ke server (AJAX), lalu tampilkan modal + link WhatsApp otomatis
async function handleFormSubmit(event) {
    event.preventDefault();

    const form = event.target;
    const btn = form.querySelector('button[type="submit"]');
    const label = btn.querySelector('span');
    const originalText = label.textContent;

    btn.disabled = true;
    label.textContent = 'Mengirim...';

    try {
        // FormData otomatis menyertakan _token dari @csrf
        const res = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: { 'Accept': 'application/json' },
        });
        const data = await res.json();

        if (!res.ok) {
            alert(res.status === 422
                ? Object.values(data.errors).flat().join('\n')
                : 'Terjadi kesalahan, silakan coba lagi.');
            return;
        }

        document.getElementById('btn-whatsapp-modal').href = data.whatsapp_url;
        const m = document.getElementById('success-modal');
        m.classList.remove('hidden');
        m.classList.add('flex');
        form.reset();
        resetUploadPreview('denah');
        resetUploadPreview('lahan');
    } catch (e) {
        alert('Gagal mengirim data. Periksa koneksi internet Anda.');
    } finally {
        btn.disabled = false;
        label.textContent = originalText;
    }
}