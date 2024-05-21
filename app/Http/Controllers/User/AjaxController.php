<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_list;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function priceList(Request $request){
        if($request->status == 'asc') {
            $data = Product::orderBy('created_at','asc')->get();
        } else {
            $data = Product::orderBy('created_at','desc')->get();
        }
        return $data;
    }

    //view count
    public function viewCount(Request $request){
        Product::where('product_id',$request->pizzaId)->update([
            'view_count' => $request->count +1 ,
        ]);

    }

    //cart
    public function cart(Request $request){
        $data = $this->addOrderData($request);
        Cart::create($data);
        $response = [
            'status' => 'success',
            'message' => 'Add to cart complete'
        ];
        return response()->json($response,200);
    }

    //delete one cart
    public function deleteCart(Request $request){
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('cart_id',$request->cartId)->delete();
        $response = [
            'status' => 'success',
            'message' => 'Add to cart complete'
        ];
        return response()->json($response,200);
    }

    //clear cart
    public function clear(){
        Cart::where('user_id',Auth::user()->id)->delete();
    }

    //order
    public function order(Request $request){

        $total = 0;

        foreach($request->all() as $item){
            $data = Order_list::create([
                'user_id' => $item['user_id'],
                'product_id' =>  $item['product_id'],
                'qty' => $item['qty'],
                'total' =>  $item['total'],
                'order_code' =>  $item['order_code']
            ]);
         $total += $data->total;

        };

        Cart::where('user_id',Auth::user()->id)->delete();

        Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $total+3000,
            'order_code' => $data->order_code,
        ]);

        $response = [
            'status' => 'success',
            'message' => 'Add to cart complete'
        ];
        return response()->json($response,200);
    }

    private function addOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->pizzaId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
