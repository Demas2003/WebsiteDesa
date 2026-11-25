<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'status',
        'published_at'
    ];
    
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Berita yang boleh tampil di halaman publik:
     * statusnya "published" dan tanggal publikasinya sudah lewat
     * (atau tidak diisi, supaya berita lama tetap tampil).
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where(function ($query) {
                $query->whereNull('published_at')
                    ->orWhere('published_at', '<=', now());
            });
    }
    
    protected static function boot()
    {
        parent::boot();

        static::creating(function (News $news) {
            $news->slug = static::generateUniqueSlug($news->title);
        });

        static::updating(function (News $news) {
            if ($news->isDirty('title')) {
                $news->slug = static::generateUniqueSlug($news->title, $news->getKey());
            }
        });
    }

    /**
     * Buat slug unik dari judul. Jika sudah dipakai, tambahkan -2, -3, dst.
     */
    public static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title) ?: 'berita';
        $slug = $base;
        $suffix = 1;

        while (true) {
            $query = static::where('slug', $slug);

            if ($ignoreId) {
                $query->where('id', '!=', $ignoreId);
            }

            if (! $query->exists()) {
                return $slug;
            }

            $suffix++;
            $slug = $base.'-'.$suffix;
        }
    }
}
