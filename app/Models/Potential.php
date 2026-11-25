<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Potential extends Model
{
    use HasFactory;

    // nama tabel (opsional kalau sama dengan plural model: 'potentials')
    protected $table = 'potential';
    public $timestamps = false;

    protected $fillable = [
        'title',
        'content',
        'image',
        'map_url',
    ];

    
    /* protected static function boot()
    {
        parent::boot();

        static::creating(function ($potential) {
            $potential->slug = Str::slug($potential->title);
        });

        static::updating(function ($potential) {
            $potential->slug = Str::slug($potential->title);
        });
    } */
}
