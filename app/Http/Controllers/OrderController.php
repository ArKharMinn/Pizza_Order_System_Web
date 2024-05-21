<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_list;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function list(){
        $order = Order::when(request('search'),function($query){
            $query->where('order_code','like','%'.request('search').'%');
        })
        ->select('orders.*','users.name')
        ->leftJoin('users','users.id','orders.user_id')
        ->orderBy('created_at','desc')
        ->get();
        return view('admin.order.list',compact('order'));
    }

    //sorting status
    public function status(Request $request){

        if($request->status == null){
            $order = Order::when(request('search'),function($query){
                $query->orWhere('order_code','like','%'.request('search').'%');
            })
            ->select('orders.*','users.name')
            ->leftJoin('users','users.id','orders.user_id')
            ->orderBy('created_at','desc')
            ->get();
        } else {
            $order = Order::when(request('search'),function($query){
                $query->where('order_code','like','%'.request('search').'%');
            })
            ->select('orders.*','users.name')
            ->leftJoin('users','users.id','orders.user_id')
            ->orderBy('created_at','desc')
            ->where('orders.status',$request->status)->get();
        }

        return response()->json($order,200);
    }

    //voucher
    public function voucher($code){
        $data = Order::select('orders.*','users.name')
        ->leftJoin('users','orders.user_id','users.id',)
        ->where('order_code',$code)->first();
        $order = Order_list::select('order_lists.*','products.name','products.image')
        ->leftJoin('products','order_lists.product_id','products.product_id')
        ->where('order_code',$code)
        ->first();
        // dd($data);
        return view('admin.order.voucher',compact('data','order'));
    }

    //change status
    public function change(Request $request){

        Order::where('order_id',$request->order_id)->update([
            'status' => $request->status,
        ]);

        $response = ['status' => 'success'];
        return response()->json($response,200);
    }
}
