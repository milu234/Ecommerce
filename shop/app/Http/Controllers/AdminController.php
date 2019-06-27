<?php

namespace App\Http\Controllers;
use Auth;
use Session;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    //login function
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                Session::put('adminSession',$data['email']);
                return redirect('/admin/dashboard');
            }else{
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
            }
        }

        return view('admin.admin_login');
    }


    // login action

    //dashboard function
    public function dashboard(){
        if(Session::has('adminSession')){
            //Perform alll taks
        }else{
            return redirect('/admin')->with('flash_message_error','Please login to success');
        }
        return view('admin.dashboard');
    }


    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success' , 'Logged out successfully');
    }
}
