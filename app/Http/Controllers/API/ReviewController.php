<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Http\JsonResponse;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;


class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function my_reviews(){
        $my_reviews=DB::table('reviews')
        ->join('users','reviews.reviewer_id','=','users.id')
        ->select(DB::raw("CONCAT(users.name,' ',users.last_name)as full_name"),
        'reviews.review','reviews.rating','reviews.created_at','reviews.updated_at')
        ->where('reviews.reviewed_id',Auth::user()->id)
        ->orderBy('created_at','desc')
        ->get();
               if(is_null($my_reviews)){
            return response("You have not been rated yet",201);}
        return response($my_reviews,200);
    }

    public function people_reviews($user_id){
        $user=User::find($user_id);
        if(is_null($user)){
            return response("User Not Found",404);
        }
        $others_reviews=DB::table('reviews')
        ->join('users','reviews.reviewer_id','=','users.id')
        ->select(DB::raw("CONCAT(users.name,' ',users.last_name)as full_name"),
        'reviews.review','reviews.rating','reviews.created_at','reviews.updated_at')
        ->where('reviews.reviewed_id',$user_id)
        ->orderBy('created_at','desc')
        ->get();
        if(count($others_reviews)==0){
            return response("User has not been rated yet",200);
        }

        return response($others_reviews,280);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_review(Request $request , $user_id)
    {
        if(Auth::user()->id != $user_id){
        $request->validate([
            'review' => 'required',
            'rating' => 'required',
        ]);

        $new_review= Review::create([
            'reviewer_id'=>Auth::user()->id,
            'reviewed_id'=>$user_id,
            'review'=>$request['review'],
            'rating'=>$request['rating']
        ]);
        return response($new_review,200);
    }
    else{
        return response("you can't review yourself",200);
    }

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     //This function checks if the user has reviewed a certain seller
     //or he has not yet
    public function review_check( $user_id)
    {
        $user=User::find($user_id);

        if(is_null($user)){
            return response("User Not Found",404);
        }
        $id=Auth::user()->id;
        $my_review=DB::table('reviews')
        ->join('users','reviews.reviewer_id','=','users.id')
        ->select(DB::raw("CONCAT(users.name,' ',users.last_name)as full_name"),
        'reviews.id','reviews.review','reviews.rating')
        ->where('reviews.reviewed_id',$user_id)
        ->where('reviews.reviewer_id',Auth::user()->id)
        ->first();
        if(is_null($my_review)){
            return response("You have not rated this user yet",404);
        }

        return response()->json($my_review,200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $review_id
     * @return \Illuminate\Http\Response
     */


    //This function is to update Your Review
    public function update_review(Request $request, $review_id){

        if(Review::find($review_id)){
            $my_review = Review::find($review_id);
            if(count($my_review)==0){
                return response("Review Not found",404);
            }
            if($my_review->reviewer_id == auth::user()->id){
                $my_review-> update($request-> all());
                $my_review=DB::table('reviews')
                ->join('users','reviews.reviewer_id','=','users.id')
                ->select(DB::raw("CONCAT(users.name,' ','user.last_name)as full_name"),
                'reviews.id','reviews.review','reviews.rating')
                ->where('reviews.id',$review_id)
                ->first()
                ->get();

                return response($my_review,200);
            }
            else{
                return response('this review isn\'t yours',200);
            }
        }

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if(Review::find($id)){
            $review = Review::find($id);
            if($review->reviewer_id == auth::user()->id){
                $review-> delete();
                return response('Review Deleted',200);
            }
            else{
                return response("this review isn't yours",200);
            }
        }
        else{
            return response('couldn\'t find the review',200);
        }
    }

}
