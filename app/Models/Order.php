<?php

namespace App\Models;

use App\Models\User;
use App\Models\Order_item;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable=['user_id','quantity','price','status'];
    public function order_item(){
        return $this->hasMany(Order_item::class);
    }

    public function User(){
        return $this->belongsTo(User::class);
    }

}