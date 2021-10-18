<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $user = Auth::id();

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

        $activity = new Activity;
        $activity->name = "Products";
        $activity->activity_type = "Created";
        $activity->time = $product->created_at;
        $activity->user_id = $user;
        $activity->activity_on = "Added Product ". $product->product_name;

        $activity->save();
        return redirect()->route('products.all');
    }

    function getSingleProduct(Product $product){
        $this->authorize('update', $product);
        return view('products.update',['product'=>$product]);
    }

    function updateProduct(Request $request, Product $product){
        $this->authorize('update', $product);

        $user = Auth::id();

        $request->validate([
            'prodname'=>'required|max:255'
        ]);

        $prod = Product::find($product->id);
        $prod->touch();

        $prod->product_name = $request->prodname;
        $prod->description = $request->description;
        $prod->price_1 = $request->price1;
        $prod->price_2 = $request->price2;
        $prod->price_3 = $request->price3;
        $prod->status = $request->status;
        $prod->bar_code = $request->barcode;

        $prod->save();

        $activity = new Activity;
        $activity->name = "Products";
        $activity->activity_type = "Updated";
        $activity->time = $product->updated_at;
        $activity->user_id = $user;
        $activity->activity_on = "Updated Product ". $product->product_name;

        $activity->save();
        return redirect()->route('products.all');
    }

    function remove(Product $product){
        $this->authorize('delete', $product);
        
        $product->delete();

        $user = Auth::id();

        $activity = new Activity;
        $activity->name = "Products";
        $activity->activity_type = "Updated";
        $activity->time = $product->deleted_at;
        $activity->user_id = $user;
        $activity->activity_on = "Removed Product ". $product->product_name;

        $activity->save();
        return redirect()->route('products.all');
    }

    function getProductsTrash(){
        $this->authorize('viewAny', Product::class);

        $prods = Product::onlyTrashed()->get();
        return view('products.trash', ['products' => $prods, 'count'=>1]);
    }

    function restoreProduct($id){
        $this->authorize('restore', Product::class);

        $user = Auth::id();
        Product::onlyTrashed()->find($id)->restore();

        $prod = Product::where('id','=',$id)->value('product_name');

        $activity = new Activity;
        $activity->name = "Products";
        $activity->activity_type = "Restored";
        $activity->time = Carbon::now()->toDateTimeString();
        $activity->user_id = $user;
        $activity->activity_on = "Restored Product ". $prod;

        $activity->save();
        return redirect()->route('products.all');
    }

    function deleteProduct($id){
        $this->authorize('forceDelete', Product::class);

        $user = Auth::id();

        $prod = Product::onlyTrashed()->where('id','=',$id)->value('product_name');

        $activity = new Activity;
        $activity->name = "Products";
        $activity->activity_type = "Deleted";
        $activity->time = Carbon::now()->toDateTimeString();
        $activity->user_id = $user;
        $activity->activity_on = "Deleted Product ". $prod;

        $activity->save();

        Product::onlyTrashed()->where('id','=',$id)->forceDelete();

        return redirect()->route('products.all');

    }
}
