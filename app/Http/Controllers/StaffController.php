<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    //
    function index(){
        $staffs = User::get();
        return view('staff.staffs', ['staffs'=>$staffs, 'count'=>1]);
    }

    function addStaff(){
        return view('staff.create');
    }

    function store(Request $request){
        $request->validate([
            'staffname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:25',
            'bill'=>'required'
        ]);

        $roles = $request->billCreate . ','. $request->billRead . ',' . $request->billUpdate . ',' . $request->billDelete;
        $actualRoles = array_values(array_filter(explode(',',$roles)));
        if(count($actualRoles) == 4){
            $actualRoles = ["billAll"];
        }

        $staff = new User;
        $staff->name = $request->staffname;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->user_type = $actualRoles;
        $staff->save();

        $activity = new Activity;

        


        return redirect()->route('staff.all');
    }
}
