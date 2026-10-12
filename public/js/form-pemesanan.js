// Ganti seluruh isi public/js/formpesan.js dengan file ini.

// Preview file upload (denah / lahan)
function previewUploadFile(input, type) {
    const file = input.files && input.files[0];
    const defaultUi = document.getElementById(type + "-default-ui");
    const container = document.getElementById(type + "-preview-container");
    const img = document.getElementById(type + "-preview-img");
    const iconBox = document.getElementById(type + "-file-icon-box");
    const filename = document.getElementById(type + "-filename");

    if (!file) {
        resetUploadPreview(type);
        return;
    }

    // [BARU] Hanya izinkan JPG, PNG, PDF
    const ext = (file.name.split(".").pop() || "").toLowerCase();
    const allowedExt = ["jpg", "jpeg", "png", "pdf"];
    const allowedMime = ["image/jpeg", "image/png", "application/pdf"];
    if (
        !allowedExt.includes(ext) ||
        (file.type && !allowedMime.includes(file.type))
    ) {
        alert("Format file harus JPG, PNG, atau PDF.");
        input.value = "";
        resetUploadPreview(type);
        return;
    }

    if (file.size > 10 * 1024 * 1024) {
        alert("Ukuran file maksimal 10MB.");
        input.value = "";
        resetUploadPreview(type);
        return;
    }

    defaultUi.classList.add("hidden");
    container.classList.remove("hidden");
    filename.textContent = file.name;

    if (file.type.startsWith("image/")) {
        if (img.src && img.src.startsWith("blob:"))
            URL.revokeObjectURL(img.src);
        img.src = URL.createObjectURL(file);
        img.classList.remove("hidden");
        iconBox.classList.add("hidden");
    } else {
        img.classList.add("hidden");
        iconBox.classList.remove("hidden");
    }
}

function resetUploadPreview(type) {
    document.getElementById(type + "-default-ui").classList.remove("hidden");
    document
        .getElementById(type + "-preview-container")
        .classList.add("hidden");
    const img = document.getElementById(type + "-preview-img");
    if (img.src && img.src.startsWith("blob:")) URL.revokeObjectURL(img.src);
    img.classList.add("hidden");
    img.removeAttribute("src");
}

function closeModal() {
    const m = document.getElementById("success-modal");
    m.classList.add("hidden");
    m.classList.remove("flex");
}

// Validasi input nomor WhatsApp & email real-time serta proteksi form
function setupFormValidation() {
    const form = document.getElementById("order-form");
    if (!form) return;

    const waInput = document.getElementById("nomor_whatsapp");
    const waError = document.getElementById("whatsapp-inline-error");
    const emailInput = document.getElementById("email");
    const emailError = document.getElementById("email-inline-error");
    const submitBtn = document.getElementById("btn-submit");

    // 1. WhatsApp: Hanya angka, hapus karakter lain secara real-time
    if (waInput) {
        const cleanWa = () => {
            const raw = waInput.value;
            const cleaned = raw.replace(/\D/g, "");
            if (raw !== cleaned) {
                waInput.value = cleaned;
            }
        };

        waInput.addEventListener("input", () => {
            cleanWa();
            validateWa(false);
        });

        waInput.addEventListener("paste", () => {
            setTimeout(() => {
                cleanWa();
                validateWa(false);
            }, 0);
        });

        waInput.addEventListener("blur", () => {
            validateWa(true);
        });
    }

    function validateWa(showEmptyError = false) {
        if (!waInput || !waError) return true;
        const val = waInput.value.trim();

        if (!val) {
            if (showEmptyError) {
                waError.textContent = "Nomor WhatsApp wajib diisi.";
                waError.classList.remove("hidden");
                return false;
            }
            waError.textContent = "";
            waError.classList.add("hidden");
            return true;
        }

        // Format Indonesia: diawali 08 atau 628, panjang 10-15 digit
        const regex = /^(62|0)8[0-9]{8,12}$/;
        if (!regex.test(val)) {
            waError.textContent =
                "Nomor WhatsApp tidak valid. Diawali 08 atau 628, panjang 10–15 digit (contoh: 08123456789).";
            waError.classList.remove("hidden");
            return false;
        }

        waError.textContent = "";
        waError.classList.add("hidden");
        return true;
    }

    // 2. Email: trim, toLowerCase, dan cek format pada blur
    if (emailInput) {
        const validateEmail = () => {
            if (!emailError) return true;
            emailInput.value = emailInput.value.trim().toLowerCase();
            const val = emailInput.value;

            if (!val) {
                emailError.textContent = "";
                emailError.classList.add("hidden");
                return true;
            }

            const emailRegex =
                /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(val)) {
                emailError.textContent =
                    "Format email tidak valid. Mohon gunakan email yang aktif.";
                emailError.classList.remove("hidden");
                return false;
            }

            emailError.textContent = "";
            emailError.classList.add("hidden");
            return true;
        };

        emailInput.addEventListener("blur", validateEmail);
        emailInput.addEventListener("input", () => {
            if (!emailError.classList.contains("hidden")) {
                validateEmail();
            }
        });
    }

    // 3. Submit Validation
    form.addEventListener("submit", (e) => {
        const isWaValid = validateWa(true);
        let isEmailValid = true;

        if (emailInput && emailInput.value.trim() !== "") {
            emailInput.value = emailInput.value.trim().toLowerCase();
            const emailRegex =
                /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailRegex.test(emailInput.value)) {
                if (emailError) {
                    emailError.textContent =
                        "Format email tidak valid. Mohon gunakan email yang aktif.";
                    emailError.classList.remove("hidden");
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
                submitBtn.classList.remove("opacity-60", "cursor-not-allowed");
                const span = submitBtn.querySelector("span");
                if (span) span.textContent = "Ajukan / Pesan Jasa";
            }
            return false;
        }

        // Cegah double submit saat valid
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.classList.add("opacity-60", "cursor-not-allowed");
            const span = submitBtn.querySelector("span");
            if (span) span.textContent = "Mengirim...";
        }
    });
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", setupFormValidation);
} else {
    setupFormValidation();
}

// =====================================================================
// [BARU] Validasi karakter untuk field selain WhatsApp & email.
// Simbol seperti !@#$%^&*() dihapus otomatis saat mengetik / paste,
// dan form tidak bisa dikirim kalau masih ada isian yang tidak valid.
// =====================================================================
const TEXT_FIELDS = {
    nama_lengkap: {
        label: "Nama lengkap",
        required: true,
        min: 3,
        multiline: false,
        strip: /[^\p{L}\p{M} .'\-]/gu,
        need: /\p{L}/u,
        needMsg: "harus mengandung huruf",
        hint: "huruf, spasi, titik, apostrof (') dan tanda hubung (-)",
    },
    nama_perusahaan: {
        label: "Nama perusahaan",
        required: false,
        min: 0,
        multiline: false,
        strip: /[^\p{L}\p{M}\p{N} .,'\-]/gu,
        need: /[\p{L}\p{N}]/u,
        needMsg: "harus mengandung huruf atau angka",
        hint: "huruf, angka, spasi, titik, koma, apostrof (') dan tanda hubung (-)",
    },
    alamat_proyek: {
        label: "Alamat proyek",
        required: true,
        min: 10,
        multiline: true,
        strip: /[^\p{L}\p{M}\p{N} \n.,'\-\/]/gu,
        need: /[\p{L}\p{N}]/u,
        needMsg: "harus mengandung huruf atau angka",
        hint: "huruf, angka, spasi, titik, koma, apostrof ('), tanda hubung (-) dan garis miring (/)",
    },
    posisi_bangunan: {
        label: "Arah/posisi bangunan",
        required: false,
        min: 0,
        multiline: false,
        strip: /[^\p{L}\p{M}\p{N} .,'\-\/]/gu,
        need: /[\p{L}\p{N}]/u,
        needMsg: "harus mengandung huruf atau angka",
        hint: "huruf, angka, spasi, titik, koma, apostrof ('), tanda hubung (-) dan garis miring (/)",
    },
    kebutuhan_proyek: {
        label: "Kebutuhan proyek",
        required: true,
        min: 10,
        multiline: true,
        strip: /[^\p{L}\p{M}\p{N} \n.,'\-\/:?]/gu,
        need: /[\p{L}\p{N}]/u,
        needMsg: "harus mengandung huruf atau angka",
        hint: "huruf, angka, spasi, titik, koma, apostrof ('), tanda hubung (-), garis miring (/), titik dua (:) dan tanda tanya (?)",
    },
    catatan_tambahan: {
        label: "Catatan tambahan",
        required: false,
        min: 0,
        multiline: true,
        strip: /[^\p{L}\p{M}\p{N} \n.,'\-\/:?]/gu,
        need: /[\p{L}\p{N}]/u,
        needMsg: "harus mengandung huruf atau angka",
        hint: "huruf, angka, spasi, titik, koma, apostrof ('), tanda hubung (-), garis miring (/), titik dua (:) dan tanda tanya (?)",
    },
};

const NUMBER_FIELDS = {
    luas_bangunan: { label: "Luas bangunan" },
    luas_lahan: { label: "Luas lahan" },
};

function normalizeQuotes(v) {
    return v.replace(/[\u2018\u2019]/g, "'");
}

function cleanText(value, cfg) {
    let v = normalizeQuotes(value).replace(cfg.strip, "");
    v = v.replace(/ {2,}/g, " ");
    if (cfg.multiline) v = v.replace(/\n{3,}/g, "\n\n");
    return v.replace(/^\s+/, "");
}

function cleanNumber(value) {
    return value.replace(/\D/g, "").replace(/^0+/, "");
}

// Terapkan pembersihan sambil menjaga posisi kursor
function applySanitize(el, fn) {
    const before = el.value;
    const pos = el.selectionStart;
    const after = fn(before);
    if (after === before) return false;
    const newPos =
        pos === null ? after.length : fn(before.slice(0, pos)).length;
    el.value = after;
    try {
        el.setSelectionRange(newPos, newPos);
    } catch (_) {
        /* abaikan */
    }
    return true;
}

function getFieldError(el) {
    let p = el.parentElement.querySelector('[data-err-for="' + el.id + '"]');
    if (!p) {
        p = document.createElement("p");
        p.className = "hidden mt-1 text-xs text-rose-600";
        p.setAttribute("data-err-for", el.id);
        el.insertAdjacentElement("afterend", p);
    }
    return p;
}

function showFieldError(el, msg) {
    const p = getFieldError(el);
    if (msg) {
        p.textContent = msg;
        p.classList.remove("hidden");
        el.setAttribute("aria-invalid", "true");
    } else {
        p.textContent = "";
        p.classList.add("hidden");
        el.removeAttribute("aria-invalid");
    }
}

function validateTextField(el, cfg) {
    const v = normalizeQuotes(el.value).trim();

    if (!v) return cfg.required ? cfg.label + " wajib diisi." : "";
    if (cfg.min && v.length < cfg.min)
        return cfg.label + " minimal " + cfg.min + " karakter.";
    if (v.replace(cfg.strip, "") !== v)
        return cfg.label + " hanya boleh berisi " + cfg.hint + ".";
    if (!cfg.need.test(v)) return cfg.label + " " + cfg.needMsg + ".";
    return "";
}

function validateNumberField(el, cfg) {
    const v = el.value.trim();
    if (!v) return "";
    if (!/^[0-9]+$/.test(v)) return cfg.label + " hanya boleh berisi angka.";
    const n = Number(v);
    if (n < 1 || n > 1000000)
        return cfg.label + " harus antara 1 dan 1.000.000.";
    return "";
}

function initTextValidation() {
    const form = document.getElementById("order-form");
    if (!form) return;

    const checks = [];

    // Field teks
    Object.keys(TEXT_FIELDS).forEach((id) => {
        const el = document.getElementById(id);
        const cfg = TEXT_FIELDS[id];
        if (!el) return;

        const run = () => {
            const msg = validateTextField(el, cfg);
            showFieldError(el, msg);
            return msg === "";
        };

        el.addEventListener("input", () => {
            const norm = normalizeQuotes(el.value);
            const hadBad = norm.replace(cfg.strip, "") !== norm;
            applySanitize(el, (v) => cleanText(v, cfg));

            if (hadBad) {
                showFieldError(
                    el,
                    cfg.label + " hanya boleh berisi " + cfg.hint + ".",
                );
            } else if (!getFieldError(el).classList.contains("hidden")) {
                run();
            }
        });

        el.addEventListener("blur", () => {
            el.value = normalizeQuotes(el.value).trim();
            run();
        });

        checks.push({ el, run });
    });

    // Field angka (luas bangunan & lahan): hanya digit 0-9
    Object.keys(NUMBER_FIELDS).forEach((id) => {
        const el = document.getElementById(id);
        const cfg = NUMBER_FIELDS[id];
        if (!el) return;

        // type=number mengizinkan e, +, -, . -> ubah jadi teks numerik agar bisa difilter penuh
        el.setAttribute("type", "text");
        el.setAttribute("inputmode", "numeric");
        el.setAttribute("maxlength", "7");
        el.setAttribute("autocomplete", "off");

        const run = () => {
            const msg = validateNumberField(el, cfg);
            showFieldError(el, msg);
            return msg === "";
        };

        el.addEventListener("input", () => {
            const hadBad = /\D/.test(el.value);
            applySanitize(el, cleanNumber);

            if (hadBad) {
                showFieldError(el, cfg.label + " hanya boleh berisi angka.");
            } else if (!getFieldError(el).classList.contains("hidden")) {
                run();
            }
        });

        el.addEventListener("blur", run);
        checks.push({ el, run });
    });

    // Jenis layanan wajib dipilih
    const layanan = document.getElementById("layanan_id");
    if (layanan) {
        const run = () => {
            const msg = layanan.value ? "" : "Pilih jenis layanan.";
            showFieldError(layanan, msg);
            return msg === "";
        };
        layanan.addEventListener("change", run);
        checks.push({ el: layanan, run });
    }

    // Fase capture + didaftarkan SEBELUM modul OTP, supaya selalu dicek lebih dulu
    form.addEventListener(
        "submit",
        (e) => {
            let first = null;
            checks.forEach((c) => {
                if (!c.run() && !first) first = c.el;
            });

            if (first) {
                e.preventDefault();
                e.stopImmediatePropagation();
                first.scrollIntoView({ behavior: "smooth", block: "center" });
                first.focus({ preventScroll: true });
            }
        },
        true,
    );
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initTextValidation);
} else {
    initTextValidation();
}

// 4. Modul Verifikasi Email OTP
(function () {
    const wrap = document.getElementById("email-wrap");
    if (!wrap) return;

    const form = document.getElementById("order-form");
    const email = document.getElementById("email");
    const btnSend = document.getElementById("btn-send-otp");
    const btnVerify = document.getElementById("btn-verify-otp");
    const otpBox = document.getElementById("otp-box");
    const otpInput = document.getElementById("otp-code");
    const errEl = document.getElementById("email-inline-error");
    const okEl = document.getElementById("email-inline-ok");
    const token = form ? form.querySelector('input[name="_token"]')?.value : "";

    let verifiedEmail =
        wrap.dataset.verified === "1" && email
            ? email.value.trim().toLowerCase()
            : null;
    let lastSentEmail = null;

    const showErr = (m) => {
        errEl.textContent = m;
        errEl.classList.remove("hidden");
        okEl.classList.add("hidden");
    };
    const clearErr = () => {
        errEl.textContent = "";
        errEl.classList.add("hidden");
    };
    const isFormatOk = (v) =>
        /^[a-zA-Z0-9._+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$/.test(v);

    async function post(url, body) {
        const res = await fetch(url, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify(body),
        });
        const data = await res.json().catch(() => ({}));
        if (!res.ok) {
            const first = data.errors ? Object.values(data.errors)[0][0] : null;
            throw new Error(
                first || data.message || "Terjadi kesalahan. Coba lagi.",
            );
        }
        return data;
    }

    // Email diubah
    email.addEventListener("input", () => {
        // Hanya huruf, angka dan . _ - + @ ; karakter lain (!#$%^&*( dst) dihapus, maksimal satu @
        email.value = email.value
            .replace(/[^a-zA-Z0-9._+\-@]/g, "")
            .replace(/@(?=.*@)/g, "");
        const currentEmail = email.value.trim().toLowerCase();

        if (verifiedEmail && currentEmail !== verifiedEmail) {
            verifiedEmail = null;
            okEl.classList.add("hidden");
            wrap.dataset.verified = "0";
        }

        clearErr();

        // Pertahankan kotak OTP tetap terbuka jika email sama dengan yang diminta kodenya
        if (lastSentEmail && currentEmail === lastSentEmail && !verifiedEmail) {
            otpBox.classList.remove("hidden");
            otpBox.style.display = "flex";
        } else if (lastSentEmail && currentEmail !== lastSentEmail) {
            otpBox.classList.add("hidden");
            otpBox.style.display = "none";
            btnSend.disabled = false;
            btnSend.textContent = "Kirim Kode";
        }
    });

    email.addEventListener("blur", () => {
        const v = email.value.trim().toLowerCase();
        if (v && !isFormatOk(v)) {
            showErr("Format email tidak valid.");
        }
    });

    // Kirim kode verifikasi
    btnSend.addEventListener("click", async () => {
        const v = email.value.trim().toLowerCase();
        if (!isFormatOk(v)) {
            return showErr("Masukkan alamat email yang valid terlebih dahulu.");
        }
        clearErr();
        btnSend.disabled = true;
        btnSend.textContent = "Mengirim...";
        try {
            const data = await post(wrap.dataset.sendUrl, { email: v });
            lastSentEmail = v;
            otpBox.classList.remove("hidden");
            otpBox.style.display = "flex";
            otpInput.value = "";
            otpInput.focus();
            okEl.textContent = data.message;
            okEl.classList.remove("hidden");

            // Tombol Kirim Ulang aktif kembali dalam 2 detik tanpa jeda/peringatan 1 menit
            setTimeout(() => {
                btnSend.disabled = false;
                btnSend.textContent = "Kirim Ulang";
            }, 2000);
        } catch (e) {
            showErr(e.message);
            btnSend.disabled = false;
            btnSend.textContent = "Kirim Kode";
        }
    });

    otpInput.addEventListener("input", () => {
        otpInput.value = otpInput.value.replace(/\D/g, "").slice(0, 6);
        clearErr();
    });

    // Tekan Enter pada kotak kode langsung memicu verifikasi
    otpInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            e.preventDefault();
            e.stopPropagation();
            executeVerification();
        }
    });

    // Fungsi verifikasi OTP
    async function executeVerification() {
        const targetEmail = (lastSentEmail || email.value).trim().toLowerCase();
        email.value = targetEmail;

        if (otpInput.value.length !== 6) {
            showErr("Masukkan 6 digit kode verifikasi.");
            otpInput.focus();
            return false;
        }

        clearErr();
        btnVerify.disabled = true;
        btnVerify.textContent = "Memeriksa...";

        try {
            const res = await post(wrap.dataset.verifyUrl, {
                email: targetEmail,
                code: otpInput.value,
            });
            verifiedEmail = targetEmail;
            wrap.dataset.verified = "1";
            otpBox.classList.add("hidden");
            otpBox.style.display = "none";
            otpInput.value = "";
            okEl.textContent = res.message || "✓ Email terverifikasi";
            okEl.classList.remove("hidden");
            return true;
        } catch (e) {
            showErr(e.message);
            return false;
        } finally {
            btnVerify.disabled = false;
            btnVerify.textContent = "Verifikasi";
        }
    }

    btnVerify.addEventListener("click", async () => {
        await executeVerification();
    });

    // Blokir submit jika email diisi tapi belum diverifikasi (fase capture)
    form.addEventListener(
        "submit",
        async (ev) => {
            const v = email.value.trim().toLowerCase();
            if (v && v !== verifiedEmail) {
                // Jika user sudah memasukkan 6 digit kode di form, otomatis verifikasi sebelum submit
                if (otpInput && otpInput.value.length === 6) {
                    ev.preventDefault();
                    ev.stopImmediatePropagation();
                    const ok = await executeVerification();
                    if (ok) {
                        const submitBtn = document.getElementById("btn-submit");
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            submitBtn.classList.add(
                                "opacity-60",
                                "cursor-not-allowed",
                            );
                            const span = submitBtn.querySelector("span");
                            if (span) span.textContent = "Mengirim...";
                        }
                        form.submit();
                    }
                    return false;
                }

                ev.preventDefault();
                ev.stopImmediatePropagation();
                showErr(
                    'Email belum diverifikasi. Masukkan 6 digit kode dari email Anda lalu klik "Verifikasi".',
                );
                email.scrollIntoView({ behavior: "smooth", block: "center" });
                const btn = document.getElementById("btn-submit");
                if (btn) {
                    btn.disabled = false;
                    btn.classList.remove("opacity-60", "cursor-not-allowed");
                    const span = btn.querySelector("span");
                    if (span) span.textContent = "Ajukan / Pesan Jasa";
                }
            }
        },
        true,
    );
})();
