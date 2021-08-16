<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
            'ba'=>'required'
        ]);
    }
}
