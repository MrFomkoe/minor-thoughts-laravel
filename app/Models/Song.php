<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'album_id',
        'spotify',
        'apple',
        'featured',
    ];

    public function album()
    {
        return $this->belongsTo(Album::class, 'album_id');
    }

    public function photo()
    {
        return $this->morphOne(Photo::class, 'photoable');
    }

    // public function getPhotoAttribute () {
    //     return $this->photo->url;
    // }
}
