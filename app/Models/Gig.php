<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gig extends Model
{
    use HasFactory;

    protected $fillable = [
        'venue',
        'date',
        'upcoming',
        'place',
        'link',
    ];

    public function photos () {
        return $this->hasMany(Photo::class, 'photo_id');
    }

    public function photo()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
}
