<?php

namespace App\Http\Controllers\User;

use view;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Console\Output\Output;

class UserController extends Controller
{
    public function home(){
        $pizza = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //cart list
    public function cartList() {
        $cartList = Cart::select('carts.*','products.name as pizza_name','products.price','products.image')
        ->leftJoin('products','products.product_id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)
        ->orderBy('created_at','desc')
        ->get();
        $total =0;
        foreach($cartList as $c){
            $total += $c->price * $c->qty;
        };
        return view('user.cart.cart',compact('cartList','total'));
    }

    //histoty
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(10);
        $order->appends(request()->all());
        return view('user.cart.history',compact('order'));
    }

    //category filter
    public function filter($categoryId){
        $pizza = Product::where('category_id',$categoryId)->OrderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('pizza','category','cart','history'));
    }

    //contact form
    public function contact(Request $request){
        $contactData = $this->contactData($request);
        Contact::create($contactData);
        return back();
    }

    //product detail
    public function detail($id){
        $pizza = Product::where('product_id',$id)->first();
        $pizzaList = Product::get();
        return view('user.main.detail',compact('pizza','pizzaList'));
    }

    //account update
    public function view(){
        return view('user.password.edit');
    }

    public function update($id,Request $request) {
        $dataUpdate = $this->getData($request);

        if($request->hasFile('image')){
            $user = User::where('id',$id)->first();
            $dbImage = $user->image;

            if($dbImage != null) {
                Storage::delete('public/',$dbImage);
            }

            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $dataUpdate['image'] = $fileName;
        }
        User::where('id',$id)->update($dataUpdate);
        return redirect()->route('user#home');
    }

    //change password
    public function change(){
        return view('user.password.change');
    }

    public function changePassword(Request $request) {
        $this->validationCheck($request);

        $user = User::select('password')->where('id',Auth::user()->id)->first();
        $dbPassword = $user->password;

        if(Hash::check($request->oldPassword,$dbPassword)) {
            $data = [
                'password' => Hash::make($request->newPassword)
            ] ;
            User::where('id',Auth::user()->id)->update($data);
            return redirect()->route('user#home')->with(['Success']);
        }
        return back()->with(['key'=> 'notMatchPassword']);
    }

    //data
    private function getData($request) {
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now(),
        ];
    }

    //contact data
    private function contactData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ];
    }

    //validation
    private function validationCheck($request){
        $request->validate([
         'oldPassword' => 'required|min:6',
         'newPassword' => 'required|min:6',
         'confirmPassword' => 'required|min:6|same:newPassword',
        ]);
    }
}
