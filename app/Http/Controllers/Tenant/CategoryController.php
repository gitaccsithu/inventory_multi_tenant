<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    { 
        $categories = Category::paginate(10);
        if($req->search) {
            $categories = Category::where('name', 'LIKE', '%' . $req->search . '%')->get();
        }
        return view('dashboard.tenant.tenant_category', [
            'subdomain' => $req->subdomain,
            'categories' => $categories,
            'current_page' => 'categories'
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
            'name' => 'required|unique:categories,name'
        ]);

        $new_category = Category::create($req->only('name'));
        return redirect()->back()->with('success', 'New category is successfully created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req)
    {
        $category = Category::find($req->id);
        $category->update($req->only(['name']));
        return redirect()->back()->with('success', 'Category is successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $req)
    {
        $category = Category::find($req->id);
        if($category->delete()) {
            return redirect()->back()->with('success', 'Successfully deleted');
        } else {
            return redirect()->back()->with('error', 'Unexpected error occur!');
        }
    }
}
