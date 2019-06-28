<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //add Category function
    public function addCategory(){
        return view('admin.categories.add_category');
    }
}
