<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StaffController extends Controller
{
    //
    function index()
    {
        $staffs = User::get();
        return view('staff.staffs', ['staffs' => $staffs, 'count' => 1]);
    }

    function addStaff()
    {
        return view('staff.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'staffname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:25',
            'bill' => 'present',
            'documents' =>'present',
        ]);

        return $request;
        $roles = $request->billCreate . ',' . $request->billRead . ',' . $request->billUpdate . ',' . $request->billDelete;
        $actualRoles = array_values(array_filter(explode(',', $roles)));
        if (count($actualRoles) == 4) {
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

    function getSingleStaff(User $user)
    {
        $this->authorize('update', $user);

        return view('staff.update', ['staff' => $user]);
    }

    function updateStaff(User $user, Request $request)
    {
        $this->authorize('update', $user);

        $request->validate([
            'staffname' => 'max:255',
            'email' => 'email',
            'bill' => 'nullable',
        ]);

        $u = User::find($user->id);
        $u->touch();

        $u->name = $request->name;
        $u->email = $request->email;

        if ($request->has('bill')) {
            $roles = $request->billCreate . ',' . $request->billRead . ',' . $request->billUpdate . ',' . $request->billDelete;
            $actualRoles = array_values(array_filter(explode(',', $roles)));
            if (count($actualRoles) == 4) {
                $actualRoles = ["billAll"];
            }

            $u->user_type = $actualRoles;
        }

        // return $u;
        $u->save();
        return redirect()->route('staff.all');
    }
}
