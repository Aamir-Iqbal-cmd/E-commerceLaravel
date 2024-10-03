<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'product_price',
        'quantity',
        'pro_image',
        'product_desc',
        'cat_id',
        'subcat_id' // Ensure this is included
    ];

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'subcat_id'); // Use 'subcat_id' here
    }
}
