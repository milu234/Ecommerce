<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;


use Illuminate\Http\Request;

class AdminController extends Controller
{
    //login function
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
                // Session::put('adminSession',$data['email']);
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
        // if(Session::has('adminSession')){
        //     //Perform alll taks
        // }else{
        //     return redirect('/admin')->with('flash_message_error','Please login to success');
        // }

         
        return view('admin.dashboard');
    }


    //Password validation

    public function chkPassword(Request $request){
        $data = $request->all();
        $current_pwd = $data['current_pwd'];
        $check_pwd = User::where(['admin'=>'1'])->first();
        if(Hash::check($current_pwd,$check_pwd->password)){
            echo "true";die;
        }else{
            echo "false"; die;
        }
    }

    public function settings(){
        return view('admin.settings');

    }


    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success' , 'Logged out successfully');
    }
}
