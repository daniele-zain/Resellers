<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Review;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
 //this is a function to show the information of the user who is authenticated
    public function show_info(){
        $user=User::find(Auth::user()->id);
        $items=Product::where('product_creator',Auth::user()->id)
        ->where('status','active')->get();
        $items_in_store=count($items);
        $user->items_in_store=$items_in_store;
        $user->save();
        $user_reviews=Review::where('reviewed_id',Auth::user()->id)->get();
        if(count($user_reviews)==0){
            return response($user,200);
        }
        $total=0.0;
        foreach($user_reviews as $user_review):
            $total +=$user_review['rating'];
        endforeach;
        $user->current_rating =$total/count($user_reviews);
        $user->save();
        return response($user,200);
    }
    //this is a function to update the information of the user who is authenticated
    public function update_info(Request $request){
        $user=User::find(Auth::user()->id);
        $input=$request->all();
        $user->update($input);
        $result=$user->save();
         if($result){
            return response($user,200);
         }
         else
         return response('Profile not updated',400);

    }
    //this is a function to show the information of other users(not logged in)
    public function show_user_info($id){
        $user = User::find($id);
        if(is_null($user)){
            return response('User Not Found',404);
        }
        //calculating items in store:
        $items=Product::where('product_creator',$id)
        ->where('status','active')->get();

        $items_in_store=count($items);
        $user->items_in_store=$items_in_store;
        $user->save();
        $user_reviews=Review::where('reviewed_id',$id)->get();
        if(count($user_reviews)==0){
            return response($user,200);
        }
        $total=0.0;
        foreach($user_reviews as $user_review):
            $total +=$user_review['rating'];
        endforeach;
        $user->current_rating =$total/count($user_reviews);
        $user->save();
        return response($user,200);
    }
}
