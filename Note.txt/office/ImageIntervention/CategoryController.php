<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use App\Traits\HasImage;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    use UploadAble;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('priority','ASC')->paginate(10);
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage_old.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'priority' => 'required|integer|min:0',
            'image' => 'required|image',
        ]);
        $category = new Category();
        $category->fill($request->all());
        if ($request->hasFile('image')) {
          $filename = $this->uploadOne($request->image, 300, 300, config('imagepath.category'));
            $category->image = $filename;
            $category->save();
        }
        $category->save();
        Toastr::success('Category created successfully', 'Success');
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage_old.
     */
    public function update(Request $request,$id)
    {
        $request->validate([
            'name' => 'nullable|unique:categories,name,' . $id . '|max:255',
            'status' => 'nullable|boolean',
            'priority' => 'nullable|integer|min:0',
        ]);
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->slug = $request->slug;
        $category->status = $request->status;
        $category->priority = $request->priority;

        if ($request->hasFile('image')) {
            $filename = $this->uploadOne($request->image, 300, 300, config('imagepath.category'));
            $this->deleteOne(config('imagepath.category'), $category->image);
            $category->update(['image' => $filename]);
        }
        $category->update();
        Toastr::success('Category updated successfully', 'Success');
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}
