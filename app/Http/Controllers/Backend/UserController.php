<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        //$alldata = User::all();
        $data ['allData'] = User::all();
        return view('backend.user.view_user', $data);
    }

    public function UserAdd(){
        return view('backend.user.add_user');
    }

    public function UserStore(Request $request){
        $validateData = $request->validate([
            'email' => 'required|unique:users',
            'name' => 'required'
        ]);

        $data = new User; //string untuk input data ke database
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt ($request->password);
        $data->save();

        $notification = array( //menambah alert message
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.view')->with($notification);
    }

    Public function UserEdit($id){
        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));
    }
    Public function UserUpdate(Request $request, $id){
        $data = User::find($id); //string untuk update data ke database berdasarkan id
        $data->usertype = $request->usertype;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->save();

        $notification = array( //menambah alert message
            'message' => 'User Updated Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);
    }

    Public function UserDelete($id){
        $user = User::find($id);
        $user->delete();

        $notification = array( //menambah alert message
            'message' => 'User Deleted Successfully',
            'alert-type' => 'info'
        );
        return redirect()->route('user.view')->with($notification);

    }
    
}
