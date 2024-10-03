<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class ShowCategoryController extends Controller
{
    public function showCategory(){

        $category = Category::orderBy('created_at', 'DESC')->limit(3)->get();
        return view('index',['categories'=>$category]);

    }
}
