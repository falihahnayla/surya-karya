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

// 4. Modul Verifikasi Email OTP
(function () {
    const wrap = document.getElementById('email-wrap');
    if (!wrap) return;

    const form      = document.getElementById('order-form');
    const email     = document.getElementById('email');
    const btnSend   = document.getElementById('btn-send-otp');
    const btnVerify = document.getElementById('btn-verify-otp');
    const otpBox    = document.getElementById('otp-box');
    const otpInput  = document.getElementById('otp-code');
    const errEl     = document.getElementById('email-inline-error');
    const okEl      = document.getElementById('email-inline-ok');
    const token     = form ? form.querySelector('input[name="_token"]')?.value : '';

    let verifiedEmail = wrap.dataset.verified === '1' && email ? email.value.trim().toLowerCase() : null;
    let cooldownTimer = null;

    const showErr = (m) => {
        errEl.textContent = m;
        errEl.classList.remove('hidden');
        okEl.classList.add('hidden');
    };
    const clearErr = () => {
        errEl.textContent = '';
        errEl.classList.add('hidden');
    };
    const isFormatOk = (v) => /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(v);

    async function post(url, body) {
        const res = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify(body),
        });
        const data = await res.json().catch(() => ({}));
        if (!res.ok) {
            const first = data.errors ? Object.values(data.errors)[0][0] : null;
            throw new Error(first || data.message || 'Terjadi kesalahan. Coba lagi.');
        }
        return data;
    }

    function startCooldown(sec) {
        let left = sec;
        btnSend.disabled = true;
        clearInterval(cooldownTimer);
        btnSend.textContent = `Kirim ulang (${left})`;
        cooldownTimer = setInterval(() => {
            left--;
            btnSend.textContent = left > 0 ? `Kirim ulang (${left})` : 'Kirim Ulang';
            if (left <= 0) {
                clearInterval(cooldownTimer);
                btnSend.disabled = false;
            }
        }, 1000);
    }

    // Email diubah -> status verifikasi dicabut
    email.addEventListener('input', () => {
        email.value = email.value.replace(/\s/g, '');
        if (verifiedEmail && email.value.trim().toLowerCase() !== verifiedEmail) {
            verifiedEmail = null;
            okEl.classList.add('hidden');
            wrap.dataset.verified = '0';
        }
        otpBox.classList.add('hidden');
        otpBox.style.display = 'none';
        clearErr();
    });

    email.addEventListener('blur', () => {
        const v = email.value.trim().toLowerCase();
        if (v && !isFormatOk(v)) {
            showErr('Format email tidak valid.');
        }
    });

    btnSend.addEventListener('click', async () => {
        const v = email.value.trim().toLowerCase();
        if (!isFormatOk(v)) {
            return showErr('Masukkan alamat email yang valid terlebih dahulu.');
        }
        clearErr();
        btnSend.disabled = true;
        btnSend.textContent = 'Mengirim...';
        try {
            const data = await post(wrap.dataset.sendUrl, { email: v });
            otpBox.classList.remove('hidden');
            otpBox.style.display = 'flex';
            otpInput.focus();
            okEl.textContent = data.message;
            okEl.classList.remove('hidden');
            startCooldown(60);
        } catch (e) {
            showErr(e.message);
            btnSend.disabled = false;
            btnSend.textContent = 'Kirim Kode';
        }
    });

    otpInput.addEventListener('input', () => {
        otpInput.value = otpInput.value.replace(/\D/g, '').slice(0, 6);
    });

    btnVerify.addEventListener('click', async () => {
        const v = email.value.trim().toLowerCase();
        if (otpInput.value.length !== 6) {
            return showErr('Masukkan 6 digit kode verifikasi.');
        }
        clearErr();
        btnVerify.disabled = true;
        try {
            await post(wrap.dataset.verifyUrl, { email: v, code: otpInput.value });
            verifiedEmail = v;
            wrap.dataset.verified = '1';
            otpBox.classList.add('hidden');
            otpBox.style.display = 'none';
            otpInput.value = '';
            okEl.textContent = '✓ Email terverifikasi';
            okEl.classList.remove('hidden');
        } catch (e) {
            showErr(e.message);
        } finally {
            btnVerify.disabled = false;
        }
    });

    // Blokir submit jika email diisi tapi belum diverifikasi (fase capture agar jalan sebelum handler anti-double-submit)
    form.addEventListener('submit', (ev) => {
        const v = email.value.trim().toLowerCase();
        if (v && v !== verifiedEmail) {
            ev.preventDefault();
            ev.stopImmediatePropagation();
            showErr('Email belum diverifikasi. Klik "Kirim Kode" lalu masukkan kode dari email Anda.');
            email.scrollIntoView({ behavior: 'smooth', block: 'center' });
            const btn = document.getElementById('btn-submit');
            if (btn) {
                btn.disabled = false;
                btn.classList.remove('opacity-60', 'cursor-not-allowed');
                const span = btn.querySelector('span');
                if (span) span.textContent = 'Ajukan / Pesan Jasa';
            }
        }
    }, true);
})();