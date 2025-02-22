<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'stock',
        'description',
        'price',
    ];

    /**
     * Get the product images that belong to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ProductImage>
     */
    public function productImage()
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
     * Get the reviews written by the users about this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Review>
     */
    public function review()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Get the category that owns the Product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the order items that belong to the product
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItem()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

        ];
    }
}
