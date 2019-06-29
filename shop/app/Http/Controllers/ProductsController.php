<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;

class ProductsController extends Controller
{
    //Add Product Function
    public function addProduct(Request $request){

        //Add Product Code
        if($request->isMethod('post')){
            $data  = $request->all();
           // echo "<pre>"; print_r($data); die;
            if(empty($data['category_id'])){
                return redirect()->back()->with('flash_message_error','Under category is missing');
            }

            $product  = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->description = $data['description'];
            if(!empty($data['description'])){
                $product->description = $data['description'];
            }else{
                $product->description = '';
            }
            $product->price = $data['price'];
            //Upload Image
            if($request->hasFile('image')){
               $image_tmp = Input::file('image');
               if($image_tmp->isValid()){
                   //Save  Images according to the sizes
                   $extension = $image_tmp->getClientOriginalExtension();
                   $filename = rand(111,99999).'.'.$extension;
                   $large_image_path = 'images/backend_images/products/large/'.$filename;
                   $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                   $small_image_path = 'images/backend_images/products/small/'.$filename;

                   //resize the images 
                   Image::make($image_tmp)->save($large_image_path);
                   Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                   Image::make($image_tmp)->resize(300,300)->save($large_image_path);

                   //store image name in the project folder
                   $product->image = $filename;


               }
            }

            $product->save();
            return redirect()->back()->with('flash_message_success','Product has been added successfully!!');
        }

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value = '' selected disabled>Select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value = '".$cat->id."'>".$cat->name."</option>";//Plaese use dot before equal to in foreach
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value = '".$sub_cat->id."'>&nbsp;---&nbsp;".$sub_cat->name."</option>";
            }
        }
        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }


    public function viewProducts(Request $request){
        return view('admin.products.view_products');
    }
}
