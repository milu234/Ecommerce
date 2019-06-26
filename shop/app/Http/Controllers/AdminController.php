<?php

namespace App\Http\Controllers;
use Auth;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    //login function
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                echo "Success";die;
            }else{
                echo "Failed";die;
            }
        }

        return view('admin.admin_login');
    }
}
