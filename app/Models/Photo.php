<?php

namespace App\Models;

use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'preview_url',
        'featured',
        'photoable_type'
    ];

    public function photoable()
    {
        return $this->morphTo();
    }

    public function scopeFilter($query, array $filters)
    {
        // Filtering depending on the query sent
        if (isset($filters['gig'])) {
            $filter = $filters['gig'];
            if ($filter == 'no-gig') {
                $query->whereNull('photoable_type');
            } else {
                $query->where([
                    ['photoable_type', 'App\Models\Gig'],
                    ['photoable_id', $filter]
                ]);
            }
        } else {
            $query->where([
                ['photoable_type', null]
            ])->orWhere([
                ['photoable_type', 'App\Models\Gig']
            ]);
        }
    }

    static public function cropStorePhotos($photo, $path = '', $width = 300, $height = 300)
    {
        // Hashing original name
        $photoName = $photo->hashName();

        // Modifying name for cropped photo
        $previewName = 'preview_' . $photoName;

        // Creating cropped photo using Intervention package
        $preview = Image::make($photo)->resize(300, null, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Saving original photo to server and creating paths
        $photoPath = $photo->storeAs('photos/' . $path , $photoName, 'public');
        $previewPath = 'photos/' . $path . 'previews/' . $previewName;

        // Saving cropped photo
        Storage::put('public/' . $previewPath, $preview->encode());

        return (object) [
            'photoPath' => $photoPath,
            'previewPath' => $previewPath,
        ];

        // return {$photoPath, $previewPath};
    }
}
