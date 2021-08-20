<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

        $user = Auth::id();

        $request->validate([
            'staffname' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:25',
            'bill' => 'required_unless:documents,on',
            'documents' => 'required_unless:bill,on',
        ]);

        // return $request;
        $billRoles = $request->billNone . ',' . $request->billCreate . ',' . $request->billRead . ',' . $request->billUpdate . ',' . $request->billDelete;
        $actualBillRoles = array_values(array_filter(explode(',', $billRoles)));
        if (count($actualBillRoles) == 4) {
            $actualBillRoles = ["billAll"];
        }

        $docsRole = $request->docsNone . ',' . $request->docsCreate . ',' . $request->docsRead . ',' . $request->docsUpdate . ',' . $request->docsDelete;
        $actualDocsRoles = array_values(array_filter(explode(',', $docsRole)));
        if (count($actualDocsRoles) == 4) {
            $actualDocsRoles = ["docsAll"];
        }

        $finalRoles = array_merge($actualBillRoles, $actualDocsRoles);

        $staff = new User;
        $staff->name = $request->staffname;
        $staff->email = $request->email;
        $staff->password = Hash::make($request->password);
        $staff->user_type = $finalRoles;
        $staff->save();

        $activity = new Activity;

        $activity->name = "Staff";
        $activity->activity_type = "Created";
        $activity->time = $staff->created_at;
        $activity->user_id = $user;
        $activity->activity_on = "Added " . $staff->name;
        $activity->save();

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
        ]);

        $u = User::find($user->id);
        $u->touch();

        $u->name = $request->staffname;
        $u->email = $request->email;

        if ($request->has('bill') || $request->has('documents')) {
            $billRoles = $request->billNone . ',' . $request->billCreate . ',' . $request->billRead . ',' . $request->billUpdate . ',' . $request->billDelete;
            $actualBillRoles = array_values(array_filter(explode(',', $billRoles)));
            if (count($actualBillRoles) == 4) {
                $actualBillRoles = ["billAll"];
            }

            $docsRole = $request->docsNone . ',' . $request->docsCreate . ',' . $request->docsRead . ',' . $request->docsUpdate . ',' . $request->docsDelete;
            $actualDocsRoles = array_values(array_filter(explode(',', $docsRole)));
            if (count($actualDocsRoles) == 4) {
                $actualDocsRoles = ["docsAll"];
            }

            $finalRoles = array_merge($actualBillRoles, $actualDocsRoles);
            
            $u->user_type = $finalRoles;
        }

        // return $u;
        $u->save();
        return redirect()->route('staff.all');
    }
}
