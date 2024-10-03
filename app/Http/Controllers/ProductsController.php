<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Products;

class ProductsController extends Controller
{
    public function add()
    {
        $category = Category::all();
        $subcategory = Subcategory::all();
        return view('admin.add_product', ['categories' => $category, 'subcategories' => $subcategory]);
    }
    public function insert(Request $request)
    {
        $rules = [
            'product_name' => 'required',
            'product_price' => 'required',
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'quantity' => 'required',
            'pro_image' => 'required'
        ];

        if ($request->pro_image != '') {
            $rules = [
                'pro_image' => 'image'
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('add.product')->withInput()->withErrors($validator);
        }

        $product = new Products();
        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->cat_id = $request->cat_id;
        $product->subcat_id = $request->subcat_id;
        $product->quantity = $request->quantity;


        if ($request->product_desc != '') {
            $product->product_desc = $request->product_desc;
        }

        if ($request->pro_image != '') {
            $image = $request->pro_image;
            $ext = $image->getClientOriginalExtension();
            $image_name = time() . "." . $ext;
            $image->move(public_path('admin/uploads/products'), $image_name);

            $product->pro_image = $image_name;
            $product->save();
        }

        $product->save();

        return redirect()->route('add.product')->with('success', 'Product add Successfully');

    }


    public function edit($id, Request $request)
    {

        $product = Products::findOrFail($id);

        $rules = [
            'product_name' => 'required',
            'product_price' => 'required',
            'cat_id' => 'required',
            'subcat_id' => 'required',
            'quantity' => 'required',
        ];

        if ($request->pro_image != '') {
            $rules = [
                'pro_image' => 'image'
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('update.product', $product->id)->withInput()->withErrors($validator);
        }


        $product->product_name = $request->product_name;
        $product->product_price = $request->product_price;
        $product->cat_id = $request->cat_id;
        $product->subcat_id = $request->subcat_id;
        $product->quantity = $request->quantity;


        if ($request->product_desc != '') {
            $product->product_desc = $request->product_desc;
        }

        if ($request->pro_image != '') {
            $image = $request->pro_image;
            $ext = $image->getClientOriginalExtension();
            $image_name = time() . "." . $ext;
            $image->move(public_path('admin/uploads/products'), $image_name);

            $product->pro_image = $image_name;
            $product->save();
        }


        $product->save();

        return redirect()->route('update.product', $product->id)->with('success', 'Product Update Successfully');

    }




    public function getSubcategories(Request $request)
    {
        $subcategories = Subcategory::where('category_id', $request->cat_id)->get();
        return response()->json($subcategories);
    }

    public function view_pro()
    {
        $products = Products::all();
        $subcategory = Subcategory::orderBy('created_at', 'DESC')->get();
        return view('admin.products_list', ['subcategories' => $subcategory, 'products' => $products]);
    }

    public function update($id)
    {
        //$products = Products::all();
        $products = Products::findOrFail($id);
        $category = Category::all();
        $subcategory = Subcategory::all();

        return view('admin.edit_product', ['product' => $products, 'categories' => $category, 'subcategories' => $subcategory]);
    }

    public function destroy($id)
    {
        $product = Products::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        if ($product->pro_image) {
            $imagePath = public_path('admin/uploads/products/' . $product->pro_image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $product->delete();
        
        return redirect()->back()->with('success', 'Product deleted successfully');
    }

}
