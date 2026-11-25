<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_admin_login(): void
    {
        $this->get('/admin/dashboard')->assertRedirect('/admin/login');
    }

    public function test_admin_login_page_is_accessible(): void
    {
        $this->get('/admin/login')->assertOk();
    }

    public function test_admin_can_login_with_valid_credentials(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->post('/admin/login', [
            'email' => $user->email,
            'password' => 'password',
        ])->assertRedirect('/admin/dashboard');

        $this->assertAuthenticatedAs($user);
    }

    public function test_admin_cannot_login_with_invalid_password(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->from('/admin/login')->post('/admin/login', [
            'email' => $user->email,
            'password' => 'salah',
        ])->assertRedirect('/admin/login')->assertSessionHasErrors('email');

        $this->assertGuest();
    }

    public function test_authenticated_admin_can_access_dashboard(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get('/admin/dashboard')->assertOk();
    }

    public function test_admin_can_create_news_and_slug_is_unique(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $payload = [
            'title' => 'Berita Sama',
            'content' => '<p>Konten berita.</p>',
            'status' => 'published',
            'published_at' => now()->format('Y-m-d H:i:s'),
            'image' => UploadedFile::fake()->image('berita.jpg'),
        ];

        $this->actingAs($user)
            ->post(route('admin.news.store'), $payload)
            ->assertRedirect(route('admin.news.index'));

        $this->actingAs($user)
            ->post(route('admin.news.store'), array_merge($payload, [
                'image' => UploadedFile::fake()->image('berita-2.jpg'),
            ]))
            ->assertRedirect(route('admin.news.index'));

        $this->assertDatabaseHas('news', ['slug' => 'berita-sama']);
        $this->assertDatabaseHas('news', ['slug' => 'berita-sama-2']);
    }

    public function test_potential_rejects_non_google_maps_url(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('admin.potential.store'), [
            'title' => 'Potensi Uji',
            'content' => 'Konten potensi.',
            'map_url' => 'https://example.com/peta',
            'image' => UploadedFile::fake()->image('potensi.jpg'),
        ])->assertSessionHasErrors('map_url');

        $this->assertDatabaseCount('potentials', 0);
    }

    public function test_admin_can_change_password(): void
    {
        $user = User::factory()->create(['password' => 'password-lama']);

        $this->actingAs($user)->put(route('admin.password.update'), [
            'current_password' => 'password-lama',
            'password' => 'password-baru',
            'password_confirmation' => 'password-baru',
        ])->assertRedirect(route('admin.password.edit'));

        $this->assertTrue(Hash::check('password-baru', $user->fresh()->password));
    }
}
