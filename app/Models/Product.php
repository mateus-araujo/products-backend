<?php

namespace App\Models;

use App\Observers\ProductObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'id',
        'name',
        'price',
        'quantity'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'price' => 'float'
    ];

    /**
     * Get the history from product.
     */
    public function history()
    {
        return $this->hasMany(ProductHistory::class);
    }

    protected static function booted()
    {
        Product::observe(ProductObserver::class);
    }
}
