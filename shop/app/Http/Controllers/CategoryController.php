<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    //add Category function
    public function addCategory(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            $category = new Category;
            $category->name = $data['category_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->save();
            return redirect('/admin/view-categories')->with('flash_message_success','Category Added Successfully');
        }
        return view('admin.categories.add_category');
    }



    //edit category function
    public function editCategory(Request $request, $id = NULL){
        if($request->isMethod('post')){
            $data = $request->all();
            Category::where(['id'=>$id])->update(['name'=>$data['category_name'],'description'=>$data['description'],'url'=>$data['url']]);
            //Category::where(['id'=>$id])->update(['name'=>$data['category_name'],'description'=>$data['description'],'url'=>$data['url']]);
            return redirect('/admin/view-categories')->with('flash_message_success','Categories updated Successfully');


        }

        $categoryDetails = Category::where(['id'=>$id])->first();
        return view('admin.categories.edit_category')->with(compact('categoryDetails'));

    }


    //view Category Function
    public function viewCategories(){
        $categories = Category::get();
        $categories = json_decode(json_encode($categories));
        return view('admin.categories.view_categories')->with(compact('categories'));
    }


    
}
