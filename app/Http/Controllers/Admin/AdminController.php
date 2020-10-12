<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Sale;


class AdminController extends Controller
{
    public function dashboard(){
        $sales= Sale::where('is_delivered',1)->get();
        $to_start = Sale::where('is_started',0)->get();
        $deliveries = Sale::where('is_started',1)->where('is_delivered',0)->get();
        $users = User::where('is_admin',0)->get();
        return view('admin.otherPages.dashboard',compact('sales','users','deliveries','to_start'));
    }
    public function transaction(){
        $sales = Sale::where('is_delivered',1)->get();
        return view('admin.otherPages.transaction',compact('sales'));
    }
    public function edit(){
        $admin = User::where('is_admin',1)->get();
        return view('admin.otherPages.edit',compact('admin'));
    }
    public function update($id){
            request()->validate([
            'name'=> 'required',
            'email' => 'required',
            'phone_number'=> 'required',
        ]);
        $admin = User::findorFail($id);
        $admin->name = request()->get('name');
        $admin->email = request()->get('email');
        $admin->phone_number = request()->get('phone_number');
        $admin->save();
         return redirect("/admin/dashboard")->with("success","Profile updated Successfully");
    }
    public function changePassword(){
        $admin = User::where('is_admin',1)->get();
        return view('admin.otherPages.change_password',compact('admin'));
    }
    public function updatePassword($id){
        request()->validate([
            'currentpassword'=> 'required',
            'password' => 'required|min:8|string',
            'confirmpassword'=> 'required|confirmed',   
        ]);
        $admin = User::findorFail($id);
        if(request()->get('currentpassword'!=hash($admin->password))){
            Log::alert('Sorry');
        }

    }
}
