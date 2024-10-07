<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Favorite;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function my_favorites(){
        $favorites=DB::table('products')
        ->join('favorites','products.id','=','favorites.product_id')
        ->select('*')
        ->where('favorites.user_id',Auth::user()->id)
        ->where('products.status','active')
        ->get();
        if(count($favorites)==0){
            return response("You have No Favorite Products ",400);
        }
        return response($favorites,200);
    }

    public function change_to($product_id){
        $p=Product::find($product_id);
        if(is_null($p)){
            return response("Product Not Found",400);
        }
        $check=Favorite::where('product_id',$product_id)
        ->where('user_id',Auth::user()->id)->first();
        //IF not found then it is not added to fav before
        //then clicking the love-button will add it to fav
        if(is_null($check)){
            Favorite::create([
                'user_id'=>Auth::user()->id,
                'product_id'=>$product_id
            ]);
            return response("Product Added To Favorites Successfully",200);
        }
        else{
            $check->delete();
            return response("Product Has Been Removed From Favorites Successfully",200);

        }

    }
}
