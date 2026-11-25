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
        
        static::creating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
        
        static::updating(function ($news) {
            $news->slug = Str::slug($news->title);
        });
    }
}
