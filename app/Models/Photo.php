<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'gig_id',
        'featured',
    ];

    public function photoable() {
        return $this->morphTo();
    }
    
    public function scopeFilter($query, array $filters)
    {
        // Filtering depending on the query sent

        // This part checks if the query contains gig id
        if (isset($filters['gig_id']) && $filters['gig_id'] !== 'no_gig') {
            $query->where('gig_id', request('gig_id'));

        // This part is to show photos that are not related to any gigs
        } elseif (isset($filters['gig_id']) && $filters['gig_id'] == 'no_gig') {
            $query->where('gig_id', null);
        }
    }
}
