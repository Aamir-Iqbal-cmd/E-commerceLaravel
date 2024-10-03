<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Subcategory;

class ShowProductsController extends Controller
{
    public function showProducts(){

        $product = Products::orderBy('created_at', 'DESC')->get();
        return view('shop',['products'=>$product]);

    }

    public function showSingleProduct($id){
        $product = Products::findOrFail($id);
        $cat_id = $product->cat_id;
        $subcategory = Subcategory::findOrFail($cat_id);
        return view('shop_single',['products'=>$product, 'subcategories' => $subcategory]);
    }
}
