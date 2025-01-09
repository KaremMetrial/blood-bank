<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\CreateCategoryRequest;
use App\Http\Requests\Web\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('admins.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
        ]);
        if (!$category) {
            toastr()->error('Category not created');
            return redirect()->back();
        }
        toastr()->success('Category created successfully');
        return redirect()->route(route: 'categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('admins.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $category->update([
            'name' => $request->name,
        ]);

        if (!$category->wasChanged()) {
            toastr()->error('Category not updated');
            return redirect()->back();
        }

        toastr()->success('Category updated successfully');
        return redirect()->route('categories.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        if (!$category) {
            toastr()->error('Category not deleted');
            return redirect()->back();
        }
        toastr()->success('Category deleted successfully');
        return redirect()->back();
    }
}
