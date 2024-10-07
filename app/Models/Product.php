<?php

namespace App\Models;

use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Order_item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'condition',
        'name',
        'description',
        'price',
        'category_id'
    ];
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function comment(){
        return $this->hasMany(Comment::class);
    }
    public function favorite(){
        return $this->hasMany(Favorite::class);
    }
    public function order_item(){
        return $this->hasOne(Order_item::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

}
