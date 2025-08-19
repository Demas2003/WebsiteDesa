<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'village_name',
        'description',
        'vision',
        'mission',
        'address',
        'phone',
        'email',
        'office_hours',
        'facebook',
        'instagram',
        'youtube',
        'whatsapp'
    ];
}
