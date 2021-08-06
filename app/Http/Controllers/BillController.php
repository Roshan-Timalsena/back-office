<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Bill;
use App\Rules\PanRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BillController extends Controller
{
    //
    function index(){
        return view('bill.create');
    }

    function store(Request $request){
        $user = Auth::id();
        
        $request->validate([
            'date'=>"required|date",
            'firmname'=>'required|string|max:255',
            'pan'=>['required', new PanRule()],
            'photo'=>'required|image',
            'particulars' => 'required|string|max:255',
            'amount' => 'required|integer|min:10|required'
        ]);

        $bill = new Bill;

        $bill->date = $request->date;
        $bill->firm_name = $request->firmname;
        $bill->pan_number = $request->pan;
        $bill->amount = $request->amount;

        if($request->hasFile('photo')){
            $path = "public/photos";

            $file = $request->file('photo')->getClientOriginalName();
            $fname = pathinfo($file, PATHINFO_FILENAME);
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);

            $file_name = str_replace(' ', '-', $fname).time(). '.'.$file_ext;

            $request->file('photo')->storeAs($path, $file_name);
            $bill->vat_bill = $file_name;
        }

        $bill->save();

        $activity = new Activity;

        $activity->name = 'Bill';
        $activity->activity_type = 'Add';
        $activity->time = $request->date;
        $activity->user_id = $user;
        $activity->save();

        return redirect()->route('bill.form');
    }
}
