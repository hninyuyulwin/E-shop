<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'desc')->get();
        return view('admin.category.cat-index', compact('categories'));
    }

    public function addCat()
    {
        return view('admin.category.cat-add');
    }

    public function storeCat(Request $request)
    {
        $category = new Category();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $exten = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . '.' . $exten;
            $file->move('assets/uploads/category/', $filename);

            $category->image = $filename;
        }

        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $category->status = $request->status == TRUE ? '1' : '0';
        $category->popular = $request->popular == TRUE ? '1' : '0';
        $category->meta_title = $request->meta_title;
        $category->meta_keywords = $request->meta_keywords;
        $category->meta_descrip = $request->meta_description;
        $category->save();
        return redirect()->route('categories')->with('status', 'Category Added Success');
    }

    public function editCart(Category $categories)
    {
        return view('admin.category.cat-edit', compact('categories'));
    }

    public function updateCart(Category $categories, Request $request)
    {
        if ($request->image) {
            File::delete('assets/uploads/category/' . $categories->image);
        }
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $exten = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . '.' . $exten;
            $file->move('assets/uploads/category/', $filename);

            $categories->image = $filename;
        }
        $categories->name = $request->name;
        $categories->slug = Str::slug($request->name);
        $categories->description = $request->description;
        $categories->status = $request->status == TRUE ? '1' : '0';
        $categories->popular = $request->popular == TRUE ? '1' : '0';
        $categories->meta_title = $request->meta_title;
        $categories->meta_keywords = $request->meta_keywords;
        $categories->meta_descrip = $request->meta_description;
        $categories->save();
        return redirect()->route('categories')->with('status', 'Category Data Updated!');
    }
    public function deleteCart(Category $categories)
    {
        if ($categories->image) {
            File::delete('assets/uploads/category/' . $categories->image);
        }
        $categories->delete();
        return redirect()->route('categories')->with('status', 'Category Data Deleted!');
    }
}
