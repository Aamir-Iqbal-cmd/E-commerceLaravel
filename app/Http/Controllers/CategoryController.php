<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;

class CategoryController extends Controller
{
    public function add(){
     return view('admin.add_category');
    }
    public function insert(Request $request)
{
    $rules = [
        'category_name' => 'required',
        'cat_image' => 'required|image'
    ];


    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
        return redirect()->route('add.category')->withInput()->withErrors($validator);
    }

    $category = new Category();
    $category->category_name = $request->category_name;
    $category->category_desc = $request->category_desc;

    // Handle image upload
    if ($request->hasFile('cat_image')) {
        $image = $request->file('cat_image');
        $ext = $image->getClientOriginalExtension();
        $image_name = time() . "." . $ext;
        $image->move(public_path('admin/uploads/category'), $image_name);

        $category->category_image = $image_name;
    }

    $category->save();

    return redirect()->route('add.category')->with('success', 'Category added successfully');
}


    public function view_cat(){
        $category = Category::orderBy('created_at', 'DESC')->get();
        return view('admin.categories_list',['categories'=>$category]);
    }

    public function update($id){
        $category = Category::findOrFail($id);

        return view('admin.edit_category', ['category'=>$category]);
    }
    public function edit($id, Request $request){
        $category = Category::findOrFail($id);

        $rules = [
            'category_name' => 'required',
            'cat_image' => 'required'
        ];

        $validator = Validator::make($request->all(),$rules);

        if($validator->fails()){
            return redirect()->route('update.category', $category->id)->withInput()->withErrors($validator);
        }

        $category->category_name = $request->category_name;
        $category->category_desc = $request->category_desc;

        if ($request->hasFile('cat_image')) {
            $image = $request->file('cat_image');
            $ext = $image->getClientOriginalExtension();
            $image_name = time() . "." . $ext;
            $image->move(public_path('admin/uploads/category'), $image_name);

            $category->category_image = $image_name;
            $category->save();
        } 

        $category->save();
        return redirect()->route('update.category', $category->id)->with('success', 'Category Updated Successfully');


    }
    public function destroy($id)
{
    $category = Category::find($id);

    if (!$category) {
        return redirect()->back()->with('error', 'Category not found');
    }

    $subcategories = $category->subcategories;

    foreach ($subcategories as $subcategory) {

        $products = $subcategory->products;

        foreach ($products as $product) {

            if ($product->pro_image) {
                $imagePath = public_path('admin/uploads/products/' . $product->pro_image);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            $product->delete();
        }

        $subcategory->delete();
    }

    $category->delete();

    return redirect()->back()->with('success', 'Category and all its subcategories and products deleted successfully');
}

}
