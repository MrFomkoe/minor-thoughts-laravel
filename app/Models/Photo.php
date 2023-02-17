<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
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
}
