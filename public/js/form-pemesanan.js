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

// Validasi input nomor WhatsApp & email real-time serta proteksi form
function setupFormValidation() {
    const form = document.getElementById('order-form');
    if (!form) return;

    const waInput = document.getElementById('nomor_whatsapp');
    const waError = document.getElementById('whatsapp-inline-error');
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-inline-error');
    const submitBtn = document.getElementById('btn-submit');

    // 1. WhatsApp: Hanya angka, hapus karakter lain secara real-time
    if (waInput) {
        const cleanWa = () => {
            const raw = waInput.value;
            const cleaned = raw.replace(/\D/g, '');
            if (raw !== cleaned) {
                waInput.value = cleaned;
            }
        };

        waInput.addEventListener('input', () => {
            cleanWa();
            validateWa(false);
        });

        waInput.addEventListener('paste', () => {
            setTimeout(() => {
                cleanWa();
                validateWa(false);
            }, 0);
        });

        waInput.addEventListener('blur', () => {
            validateWa(true);
        });
    }

    function validateWa(showEmptyError = false) {
        if (!waInput || !waError) return true;
        const val = waInput.value.trim();

        if (!val) {
            if (showEmptyError) {
                waError.textContent = 'Nomor WhatsApp wajib diisi.';
                waError.classList.remove('hidden');
                return false;
            }
            waError.textContent = '';
            waError.classList.add('hidden');
            return true;
        }

        // Format Indonesia: diawali 08 atau 628, panjang 10-15 digit
        const regex = /^(62|0)8[0-9]{8,12}$/;
        if (!regex.test(val)) {
            waError.textContent = 'Nomor WhatsApp tidak valid. Diawali 08 atau 628, panjang 10–15 digit (contoh: 08123456789).';
            waError.classList.remove('hidden');
            return false;
        }

        waError.textContent = '';
        waError.classList.add('hidden');
        return true;
    }

    // 2. Email: trim, toLowerCase, dan cek format pada blur
    if (emailInput) {
        const validateEmail = () => {
            if (!emailError) return true;
            emailInput.value = emailInput.value.trim().toLowerCase();
            const val = emailInput.value;

            if (!val) {
                emailError.textContent = '';
                emailError.classList.add('hidden');
                return true;
            }

            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(val)) {
                emailError.textContent = 'Format email tidak valid. Mohon gunakan email yang aktif.';
                emailError.classList.remove('hidden');
                return false;
            }

            emailError.textContent = '';
            emailError.classList.add('hidden');
            return true;
        };

        emailInput.addEventListener('blur', validateEmail);
        emailInput.addEventListener('input', () => {
            if (!emailError.classList.contains('hidden')) {
                validateEmail();
            }
        });
    }

    // 3. Submit Validation
    form.addEventListener('submit', (e) => {
        const isWaValid = validateWa(true);
        let isEmailValid = true;

        if (emailInput && emailInput.value.trim() !== '') {
            emailInput.value = emailInput.value.trim().toLowerCase();
            const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(emailInput.value)) {
                if (emailError) {
                    emailError.textContent = 'Format email tidak valid. Mohon gunakan email yang aktif.';
                    emailError.classList.remove('hidden');
                }
                isEmailValid = false;
            }
        }

        if (!isWaValid || !isEmailValid) {
            e.preventDefault();
            e.stopImmediatePropagation();

            if (!isWaValid && waInput) {
                waInput.focus();
            } else if (!isEmailValid && emailInput) {
                emailInput.focus();
            }

            if (submitBtn) {
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                const span = submitBtn.querySelector('span');
                if (span) span.textContent = 'Ajukan / Pesan Jasa';
            }
            return false;
        }

        // Cegah double submit saat valid
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
            const span = submitBtn.querySelector('span');
            if (span) span.textContent = 'Mengirim...';
        }
    });
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', setupFormValidation);
} else {
    setupFormValidation();
}