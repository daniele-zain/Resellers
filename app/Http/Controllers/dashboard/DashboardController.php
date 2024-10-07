<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{


    public function index() {
        $title = 'index';
        return view('dashboard.index', compact('title'));
    }


    public function products()
    {

        $title = 'products';
            $pending_products = Product::select('id', 'name', 'price', 'path', 'status')->where(['status' => 'pending'])->get();
            $pending_products_count = count($pending_products);

            $pending_product_list=[];
            foreach($pending_products as $product):

                $imageUrl=asset('storage/'.$product->path);
                $array=[
                    'product'=>$product,
                    'imageUrl'=>$imageUrl
                ];
                array_push($pending_product_list,$array);
            endforeach;


            $active_products = Product::select('id', 'name', 'price', 'path', 'status')->where(['status' => 'active'])->get();
            $active_products_count = count($active_products);

            $active_product_list=[];
            foreach($active_products as $product):

                $imageUrl=asset('storage/'.$product->path);
                $array=[
                    'product'=>$product,
                    'imageUrl'=>$imageUrl
                ];
                array_push($active_product_list,$array);
            endforeach;

            return view('dashboard.products.products', compact('active_products', 'pending_products', 'title'));
    }


    public function appUserList() {
        $title = 'app-user-list';
        $pending_products = Product::select('id', 'name', 'price', 'path', 'status')->where(['status' => 'pending'])->get();
        $pending_products_count = count($pending_products);

        $pending_product_list=[];
        foreach($pending_products as $product):

            $imageUrl=asset('storage/'.$product->path);
            $array=[
                'product'=>$product,
                'imageUrl'=>$imageUrl
            ];
            array_push($pending_product_list,$array);
        endforeach;
        return view('dashboard.app-user-list', compact('pending_products', 'title'));
    }



    public function approveProduct($product_id){
            $product = Product::find($product_id);

            if(empty($product)){
                return back()->with(['error' => 'the product has not been found']);
            }
            else{
                $product->status = 'active';
                $product->save();
                return back()->with(['success' => 'the product has been approved']);
            }
        }

    public function reject_product($product_id){
            $product = Product::find($product_id);
            if(empty($product)){
                return back()->with(['error' => 'the product has not been found']);
            }
            else{
                $product->delete();
                return back()->with(['success' => 'the product has been deleted']);
            }
    }

    public function orders()
    {
//        $pending_orders =DB::table('orders')
//            ->join('users','users.id' , '=', 'orders.user_id')
//            ->select('orders.id',DB::raw("concat(users.name,users.last_name) as name"),DB::raw("orders.created_at"), DB::raw("orders.status"))
//            ->where('status','pending')
//            ->get();
//
//        $active_orders =DB::table('orders')
//            ->join('users','users.id' , '=', 'orders.user_id')
//            ->select('orders.id',DB::raw("concat(users.name,users.last_name) as name"),DB::raw("orders.created_at"), DB::raw("orders.status"))
//            ->where('status','active')
//            ->get();
//        $pending_orders_count = count($pending_orders);
//        $active_orders_count = count($active_orders);


        $title = 'orders';
            $orders = Order::with(['user'])->paginate(8);
            return view('dashboard.orders', compact('orders', 'title'));
    }

    public function approve_order($order_id){

            $order = Order::find($order_id);

            if(empty($order)){
                return back()->with(['error' => 'the order has not been found']);
            }
            else{
                $order->status = 'active';
                $order->save();
                return back()->with(['success' => 'the order has been approved']);
            }


    }

    public function reject_order($order_id){
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
            return back()->with(['error' => 'the order has been deleted']);
    }

    public function users_index()
    {
            $title = 'all_users';
//            $users=DB::table('users')->select('id',DB::raw("CONCAT(users.name,' ',users.last_name)as name","address"))
//                ->get();
            $users = User::with(['product'])->select('id', 'name', 'last_name', 'address')->get();
            $users_count = count($users);

            return view('dashboard.users.users', compact('users', 'users_count', 'title'));
    }

    public function seller_users_index() {
        $title = 'all_users';
        $users = User::select('id', 'name', 'last_name', 'address', 'number_of_sold_items', 'items_in_store')->where('number_of_sold_items', '>', '0')->get();
//        $users = DB::table('users')->select(DB::raw("CONCAT(users.name,' ',users.last_name)as name"),"users.address")
//            ->where('number_of_sold_items' , '>' , '0')
//            ->get();
        $users_count = count($users);
        return view('dashboard.users.seller_users', compact('users', 'users_count', 'title'));

    }

    public function user_details($id){
            $user = User::find($id);
            if(is_null($user)){
                return redirect()->route('index')->with(['error' => 'User Not Found']);
            }

            //calculating items in store:
            $items=Product::where('product_creator',$id)
                ->where('status','active')->get();

            $items_in_store = count($items);
            $user->items_in_store = $items_in_store;
            $user->save();
            $user_reviews=Review::where('reviewed_id',$id)->get();
            if(count($user_reviews)!=0){
                $total=0.0;
                foreach($user_reviews as $user_review):
                    $total +=$user_review['rating'];
                endforeach;
                $user->current_rating =$total/count($user_reviews);
                $user->save();
                return view('dashboard.users.user_details', compact('user'));
            } else {
                return view('dashboard.users.user_details')->with(['error' => 'Empty Products for this User']);
            }
        }

    public function ban_user($user_id){
            $user = User::find($user_id);
            if(empty($user)){
                return back()->with(['error' => 'User not found']);
            }
            else{
                $user->delete();
                return back()->with(['success' => 'Benned User']);
            }
    }


}
