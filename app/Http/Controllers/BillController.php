<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Bill;
use App\Rules\PanRule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DataTables\BillDataTable;

class BillController extends Controller
{
    //
    function index(){
        // return date('Y-m-d h:i:s a');
        $this->authorize('create', Bill::class);
        return view('bill.create');
    }

    function store(Request $request){

        $this->authorize('create', Bill::class);

        $user = Auth::id();
        
        $request->validate([
            'billdate' => 'required|date',
            'firmname'=>'required|string|max:255',
            'pan'=>['required', new PanRule()],
            'photo'=>'required|image',
            'particulars' => 'required|string|max:255',
            'amount' => 'required|integer|min:10|required'
        ]);

        $bill = new Bill;

        $bill->firm_name = $request->firmname;
        $bill->bil_date = $request->billdate;
        $bill->pan_number = $request->pan;
        $bill->particulars = $request->particulars;
        $bill->amount = $request->amount;
        $bill->user_id = $user;

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
        $activity->activity_type = 'Created';
        $activity->time = $bill->created_at;
        $activity->user_id = $user;
        $activity->activity_on = "Bill ID: " . $bill->id;
        $activity->save();

        return redirect()->route('bill.all');
    }

    function allBills(){

        $bills = Bill::get();

        return view('bill.bills', ['bills'=>$bills, 'count'=>1]);
    }

    function getSingleBill(Bill $bill){
        $this->authorize('update', $bill);
        return view('bill.update', ['bill'=>$bill]);
    }

    function updateBill(Request $request, Bill $bill){

        $this->authorize('update', $bill);

        $user = Auth::id();

        $request->validate([
            'firmname'=>'required|string|max:255',
            'pan'=>['required', new PanRule()],
            'photo'=>'image',
            'particulars' => 'required|string|max:255',
            'amount' => 'required|integer|min:10|required'
        ]);

        $b = Bill::find($bill->id);
        $b->touch();

        $b->firm_name = $request->firmname;
        $b->pan_number = $request->pan;
        $b->particulars = $request->particulars;
        $b->amount = $request->amount;

        if($request->hasFile('photo')){
            $path = "public/photos";

            $file = $request->file('photo')->getClientOriginalName();
            $fname = pathinfo($file, PATHINFO_FILENAME);
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);

            $file_name = str_replace(' ', '-', $fname).time(). '.'.$file_ext;

            $request->file('photo')->storeAs($path, $file_name);
            $b->vat_bill = $file_name;
        }

        $b->save();

        $activity = new Activity;

        $activity->name = 'Bill';
        $activity->activity_type = 'Updated';
        $activity->time = $b->updated_at;
        $activity->activity_on = "Bill ID: " . $b->id;
        $activity->user_id = $user;
        $activity->save();

        return redirect()->route('bill.all');

    }

    function softDeleteBill(Bill $bill){
        $this->authorize('delete', $bill);
        $user = Auth::id();
        $bill->delete();

        $activity = new Activity;

        $activity->name = 'Bill';
        $activity->activity_type = "Deleted";
        $activity->time = $bill->deleted_at;
        $activity->user_id = $user;
        $activity->activity_on = "Bill ID: ". $bill->id;
        $activity->save();
        return redirect()->route('bill.all');
    }

    function getTrashed(){
        $bills = Bill::onlyTrashed()->get();
        
        return view('bill.trash', ['bills' => $bills, 'count' => 1]);
    }

    function restore($id){

        $this->authorize('restore', Bill::class);

        $user = Auth::id();
        Bill::onlyTrashed()->find($id)->restore();

        $activity = new Activity;

        $activity->name = "Bill";
        $activity->activity_type = "Restored";
        $activity->time = Carbon::now()->toDateTimeString();;
        $activity->user_id = $user;
        $activity->activity_on = "Bill ID: " . $id;

        $activity->save();
        return redirect()->route('bill.all');
    }

    function delete($id){

        $this->authorize('forceDelete', $id);

        $user = Auth::id();

        $activity = new Activity;

        $activity->name = "Bill";
        $activity->activity_type = "Permanent Delete";
        $activity->time = Carbon::now()->toDateTimeString();
        $activity->user_id = $user;
        $activity->activity_on = "Bill ID: " . $id;

        $activity->save();

        Bill::onlyTrashed()->where('id','=',$id)->forceDelete();
        return redirect()->route('bill.all');
    }
}
