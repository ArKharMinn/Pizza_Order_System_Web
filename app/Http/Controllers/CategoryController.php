<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;

class CategoryController extends Controller
{
    public function list() {
        //
        $categories = Category::when(request('search'),function($query){
         $query->where('name','like','%'.request('search').'%');
        })->orderBy('created_at','desc')->paginate(4);
        $categories->appends(request()->all());
        return view('admin.category.list',compact('categories'));
    }

    //update category

    public function edit($id) {
        $category = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('category'));
    }

    public function update($id,Request $request) {
        $data = $this->categoryData($request);
        Category::where('id',$id)->update($data);
        return redirect()->route('category#list');
    }

    //delete category

    public function delete($id) {
        Category::where('id',$id)->delete();
        return back()->with(['categoryDelete' => 'Delete Success!']);
    }

    //create category

    public function createPage() {

        return view('admin.category.create');
    }

    public function create(Request $request) {

        $request->validate([
            'categoryName' => 'required||unique:categories,name'
        ]);

        $data = $this->categoryData($request);
        Category::create($data);
        return redirect()->route('category#list');
    }

    private function categoryData($request) {
        return [
            'name' => $request->categoryName
        ];
    }
}
