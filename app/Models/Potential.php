<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potential extends Model
{
    use HasFactory;

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
