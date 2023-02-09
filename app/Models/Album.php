<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'spotify',
        'apple',
        'photo',
    ];

    public function songs()
    {
        return $this->hasMany(Song::class, 'album_id');
    }
}
