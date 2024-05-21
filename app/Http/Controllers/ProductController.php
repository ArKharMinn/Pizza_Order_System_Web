<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function list() {
        $pizzas = Product::select('products.*','categories.name as category_name')
        ->when(request('search'),function($query){
          $query->where('products.name','like','%'.request('search').'%');
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(3);
        $pizzas->appends(request()->all());
        return view('admin.product.pizzaList',compact('pizzas'));
    }

    //view pizza detail
    public function view($id) {
        $view = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('product_id',$id)->first();
        return view('admin.product.view',compact('view'));
    }

    //delect pizza
    public function delete($id) {
        Product::where('product_id',$id)->delete($id);
        return back()->with(['deleteSuccess'=>'product delete']);
    }

    //create direct page
    public function create() {
        $categories = Category::get();
        return view('admin.product.creat',compact('categories'));
    }

    public function createPizza (Request $request) {

        $data = $this->getProductData($request);
        $request->validate([
          'name' => 'required|unique:products,name',
          'category' => 'required',
          'description' => 'required',
          'image' => 'required',
          'price' => 'required',
          'waitingTime' => 'required',
        ]);


          $fileName = uniqid() . $request->file('image')->getClientOriginalName();
          $request->file('image')->storeAs('public',$fileName);
          $data['image'] = $fileName;


        Product::create($data);
        return redirect()->route('product#list');
    }

    //updatePizza

    public function updatePizza($id) {
        $pizza = Product::where('product_id',$id)->first();
        $category = Category::get();
        return view('admin.product.update',compact('pizza','category'));
    }

    public function update($id,Request $request) {
        $data = $this->getProductData($request);

        if( $request->hasFile('image') ) {
            $dbImage = Product::where('product_id',$request->id)->first();
            $dbImage = $dbImage->image;

            if( $dbImage != null ) {
                Storage::delete(['public/', $dbImage]);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/', $fileName);
            $data['image'] = $fileName;
        }

        Product::where('product_id',$id)->update($data);
        return redirect()->route('product#list');
    }

    private function getProductData($request) {
        return [
           'category_id' => $request->category,
           'name' => $request->name,
           'description' => $request->description,
           'price' => $request->price,
           'waiting_time' => $request->waitingTime,
        ];
    }
}
