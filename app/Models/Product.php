<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Str;

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
        'sku',
        'status',
        'stock',
        'description',
        'price',
    ];

    /**
     * Get the wishlists that include this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Wishlist>
     */

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    /**
     * Get the carts that contain this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<Cart>
     */
    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Get the product images that belong to this product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<ProductImage>
     */
    public function productImages()
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

    /**
     * Set the slug attribute for the category.
     *
     * @param string $value The value to be converted into a slug.
     */
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    /**
     * Get the formatted product price in IDR.
     *
     * @return string
     */
    public function getFormattedPriceAttribute()
    {
        return 'IDR ' . number_format($this->attributes['price'], 2, ',', '.');
    }

    public function getFormattedStockAttribute()
    {
        return (number_format($this->attributes['stock']) . __(' pcs'));
    }

}
