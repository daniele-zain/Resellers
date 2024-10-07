<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\AssignOp\Concat;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($product_id)
    {
        $product = Product::find($product_id);
        if(is_null($product)){
            return response ("Product not found",404);
        }
        //update1: to get the name of the commenter by joining
        //(users,comments,products)
        //update2: db::raw=>to get name and last name concatenated rather
        //than doing it later by Tammam
        $comments=DB::table('comments')->
        join('users','comments.user_id','=','users.id')->
        join('products','comments.product_id','=','products.id')->
        select(DB::raw("CONCAT(users.name,' ',users.last_name)as full_name "),
        'comments.*')->where('products.id',$product_id)->get();
        return response($comments,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($product_id , Request $request)
    {
        $validate_data = $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'product_id' => $product_id,
            'comment' => $validate_data['comment']
        ]);
        $created_comment=DB::table('comments')->
        join('users','comments.user_id','=','users.id')->
        join('products','comments.product_id','=','products.id')->
        select(DB::raw("CONCAT(users.name,' ',users.last_name)as full_name "),
        'comments.*')->where('products.id',$product_id)->
        where('users.id',Auth::user()->id)->latest()->get();
        return response($created_comment,200);

    }

    /**
     * Display the specified resource.
     */
    public function show( $product_id, $comment_id)
    {
        $product = Product::find($product_id);
        if(is_null($product)){
            return response("Product not Found",404);
        }
        $comment=Comment::find($comment_id);
        if(is_null($comment)){
            return response("comment not found");
        }
        $comment=DB::table('comments')->
        join('users','comments.user_id','=','users.id')->
        join('products','comments.product_id','=','products.id')->
        select(DB::raw("CONCAT(users.name,' ',users.last_name)as full_name "),
        'comments.*')->where('products.id',$product_id)
        ->where('comments.id',$comment_id)->
        get();
        return response($comment,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$product_id,$comment_id)
    {
        $product=Product::find($product_id);
        if(is_null($product)){
            return response("product not found",404);
        }
        $comment = Comment::find($comment_id);
        if(is_null($comment)){
            return response("Comment Not Found",404);
        }
        if(auth()->id() == $comment->user_id ){
        $comment -> update($request-> all());
        $comment=DB::table('comments')
        ->join('users','comments.user_id','=','users.id')
        ->join('products','comments.product_id','=','products.id')
        ->select(DB::raw("CONCAT(users.name,' ',users.last_name)AS full_name"),
        'comments.*')->where('products.id',$product_id)
        ->where('comments.id',$comment_id)
        ->get();

        return response($comment,200);
        }

        else {
        return response("you cannot edit this comment",400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($product_id,$comment_id)
    {
        $product=Product::find($product_id);
        if(is_null($product)){
            return response("Product Not Found",404);
        }
        $comment = Comment::find($comment_id);
        //added case:
            if(is_null($comment)){
                return response("comment not found",404);
            }
        if(auth()->id() == $comment->user_id ){
            $comment -> delete();
            return response('this comment have been deleted',200);
        }
        else
            return response('you cannot delete this comment' ,200);
    }


    //Added function to check if the user has a previous comment or no
    public function comment_check($product_id,$user_id){
        $product=Product::find($product_id);
        if(is_null($product)){
            return response("Product not found",404);
        }
        if($user_id != Auth::user()->id){
            return response("Something went wrong,please try again",400);
        }
        $comment=DB::table('comments')
        ->join('users','comments.user_id','=','users.id')
        ->join('products','comments.product_id','=','products.id')
        ->select(DB::raw("CONCAT(users.name,' ',users.last_name)as full_name"),
        'comments.*')->where('products.id',$product_id)
        ->where('users.id',Auth::user()->id)
        ->first();

        if(is_null($comment)){
            return response("You have not commented on this product yet! ",400);}
            else{
                return response()->json($comment,200);
            }
    }
}
