<?php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Product as ProductResource;
use League\Flysystem\UnableToDeleteFile;

use function PHPUnit\Framework\isNull;

class ProductController extends Controller
{

    public function index()
    {
        $products=DB::table('products')
        ->join('users','products.product_creator','=','users.id')
        ->select(DB::raw("CONCAT(users.name,' ',users.last_name)as Full_name"),
        'products.*')->where('status','active')->get();
        if(count($products)==0){
            return response('No Current Items To Show',200);
        }

        $product_list=[];
        foreach($products as $product):
            $res=Favorite::where('product_id',$product->id)
            ->where('user_id',Auth::user()->id)
            ->first();
            if(is_null($res)){
                $is_favorite="not_favorite";
            }else{
                $is_favorite="favorite";
            }
            $imageUrl=asset('storage/'.$product->path);
             $array=[
                'product'=>$product,
                'imageUrl'=>$imageUrl,
                'is_favorite'=>$is_favorite
        ];
        array_push($product_list,$array);
        endforeach;
        return response($product_list,200);
    }


    public function lastFour()
    {
        $last_four_products=DB::table('products')
        ->join('users','products.product_creator','=','users.id')
        ->select(DB::raw("CONCAT(users.name,' ',users.last_name)as Full_name"),
        'products.*')->where('status','active')->latest()->take(4)->get();
        if(count($last_four_products)==0){
            return response('No Current Items To Show',200);
        }

        $product_list=[];
        foreach($last_four_products as $product):
            $res=Favorite::where('product_id',$product->id)
            ->where('user_id',Auth::user()->id)
            ->first();
            if(is_null($res)){
                $is_favorite="not_favorite";
            }else{
                $is_favorite="favorite";
            }
            $imageUrl=asset('storage/'.$product->path);

             $array=[
                'product'=>$product,
                'imageUrl'=>$imageUrl,
                'is_favorite'=>$is_favorite
        ];
        array_push($product_list,$array);
        endforeach;
        return response($product_list,200);
    }
    //If user has created products before this will show them
    //to him so he can update and delete
    //if not he will see a message and be able to add new ones

    public function my_products(){
        $m_products=[];
        $my_products=Product::where('product_creator',Auth::user()->id)
        ->latest()->get();
        if(count($my_products)==0){
            return response("No Products Found ! you can add new products",400);
        }
        foreach($my_products as $product):
            $res=Favorite::where('product_id',$product['id'])
            ->where('user_id',Auth::user()->id)
            ->first();
            if(is_null($res)){
                $is_favorite="not_favorite";
            }else{
                $is_favorite="favorite";
            }
            $imageUrl=asset('storage/'.$product['path']);
            $array=[
                'product'=>$product,
                'image'=>$imageUrl,
                'is_favorite'=>$is_favorite
            ];
            array_push($m_products,$array);
        endforeach;
        return response()->json($m_products,200);
    }

    public function store(Request $request)
    {
         $input=$request->all();
         $validator= Validator::make($input,[
            'name'=>'required',
            'product_creator'=>'nullable',
            'description'=>'required',
            'price'=>'required',
            'path'=>'image',
            'category_id'=>'required',
            'condition'=>'required',
         ]);
         if($validator->fails()){
             return response('Something Went Wrong ! Please Check Product Info',400);
         }
         $id=Auth::user()->id;
         $product=Product::create([
            'name'=>$input['name'],
            'description'=>$input['description'],
            'price'=>$input['price'],
            'category_id'=>$input['category_id'],
            'condition'=>$input['condition']
        ]);
         if($request->hasFile('path')){
         $originalName=$request->file('path')->getClientOriginalName();
        //handle image upload and store it in storage/app/public folder
         $path=$request->file('path')->storeAs('public',$originalName);
         $imageName=basename($path);
         $product->path=$imageName;
        }
         elseif(is_null($request->input('path'))){
            $product->path='no_image.jpg';
         }
         $product->product_creator=$id;
         $product->save();
         return response($product,200);
    }

    public function show($id)
    {
        $product=DB::table('products')
        ->join('users','products.product_creator','=','users.id')
        ->select(DB::raw("CONCAT(users.name,' ',users.last_name)as Full_name"),
        'products.*')
        ->where('products.id',$id)
        ->first();
        if(is_null($product)){
            return response('Product Not Found');}

            $imageUrl=asset('storage/'.$product->path);
            $product_info=[
                'product'=>$product,
                'image'=>$imageUrl
            ];
        return response($product_info,200);
    }


    public function update(Request $request,$product_id)
    {
        $product=Product::find($product_id);
        if(empty($product)){
            return response('Product Not Found',404);
        }
        if(!($product->product_creator == Auth::user()->id)){
            return response('Product cannot be updated by this user',400);
        }
        //Validate the input
        $input=$request->all();
        $validator= Validator::make($input,[
            'name'=>'nullable',
            'description'=>'nullable',
            'price'=>'nullable',
            'path'=>'image|nullable',
           'category_id'=>'nullable',
           'condition'=>'string|nullable',
        ]);
        if($validator->fails()){
            return response('Something Went Wrong ! Please Check Product Info',400);
        }

        $product->update($input);
        $product->save();

        //=============Update Product Photo============
        if($request->hasFile('path')){
            $old_path=$product->path;
            if($old_path !="no_image.jpg"){
                unlink("storage/$old_path");
            }

            $ext=$request->file('path')->getClientOriginalExtension();
            $originalName=$request->file('path')->getClientOriginalName();
            $originalName.="$product->id.$ext";
            $path=$request->file('path')->storeAs('public',$originalName);
            $imageName=basename($path);
            $product->path=$imageName;
            $product->save();
        }
        return response($product,200);
    }

    public function destroy( $id)
    {
        $product=Product::find($id);
        if(is_null($product)){
            return response('Product Not Found',403);
        }
        if(!($product->product_creator == Auth::user()->id)){
            return response('Product cannot be deleted by this user',400);
        }
        $product->delete();
        return response('Product Deleted',200);
    }
    public function search($name)
    {
        return product::where('name' , 'like' , '%'.$name.'%')->get();
    }
}

