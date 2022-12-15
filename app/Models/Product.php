<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\ProductCategory;
use App\Models\User;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'detail', 'price', 'discount', 'stock', 'category_id', 'user_id'
    ];


    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productAdmin()
    {
        return $this->belongsTo(User::class);
    }


}
