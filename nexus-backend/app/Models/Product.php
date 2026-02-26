<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id','name','slug','description','price','old_price', 'is_flash_sale', 'image', 'rating'];
    public function category(){
        return $this->belongsTo(Category::class);
    } 
}
