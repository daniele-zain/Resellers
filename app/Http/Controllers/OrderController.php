<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order_item;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function add_order(Request $request){
        $total=$request->input('total_price');
        $items=$request->input('ordered_items');
        $order=Order::create([
            'user_id'=>Auth::user()->id,
            'quantity'=>count($items),
            'price'=>$total
        ]);

        foreach($items as $item):
          $new_item = Order_Item::create([
                'order_id'=>$order['id'],
                'product_id'=>$item['id']
            ]);
            $new_item->save();
            $ordered=Product::find($item['id']);
            $ordered->status="inactive";
            $ordered->save();
            $user=User::find($item['product_creator']);
            $user->items_in_store-=1;
            $user->number_of_sold_items+=1;
            $user->save();
        endforeach;
    return response("You Order is being checked",200);
    }

    public function show_orders(){

        $my_orders=[];
        $orders=Order::where('user_id',Auth::user()->id)->latest()->get();
        if(count($orders)==0){
            return response("No Orders have been Made",200);
        }
        foreach($orders as $order):
            $array=[
                'order_id'=>$order['id'],
                'order_price'=>$order['price'],
                'order_items'=>$order['quantity'],
                'order_date'=>$order['created_at']
            ];
            $ordered_items=DB::table('order_items')
            ->join('products','order_items.product_id','=','products.id')
            ->select('order_items.order_id','products.id','products.name','products.price'
            ,'products.description','products.price','products.category_id','products.path')
            ->where('order_items.order_id',$order['id'])->get();
               $array['ordered_items']=$ordered_items;
            array_push($my_orders,$array);
        endforeach;
        return response($my_orders,200);
    }
}
