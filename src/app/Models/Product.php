<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'art', 'status', 'data'];

    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Scope a query to only include available products.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available');
    }

    /**
     * Static product options
     *
     * @return \string[][]
     */
    public static function getOptions()
    {
        return ['colors' => ['white', 'black', 'green', 'olive', 'silver', 'purple', 'navy'], 'sizes' => ['XS', 'S', 'M', 'L', 'XL', 'XXL']];
    }
}
