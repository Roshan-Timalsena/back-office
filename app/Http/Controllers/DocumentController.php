<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;


class DocumentController extends Controller
{
    //

    function index(){

        $docs = Document::get();
        return view('docs.docs', ['docs' => $docs, 'count' => 1]);
    }

    function addDocs(){

        return view('docs.create');
    }

    function docStore(Request $request){
        $fileNames = '';
        $files = $request->file('file');
        $count = count($files);

        for ($i = 0; $i < $count; $i++) {
            $f = $files[$i]->getClientOriginalName();
            $ext = pathinfo($f, PATHINFO_EXTENSION);
            $name = pathinfo($f, PATHINFO_FILENAME);
            $fname = str_replace(' ', '-',$name) . time() . '.' . $ext;
            $files[$i]->storeAs('/public/docs', $fname);
            $fileNames .= $fname . ',';
        }
        return response()->json(['file' => $fileNames, 'message' => 'success']);
    }

    function store(Request $request){

        $user = Auth::id();

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'documentType' => ['required', Rule::in(['invoice','contract','note','voucher'])],
            'tags' => 'required',
            'file' => 'required',
        ]);

        
        $doc = new Document;
        
        $doc->document_name = $request->name;
        $doc->document_desc = $request->description;
        $doc->images = $request->file;
        $doc->document_type = $request->documentType;
        $doc->tags = $request->tags;

        $doc->save();

        $activity = new Activity;

        $activity->name = "Documents";
        $activity->activity_type = "Created";
        $activity->time = $doc->created_at;
        $activity->user_id = $user;
        $activity->activity_on = 'ID '.$doc->id;

        $activity->save();
        return redirect()->route('docs.all');
    }
}
