<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    function index(){
        $products = Product::get();
        return view('products.products', ['products'=>$products, 'count'=>1]);
    }

    function addProduct(){
        return view('products.create');
    }

    function prodStore(Request $request){
        $this->authorize('create', Product::class);

        $fileNames = '';
        $files = $request->file('file');
        $count = count($files);

        for ($i = 0; $i < $count; $i++) {
            $f = $files[$i]->getClientOriginalName();
            $ext = pathinfo($f, PATHINFO_EXTENSION);
            $name = pathinfo($f, PATHINFO_FILENAME);
            $fname = str_replace(' ', '-',$name) . time() . '.' . $ext;
            $files[$i]->storeAs('/public/product', $fname);
            $fileNames .= $fname . ',';
        }
        return response()->json(['file' => $fileNames, 'message' => 'success']);
    }

    function store(Request $request){
        $this->authorize('create', Product::class);

        $request->validate([
            'prodname'=>'required|max:255'
        ]);

        $product = new Product;

        $product->product_name = $request->prodname;
        $product->description = $request->description;
        $product->price_1 = $request->price1;
        $product->price_2 = $request->price2;
        $product->price_3 = $request->price3;
        $product->images = $request->file;
        $product->status = $request->status;
        $product->bar_code = $request->barcode;

        $product->save();
        return redirect()->route('products.all');
    }

    function getSingleProduct(Product $product){
        $this->authorize('update', $product);
        return view('products.update',['product'=>$product]);
    }
}
