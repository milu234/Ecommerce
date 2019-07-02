<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Session;
use Image;
use App\Category;
use App\Product;
use App\ProductsAttribute;

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
                   Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                   //store image name in the project folder
                   $product->image = $filename;


               }
            }

            $product->save();
            // return redirect()->back()->with('flash_message_success','Product has been added successfully!!');
            return redirect('/admin/view-products')->with('flash_message_success','Product has been added successfully!');
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

    // View Product Function
    public function viewProducts(Request $request){
        $products = Product::get();
        $products = json_decode(json_encode($products));
        foreach($products as $key => $val ){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
        return view('admin.products.view_products')->with(compact('products'));
    }




    //Edit Produt Function
    public function editProduct(Request $request, $id=NULL){

        if($request->isMethod('post')){
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;


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
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
 
 
 
                }
             }else{
                 $filename = $data['current_image'];
             }

             if(empty($data['description'])){
                 $data['description'] = '';
             }

             if(empty($data['image'])){
                 $data['image'] = "No Image";
             }



            Product::where(['id'=>$id])->update([
                'category_id' => $data['category_id'],
                'product_name' => $data['product_name'],
                'product_code' => $data['product_code'],
                'product_color' => $data['product_color'],
                'description' => $data['description'],
                'price' => $data['price'],
                'image'=>$filename

            ]);

            return redirect('/admin/view-products')->with('flash_message_success','Products updated Successfully');
        }
       // echo "test"; die;
        //Get Product Details
        $productDetails = Product::where(['id'=>$id])->first();

        //Categories Dropdown start
        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value = '' selected disabled>Select</option>";
        foreach($categories as $cat){
            if($cat->id == $productDetails->category_id){
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value = '".$cat->id."' ".$selected." >".$cat->name."</option>";//Plaese use dot before equal to in foreach
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                if($sub_cat->id == $productDetails->category_id){
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value = '".$sub_cat->id."'  ".$selected."   >&nbsp;---&nbsp;".$sub_cat->name."</option>";
            }
        }
        //Category Ends

        return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));
    }


    //Delete Product Functions
    public function deleteProduct($id = NULL){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product has been deleted successfully');
    }



    //Delete ProductImage Function
    public function deleteProductImage($id = NULL){
        Product::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Product Image had been deleted successfully');
    }


    //Add Product Attribute Function

    public function addAttributes(Request $request, $id = NULL){
        $productDetails = Product::where(['id'=>$id])->first();
        if($request->isMethod('post')){
            $data = $request->all();

            foreach($data['sku']  as $key => $val ){
                if(!empty($val)){
                    $attribute = new ProductsAttribute; 
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();

                }
            } 
            // echo "<pre>";print_r($data) ; die;
        }
        return view('admin.products.add_attributes')->with(compact('productDetails'));
    }
}
