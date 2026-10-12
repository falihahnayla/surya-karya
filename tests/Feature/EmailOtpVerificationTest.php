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
            'email' => 'budi@domain-ngawur-xyz123987456.com',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
    }

    /** Uji 2: Email sekali pakai (disposable) ditolak */
    public function test_2_disposable_email_rejected(): void
    {
        $response = $this->postJson(route('frontend.email.send'), [
            'email' => 'x@mailinator.com',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['email']);
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

    /** Uji 9: Cooldown 60 detik saat kirim ulang terlalu cepat */
    public function test_9_cooldown_rate_limit(): void
    {
        Mail::fake();
        $email = 'cooldown@gmail.com';

        $this->postJson(route('frontend.email.send'), ['email' => $email])
             ->assertStatus(200);

        // Request kedua langsung
        $res = $this->postJson(route('frontend.email.send'), ['email' => $email]);
        $res->assertStatus(429)
            ->assertJson(['message' => 'Mohon tunggu 1 menit sebelum meminta kode lagi.']);
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
}

