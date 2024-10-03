<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class SubcCategoryController extends Controller
{
    public function add()
    {
        $category = Category::all();
        return view('admin.add_subcategory', ['categories' => $category]);
    }
    public function insert(Request $request)
    {
        $rules = [
            'subcategory_name' => 'required',
            'cat_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('add.subcategory')->withInput()->withErrors($validator);
        }

        $subcategory = new Subcategory();
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->cat_id;
        $subcategory->subcategory_desc = $request->subcategory_desc;

        $subcategory->save();

        return redirect()->route('add.subcategory')->with('success', 'Subcategory add Successfully');

    }

    public function view_subcat()
    {
        $category = Category::all();
        $subcategory = Subcategory::orderBy('created_at', 'DESC')->get();
        return view('admin.subcategories_list', ['subcategories' => $subcategory, 'categories' => $category]);
    }

    public function update($id)
    {
        $category = Category::all();
        $subcategory = Subcategory::findOrFail($id);

        return view('admin.edit_subcategory', ['subcategory' => $subcategory, 'categories' => $category]);
    }
    public function edit($id, Request $request)
    {
        $subcategory = Subcategory::findOrFail($id);

        $rules = [
            'subcategory_name' => 'required',
            'cat_id' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('update.subcategory', $subcategory->id)->withInput()->withErrors($validator);
        }


        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->category_id = $request->cat_id;
        $subcategory->subcategory_desc = $request->subcategory_desc;

        $subcategory->save();

        return redirect()->route('update.subcategory', $subcategory->id)->with('success', 'Subategory Updated Successfully');


    }

    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);

        if (!$subcategory) {
            return redirect()->back()->with('error', 'Subcategory not found');
        }

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

        return redirect()->back()->with('success', 'Subcategory and its products deleted successfully');
    }

}
