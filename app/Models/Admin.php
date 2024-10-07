<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Review;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Favorite;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Authenticatable
{
    use HasApiTokens;
    
    protected $fillable = [
        'id',
        'email',
        'password'
    ];
}
