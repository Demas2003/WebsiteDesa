<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\News;
use App\Models\Potential;
use App\Models\Profile;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Profile::create([
            'village_name' => 'Desa Trengguli',
            'description' => 'Deskripsi desa.',
            'vision' => 'Visi desa.',
            'mission' => 'Misi desa.',
            'address' => 'Jl. Desa No. 1',
            'phone' => '0271123456',
            'email' => 'desa@example.com',
            'office_hours' => 'Senin - Jumat 08.00 - 16.00',
        ]);
    }

    private function makeNews(array $attributes = []): News
    {
        return News::create(array_merge([
            'title' => 'Berita Uji',
            'excerpt' => 'Ringkasan berita.',
            'content' => '<p>Konten berita.</p>',
            'image' => 'news/uji.jpg',
            'status' => 'published',
            'published_at' => now()->subDay(),
        ], $attributes));
    }

    public function test_home_page_is_accessible(): void
    {
        $this->get('/')->assertOk();
    }

    public function test_news_list_only_shows_published_news(): void
    {
        $published = $this->makeNews(['title' => 'Berita Publik']);
        $draft = $this->makeNews(['title' => 'Berita Draft', 'status' => 'draft']);
        $future = $this->makeNews([
            'title' => 'Berita Masa Depan',
            'published_at' => now()->addDay(),
        ]);

        $response = $this->get('/berita');

        $response->assertOk()
            ->assertSee($published->title)
            ->assertDontSee($draft->title)
            ->assertDontSee($future->title);
    }

    public function test_news_detail_is_accessible_and_increments_views(): void
    {
        $news = $this->makeNews();

        $this->get(route('news.detail', $news->slug))->assertOk();

        $this->assertSame(1, $news->fresh()->view_count);
    }

    public function test_draft_news_detail_returns_not_found(): void
    {
        $news = $this->makeNews(['status' => 'draft']);

        $this->get(route('news.detail', $news->slug))->assertNotFound();
    }

    public function test_gallery_and_potential_pages_are_accessible(): void
    {
        Gallery::create([
            'title' => 'Foto Kegiatan',
            'description' => 'Deskripsi foto.',
            'category' => 'kegiatan',
            'image' => 'gallery/foto.jpg',
            'status' => 'active',
        ]);

        $potential = Potential::create([
            'title' => 'Potensi Kopi',
            'content' => 'Konten potensi.',
            'image' => 'potentials/kopi.jpg',
        ]);

        Service::create([
            'title' => 'Layanan Surat',
            'icon' => 'fas fa-envelope',
            'description' => 'Deskripsi layanan.',
            'status' => 'active',
            'order' => 1,
        ]);

        $this->get('/galeri')->assertOk()->assertSee('Foto Kegiatan');
        $this->get('/potensi-desa')->assertOk()->assertSee('Potensi Kopi');
        $this->get(route('potential.detail', $potential->id))
            ->assertOk()
            ->assertSee('Potensi Kopi');
    }
}
