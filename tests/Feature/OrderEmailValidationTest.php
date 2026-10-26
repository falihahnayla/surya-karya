<?php

namespace Tests\Feature;

use App\Models\Layanan;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderEmailValidationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware(\Illuminate\Routing\Middleware\ThrottleRequests::class);
        Setting::create([
            'company' => 'PT Surya Karya',
            'whatsapp' => '081234567890',
        ]);
    }

    private function validPayload(array $overrides = []): array
    {
        $layanan = Layanan::firstOrCreate(
            ['title' => 'Pembangunan Rumah']
        );

        return array_merge([
            'layanan_id' => $layanan->id,
            'nama_lengkap' => 'Budi Santoso',
            'nomor_whatsapp' => '081234567890',
            'email' => 'budi.santoso_1+test@gmail.com',
            'alamat_proyek' => 'Jl. Pemuda No. 10 Surabaya Jawa Timur',
            'luas_bangunan' => 120,
            'luas_lahan' => 150,
            'kebutuhan_proyek' => 'Pembangunan rumah tinggal 2 lantai minimalis',
            'catatan_tambahan' => 'Mohon survei lokasi segera',
        ], $overrides);
    }

    /** Uji 1: Pemesanan berhasil tanpa verifikasi OTP email */
    public function test_order_submission_succeeds_without_otp_verification(): void
    {
        $payload = $this->validPayload([
            'email' => 'pelanggan.resmi@example.com',
        ]);

        $response = $this->post(route('frontend.form-pesanan.store'), $payload);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('orders', [
            'email' => 'pelanggan.resmi@example.com',
            'name' => 'Budi Santoso',
        ]);
    }

    /** Uji 2: Pemesanan berhasil dengan email kosong (nullable) */
    public function test_order_submission_succeeds_with_empty_email(): void
    {
        $payload = $this->validPayload([
            'email' => null,
        ]);

        $response = $this->post(route('frontend.form-pesanan.store'), $payload);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('orders', [
            'email' => null,
            'name' => 'Budi Santoso',
        ]);
    }

    /** Uji 3: Email dengan karakter yang diizinkan (huruf, angka, . _ - + @) lolos */
    public function test_email_with_allowed_characters_passes(): void
    {
        $allowedEmails = [
            'user.name+tag-sub_1@domain.co.id',
            'john_doe-123@sub.domain-test.com',
            'simple@domain.org',
        ];

        foreach ($allowedEmails as $email) {
            $payload = $this->validPayload(['email' => $email]);
            $response = $this->post(route('frontend.form-pesanan.store'), $payload);
            $response->assertSessionHas('success');
        }
    }

    /** Uji 4: Email dengan karakter terlarang (!#$%^&*()~ dll) ditolak */
    public function test_email_with_forbidden_symbols_is_rejected(): void
    {
        $forbiddenEmails = [
            'user#name@example.com',
            'user$money@example.com',
            'user%discount@example.com',
            'user^power@example.com',
            'user&partner@example.com',
            'user*star@example.com',
            'user(parenthesis)@example.com',
            'user!danger@example.com',
            'user~tilde@example.com',
            'user<bracket>@example.com',
        ];

        foreach ($forbiddenEmails as $email) {
            $payload = $this->validPayload(['email' => $email]);
            $response = $this->post(route('frontend.form-pesanan.store'), $payload);

            $response->assertSessionHasErrors(['email']);
        }
    }

    /** Uji 5: Validasi nomor WhatsApp tetap terjaga */
    public function test_whatsapp_validation_remains_intact(): void
    {
        $invalidPayload = $this->validPayload(['nomor_whatsapp' => '12345']);
        $response = $this->post(route('frontend.form-pesanan.store'), $invalidPayload);
        $response->assertSessionHasErrors(['nomor_whatsapp']);

        $validPayload = $this->validPayload(['nomor_whatsapp' => '081234567890']);
        $response = $this->post(route('frontend.form-pesanan.store'), $validPayload);
        $response->assertSessionHas('success');
    }
}
