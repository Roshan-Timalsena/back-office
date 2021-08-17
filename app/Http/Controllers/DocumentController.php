<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

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

    function store(Request $request){
        return $request;
    }
}
