<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $products = Product::paginate(10);
        if($req->search) {
            $products = Product::where('name', 'LIKE', '%' . $req->search . '%')->get();
        }
        return view('dashboard.tenant.tenant_product', [
            'subdomain' => $req->subdomain,
            'categories' => Category::all(),
            'products' => $products,
            'current_page' => 'products'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        $this->validate($req, [
            'name' => 'required|unique:products,name',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'category_id' => 'required'
        ]);

        $new_product = Product::create($req->only('category_id', 'name', 'price', 'quantity'));
        return redirect()->back()->with('success', 'New product is successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
        $product = Product::find($req->id);
        $product->update($req->only('category_id', 'name', 'price', 'quantity'));
        return redirect()->back()->with('success', 'The product is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req)
    {
        $product = Product::find($req->id);
        if($product->delete()) {
            return redirect()->back()->with('success', 'Successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Unexpected error occur!');
        }
    }
}
