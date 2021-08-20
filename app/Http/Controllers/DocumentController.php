<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


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
        
        $this->authorize('create', Document::class);

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

        $this->authorize('create', Document::class);

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

    function getSingleDoc(Document $document){
        
        $this->authorize('update', $document);
        return view('docs.update', ['doc'=>$document]);
    }

    function updateDoc(Document $document, Request $request){

        $this->authorize('update', $document);

        $user = Auth::id();

        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
            'documentType' => ['required', Rule::in(['invoice','contract','note','voucher'])],
            'tags' => 'required',
            'file' => 'nullable',
        ]);

        
        $doc = Document::find($document->id);
        $doc->touch();
        
        $doc->document_name = $request->name;
        $doc->document_desc = $request->description;
        $doc->images = $request->file;
        $doc->document_type = $request->documentType;
        $doc->tags = $request->tags;

        $doc->save();

        $activity = new Activity;

        $activity->name = "Documents";
        $activity->activity_type = "Updated";
        $activity->time = $doc->updated_at;
        $activity->user_id = $user;
        $activity->activity_on = 'ID '.$document->id;

        $activity->save();
        return redirect()->route('docs.all');
    }

    function remove(Document $document){
        $this->authorize('delete', $document);

        $user = Auth::id();
        $document->delete();

        $activity = new Activity;

        $activity->name = 'Document';
        $activity->activity_type = "Deleted";
        $activity->time = $document->deleted_at;
        $activity->user_id = $user;
        $activity->activity_on = "ID ". $document->id;
        $activity->save();
        return redirect()->route('docs.all');
    }

    function restoreDocs($id){
        $this->authorize('restore', Document::class);

        $user = Auth::id();
        Document::onlyTrashed()->find($id)->restore();

        $activity = new Activity;

        $activity->name = "Bill";
        $activity->activity_type = "Restored";
        $activity->time = Carbon::now()->toDateTimeString();;
        $activity->user_id = $user;
        $activity->activity_on = "Bill ID: " . $id;

        $activity->save();
        return redirect()->route('docs.all');
    }

    function deleteDocs($id){
        $this->authorize('forceDelete', Document::class);

        $user = Auth::id();

        $activity = new Activity;

        $activity->name = "Bill";
        $activity->activity_type = "Permanent Delete";
        $activity->time = Carbon::now()->toDateTimeString();
        $activity->user_id = $user;
        $activity->activity_on = "Bill ID: " . $id;

        $activity->save();

        Document::onlyTrashed()->where('id','=',$id)->forceDelete();
        return redirect()->route('docs.all');
    }

    function getDocsTrash(){

        $docs = Document::onlyTrashed()->get();
        return view('docs.trash', ['docs' => $docs, 'count' =>1]);
    }
}
