<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Review;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\Order_item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\AssignOp\Concat;
use Termwind\Components\Raw;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    //products functions:

    //show all active products
    public function active_products_index()
    {
        if(Auth::user()->id == 1){

            $products=DB::table('products')
            ->select('id','name','price','path')->where('status','active')->get();
        if(count($products)==0){
            return response('No Current Items To Show',200);
        }

        $product_list=[];
        foreach($products as $product):

            $imageUrl=asset('storage/'.$product->path);
             $array=[
                'product'=>$product,
                'imageUrl'=>$imageUrl,
        ];
        array_push($product_list,$array);
        endforeach;
        return response($product_list,200);
    }
    else
        return response('not allowed',200);
    }


    //show all pending products
    public function pending_products_index()
    {
        if(Auth::user()->id == 1){

        $products=DB::table('products')
        ->select('id','name','price','path')->where('status','pending')->get();
        if(count($products) == 0){
            return response('No Current Items To Show',200);
        }

        $product_list=[];
        foreach($products as $product):

            $imageUrl=asset('storage/'.$product->path);
             $array=[
                'product'=>$product,
                'imageUrl'=>$imageUrl
        ];
        array_push($product_list,$array);
        endforeach;
        return response($product_list,200);
    }
    else
        return response('Not allowed',200);
    }

    // changing the status from pending to active
    public function approve_product(Request $request,$product_id){
        if(Auth::user()->id == 1){
            $product = Product::find($product_id);

            if(empty($product)){
                return response('the product has not been found',400);
            }
            else{
                $product->status = 'active';
                $product->save();
                return response('the product has been approved',200);
            }
        }
        else
            return response('Not allowed',200);
        }

    public function reject_product(request $request,$product_id){
        if(Auth::user()->id == 1){
            $product = Product::find($product_id);
            if(empty($product)){
                return response('the product has not been found',400);
            }
            else{
                $product->delete();
                return response('the product has been deleted',200);
            }
        }
        else
        return response('Not allowed',200);
    }


    //orders functions:

    //show all pending orders
    public function pending_orders_index()
    {
        if(Auth::user()->id == 1){

            $orders =DB::table('orders')
            ->join('users','users.id' , '=', 'orders.user_id')
            ->select(DB::raw('orders.id',"concat(users.name,users.last_name) as name"),DB::raw("orders.created_at"))
            ->where('status','pending')
            ->get();
            if(count($orders)==0){
                return response('No Current Items To Show',200);
            }
            return response($orders,200);
        }
        else
        return response('not allowed',200);
    }

    //show all active orders
    public function active_orders_index()
    {
        if(Auth::user()->id == 1){

            $orders =DB::table('orders')
            ->join('users','users.id' , '=', 'orders.user_id')
            ->select('orders.id',DB::raw("concat(users.name,users.last_name) as name"),DB::raw("orders.created_at"))
            ->where('status','active')
            ->get();

            if(count($orders)==0){
                return response('No Current Items To Show',200);
            }
            return response($orders,200);
        }
        else
        return response('not allowed',200);
    }

    //show a specific order
    public function order_details($order_id)
    {
        if(Auth::user()->id == 1){

            $order =DB::table('orders')
            ->join('users','users.id' , '=', 'orders.user_id')
            ->select(DB::raw("concat(users.name,users.last_name) as name"),"orders.price","quantity")
            ->where("orders.id", "=" , $order_id)
            ->get();

            if($order->isNotEmpty()){
            return response($order,200);
            }
            else

            return response('could not find this order',200);
        }
        else
        return response('not allowed',200);
    }

    //change the status of the order to active
    public function approve_order($order_id){
        if(Auth::user()->id == 1){

        $order = Order::find($order_id);

        if(empty($order)){
            return response('the order has not been found',400);
        }
        else{
            $order->status = 'active';
            $order->save();
        }

        return response('the order has been approved',200);
    }
    else
        return response('Not allowed',400);
    }

    //reject the order
    public function reject_order($order_id){
        if(Auth::user()->id == 1){

            $items = DB::table('order_items')
            ->join('products','products.id','=','order_items.product_id')
            ->where('order_items.order_id','=',$order_id)
            ->get(); //update(['products.status' => 'active']);

            foreach($items as $item){
                $product = Product::find($item->product_id);
                $product->status = "active";
                $product->save();
            }

            $order_items = DB::table('order_items')
            ->join('orders','orders.id','=','order_items.id')
            ->where('order_items.order_id','=',$order_id)
            ->delete();


            $order = Order::find($order_id);
            $order->delete();
            return response('the order has been deleted',200);
        }
        else
        return response('Not allowed',200);
    }

    //---------------users functions:

    //show all users
    public function users_index()
    {
        if(Auth::user()->id == 1){

            $users=DB::table('users')->select('id',DB::raw("CONCAT(users.name,' ',users.last_name)as name","address"))
            ->get();

            if(count($users) == 0){
                return response('no users have been found',200);
            }
            else{
                    return response($users,200);
            }
        }
        else
        return response('not allowed',200);
    }

    //show all active users who selled a product
    public function seller_users_index()
    {
        if(Auth::user()->id == 1){

            $users = DB::table('users')->select(DB::raw("CONCAT(users.name,' ',users.last_name)as name"),"users.address")
            ->where('number_of_sold_items' , '>' , '0')
            ->get();
            if(count($users) == 0){
                return response('no users have been found',200);
            }
            else{
                return response($users,200);
            }
        }
        else
        return response('not allowed',200);
    }


    //show a specific user info
    public function user_details($id){
        if(Auth::user()->id == 1){
            $user = User::find($id);
            if(is_null($user)){
                return response('User Not Found',404);
            }

            //calculating items in store:
            $items=Product::where('product_creator',$id)
            ->where('status','active')->get();

            $items_in_store = count($items);
            $user->items_in_store = $items_in_store;
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
        else
        return response('Not allowed',200);
    }



    //delete the user
    public function ban_user(request $request,$user_id){
        if(Auth::user()->id == 1){
            $user = User::find($user_id);
            if(empty($user)){
                return response('User not found',400);
            }
            else{
                $user->delete();
                return response('the user has been deleted',200);
            }
        }
        else
        return response('Not allowed',200);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
