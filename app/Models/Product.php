<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'category_id',
        'sub_category_id',
    ];

    // relationship with category
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function subcategory(){
        return $this->belongsTo(SubCategory::class);
    }

}
