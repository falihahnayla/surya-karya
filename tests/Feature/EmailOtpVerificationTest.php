<?php

namespace Tests\Feature;

use App\Mail\EmailOtpMail;
use App\Models\Layanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class EmailOtpVerificationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
        session()->flush();
    }

    /** Uji 1: Domain tidak ditemukan ditolak */
    public function test_1_fake_domain_rejected(): void
    {
        $response = $this->postJson(route('frontend.email.send'), [
            'email' => 'a@domain-ngawur-xyz123.com',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
        $this->assertStringContainsString('Domain email tidak ditemukan', $response->json('errors.email.0'));
    }

    /** Uji 2: Email sekali pakai (disposable) ditolak */
    public function test_2_disposable_email_rejected(): void
    {
        $response = $this->postJson(route('frontend.email.send'), [
            'email' => 'x@mailinator.com',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
        $this->assertStringContainsString('Email sementara/sekali pakai tidak diperbolehkan', $response->json('errors.email.0'));
    }

    /** Uji 3: Kode salah dan pembatasan maksimal salah 5 kali */
    public function test_3_wrong_otp_and_max_tries(): void
    {
        Mail::fake();
        $email = 'testuser@gmail.com';

        // Kirim kode
        $this->postJson(route('frontend.email.send'), ['email' => $email])
             ->assertStatus(200);

        // Coba 1-5 kali kode salah
        for ($i = 1; $i <= 5; $i++) {
            $res = $this->postJson(route('frontend.email.verify'), [
                'email' => $email,
                'code'  => '000000',
            ]);
            $res->assertStatus(422)
                ->assertJson(['message' => 'Kode salah. Sisa percobaan: ' . (5 - $i) . '.']);
        }

        // Coba ke-6 kali setelah 5 kali salah
        $res6 = $this->postJson(route('frontend.email.verify'), [
            'email' => $email,
            'code'  => '000000',
        ]);
        $res6->assertStatus(429)
             ->assertJson(['message' => 'Terlalu banyak percobaan salah. Silakan minta kode baru.']);
    }

    /** Uji 4: Email asli dan kode OTP benar */
    public function test_4_correct_otp_verifies_successfully(): void
    {
        Mail::fake();
        $email = 'testuser@gmail.com';

        $this->postJson(route('frontend.email.send'), ['email' => $email])
             ->assertStatus(200);

        Mail::assertSent(EmailOtpMail::class, function ($mail) use ($email) {
            $code = $mail->code;

            $verifyResponse = $this->postJson(route('frontend.email.verify'), [
                'email' => $email,
                'code'  => $code,
            ]);

            $verifyResponse->assertStatus(200)
                           ->assertJson(['message' => 'Email berhasil diverifikasi.']);

            $this->assertEquals($email, session('verified_email'));
            return true;
        });
    }

    /** Uji 6: Lewati JS (POST submit dengan email yang belum diverifikasi) ditolak server */
    public function test_6_submit_unverified_email_rejected_by_server(): void
    {
        $layanan = Layanan::first() ?? Layanan::create(['title' => 'Pembangunan Rumah', 'description' => 'Test']);

        $response = $this->post(route('frontend.form-pesanan.store'), [
            'nama_lengkap'     => 'Budi Santoso',
            'nomor_whatsapp'   => '081234567890',
            'email'            => 'unverified@gmail.com',
            'alamat_proyek'    => 'Jl. Sudirman No 123 Jakarta Pusat',
            'layanan_id'       => $layanan->id,
            'kebutuhan_proyek' => 'Pembangunan rumah tinggal lantai 2 minimalis.',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertStringContainsString('Email belum diverifikasi', session('errors')->first('email'));
    }

    /** Uji 8: Form dapat disubmit jika email dikosongkan */
    public function test_8_submit_empty_email_allowed(): void
    {
        $layanan = Layanan::first() ?? Layanan::create(['title' => 'Pembangunan Rumah', 'description' => 'Test']);

        $response = $this->post(route('frontend.form-pesanan.store'), [
            'nama_lengkap'     => 'Budi Santoso',
            'nomor_whatsapp'   => '081234567890',
            'email'            => '',
            'alamat_proyek'    => 'Jl. Sudirman No 123 Jakarta Pusat',
            'layanan_id'       => $layanan->id,
            'kebutuhan_proyek' => 'Pembangunan rumah tinggal lantai 2 minimalis.',
        ]);

        $response->assertSessionHas('success', true);
    }

    /** Uji 9: Kirim ulang kode tidak diblokir peringatan 1 menit */
    public function test_9_resend_code_does_not_show_one_minute_warning(): void
    {
        Mail::fake();
        $email = 'cooldown@gmail.com';

        $this->postJson(route('frontend.email.send'), ['email' => $email])
             ->assertStatus(200);

        // Request kedua langsung diizinkan tanpa peringatan 1 menit
        $res = $this->postJson(route('frontend.email.send'), ['email' => $email]);
        $res->assertStatus(200);
    }

    /** Uji 7: Email diverifikasi lalu diubah, submit email baru ditolak server */
    public function test_7_verified_email_changed_is_rejected(): void
    {
        $layanan = Layanan::first() ?? Layanan::create(['title' => 'Pembangunan Rumah', 'description' => 'Test']);
        $originalEmail = 'verified.email@gmail.com';
        $changedEmail = 'changed.email@gmail.com';

        // Simulasikan session terverifikasi dengan originalEmail
        session([
            'verified_email'    => $originalEmail,
            'verified_email_at' => now()->timestamp,
        ]);

        // Submit form dengan changedEmail
        $response = $this->post(route('frontend.form-pesanan.store'), [
            'nama_lengkap'     => 'Budi Santoso',
            'nomor_whatsapp'   => '081234567890',
            'email'            => $changedEmail,
            'alamat_proyek'    => 'Jl. Sudirman No 123 Jakarta Pusat',
            'layanan_id'       => $layanan->id,
            'kebutuhan_proyek' => 'Pembangunan rumah tinggal lantai 2 minimalis.',
        ]);

        $response->assertSessionHasErrors(['email']);
        $this->assertStringContainsString('Email belum diverifikasi', session('errors')->first('email'));
    }

    /** Uji 10: Setelah order tersimpan, session verified_email terhapus */
    public function test_10_verified_email_session_cleared_after_order(): void
    {
        $layanan = Layanan::first() ?? Layanan::create(['title' => 'Pembangunan Rumah', 'description' => 'Test']);
        $email = 'budi.santoso@gmail.com';

        // Simulasikan session terverifikasi
        session([
            'verified_email'    => $email,
            'verified_email_at' => now()->timestamp,
        ]);

        $response = $this->post(route('frontend.form-pesanan.store'), [
            'nama_lengkap'     => 'Budi Santoso',
            'nomor_whatsapp'   => '081234567890',
            'email'            => $email,
            'alamat_proyek'    => 'Jl. Sudirman No 123 Jakarta Pusat',
            'layanan_id'       => $layanan->id,
            'kebutuhan_proyek' => 'Pembangunan rumah tinggal lantai 2 minimalis.',
        ]);

        $response->assertSessionHas('success', true);
        $this->assertNull(session('verified_email'));
        $this->assertNull(session('verified_email_at'));
    }

    /** Uji 11: Email A maksimal 5 kali kirim dalam 1 jam, ke-6 ditolak */
    public function test_11_max_5_sends_per_hour_for_email_a(): void
    {
        Mail::fake();
        $email = 'emaila@gmail.com';
        $cdKey = 'otp_cd:' . sha1($email);

        for ($i = 1; $i <= 5; $i++) {
            Cache::forget($cdKey); // lewati cooldown 60s untuk menguji batas per jam
            $res = $this->postJson(route('frontend.email.send'), ['email' => $email]);
            $res->assertStatus(200);
        }

        // Permintaan ke-6 dalam jam yang sama harus ditolak
        Cache::forget($cdKey);
        $res6 = $this->postJson(route('frontend.email.send'), ['email' => $email]);
        $res6->assertStatus(429)
             ->assertJsonPath('message', fn ($msg) => str_contains($msg, 'Batas pengiriman kode untuk email ini telah tercapai'));
    }

    /** Uji 12: Setelah 1 jam berlalu, email A dapat meminta kode kembali */
    public function test_12_email_a_can_send_again_after_one_hour(): void
    {
        Mail::fake();
        $email = 'emaila_reset@gmail.com';
        $cdKey = 'otp_cd:' . sha1($email);

        for ($i = 1; $i <= 5; $i++) {
            Cache::forget($cdKey);
            $this->postJson(route('frontend.email.send'), ['email' => $email])->assertStatus(200);
        }

        // Travel 61 menit ke masa depan
        $this->travel(61)->minutes();

        Cache::forget($cdKey);
        $res = $this->postJson(route('frontend.email.send'), ['email' => $email]);
        $res->assertStatus(200);
    }

    /** Uji 13: Email B pada device/IP yang sama memiliki kuota 5 permintaan sendiri */
    public function test_13_email_b_has_independent_quota_on_same_device(): void
    {
        Mail::fake();
        $emailA = 'user_device_a@gmail.com';
        $emailB = 'user_device_b@gmail.com';

        // Habiskan kuota Email A
        for ($i = 1; $i <= 5; $i++) {
            Cache::forget('otp_cd:' . sha1($emailA));
            $this->postJson(route('frontend.email.send'), ['email' => $emailA])->assertStatus(200);
        }

        // Email A ditolak pada permintaan ke-6
        Cache::forget('otp_cd:' . sha1($emailA));
        $this->postJson(route('frontend.email.send'), ['email' => $emailA])->assertStatus(429);

        // Email B pada IP/device yang sama harus tetap bisa kirim 5 kali
        for ($i = 1; $i <= 5; $i++) {
            Cache::forget('otp_cd:' . sha1($emailB));
            $this->postJson(route('frontend.email.send'), ['email' => $emailB])->assertStatus(200);
        }
    }

    /** Uji 14: Kode ditolak setelah benar-benar kedaluwarsa (> 10 menit) */
    public function test_14_code_rejected_after_expiration(): void
    {
        Mail::fake();
        $email = 'expire_test@gmail.com';

        $this->postJson(route('frontend.email.send'), ['email' => $email])->assertStatus(200);

        Mail::assertSent(EmailOtpMail::class, function ($mail) use ($email) {
            $code = $mail->code;

            // Travel 11 menit (melewati masa berlaku 10 menit)
            $this->travel(11)->minutes();

            $res = $this->postJson(route('frontend.email.verify'), [
                'email' => $email,
                'code'  => $code,
            ]);

            $res->assertStatus(422)
                ->assertJson(['message' => 'Kode verifikasi telah kedaluwarsa. Silakan minta kode baru.']);
            return true;
        });
    }

    /** Uji 15: Percobaan verifikasi gagal tidak mengurangi kuota kirim email */
    public function test_15_failed_verifications_do_not_reduce_send_quota(): void
    {
        Mail::fake();
        $email = 'verify_fail_test@gmail.com';

        // Kirim kode pertama
        $this->postJson(route('frontend.email.send'), ['email' => $email])->assertStatus(200);

        // Coba kode salah 3 kali
        for ($i = 1; $i <= 3; $i++) {
            $this->postJson(route('frontend.email.verify'), [
                'email' => $email,
                'code'  => '999999',
            ])->assertStatus(422);
        }

        // Kuota kirim kode harus masih ada (kirim ke-2, 3, 4, 5 masih bisa)
        for ($i = 2; $i <= 5; $i++) {
            Cache::forget('otp_cd:' . sha1($email));
            $this->postJson(route('frontend.email.send'), ['email' => $email])->assertStatus(200);
        }
    }

    /** Uji 16: Kode dari email A tidak dapat digunakan untuk memverifikasi email B */
    public function test_16_code_from_email_a_cannot_verify_email_b(): void
    {
        Mail::fake();
        $emailA = 'sender_a@gmail.com';
        $emailB = 'sender_b@gmail.com';

        $this->postJson(route('frontend.email.send'), ['email' => $emailA])->assertStatus(200);

        Mail::assertSent(EmailOtpMail::class, function ($mail) use ($emailB) {
            $codeA = $mail->code;

            // Gunakan kode email A untuk memverifikasi email B
            $res = $this->postJson(route('frontend.email.verify'), [
                'email' => $emailB,
                'code'  => $codeA,
            ]);

            // Email B belum pernah meminta kode verifikasi
            $res->assertStatus(422)
                ->assertJson(['message' => 'Kode verifikasi belum diminta. Silakan kirim kode terlebih dahulu.']);
            return true;
        });
    }

    /** Uji 17: Alur penuh permintaan kode -> verifikasi -> submit order sukses */
    public function test_17_full_cycle_request_code_verify_and_submit_order(): void
    {
        Mail::fake();
        $email = 'sukses.flow@gmail.com';

        // 1. Minta kode
        $this->postJson(route('frontend.email.send'), ['email' => $email])->assertStatus(200);

        // 2. Dapatkan kode dan lakukan verifikasi
        Mail::assertSent(EmailOtpMail::class, function ($mail) use ($email) {
            $code = $mail->code;

            $resVerify = $this->postJson(route('frontend.email.verify'), [
                'email' => $email,
                'code'  => $code,
            ]);

            $resVerify->assertStatus(200)
                      ->assertJson(['message' => 'Email berhasil diverifikasi.']);
            return true;
        });

        // 3. Submit form order dengan email tersebut
        $layanan = Layanan::first() ?? Layanan::create(['title' => 'Renovasi Rumah', 'description' => 'Test']);

        $resOrder = $this->post(route('frontend.form-pesanan.store'), [
            'nama_lengkap'     => 'Ahmad Dahlan',
            'nomor_whatsapp'   => '081234567891',
            'email'            => $email,
            'alamat_proyek'    => 'Jl. Pahlawan No 45 Surabaya',
            'layanan_id'       => $layanan->id,
            'kebutuhan_proyek' => 'Renovasi dapur dan ruang keluarga modern.',
        ]);

        $resOrder->assertSessionHas('success', true);
        $this->assertDatabaseHas('orders', [
            'name'  => 'Ahmad Dahlan',
            'email' => $email,
        ]);
    }

    /** Uji 18: Memverifikasi email yang sudah diverifikasi tidak menampilkan error */
    public function test_18_verify_when_already_verified_returns_200(): void
    {
        Mail::fake();
        $email = 'double.click@gmail.com';

        $this->postJson(route('frontend.email.send'), ['email' => $email])->assertStatus(200);

        Mail::assertSent(EmailOtpMail::class, function ($mail) use ($email) {
            $code = $mail->code;

            // Verifikasi pertama
            $this->postJson(route('frontend.email.verify'), [
                'email' => $email,
                'code'  => $code,
            ])->assertStatus(200);

            // Verifikasi kedua (misal user klik lagi atau double click)
            $res2 = $this->postJson(route('frontend.email.verify'), [
                'email' => $email,
                'code'  => $code,
            ]);
            $res2->assertStatus(200)
                 ->assertJson(['message' => 'Email berhasil diverifikasi.']);

            return true;
        });
    }
}


