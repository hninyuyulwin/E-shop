<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('admin.product.product-index', compact('products'));
    }

    public function addProduct()
    {
        $categories = Category::all();
        return view('admin.product.product-add', compact('categories'));
    }

    public function storeProduct(Request $request)
    {
        $data = $request->all();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $exten = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . '.' . $exten;
            $file->move('assets/uploads/product/', $filename);

            $data['image'] = $filename;
        }
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->status == TRUE ? '1' : '0';
        $data['trending'] = $request->trending == TRUE ? '1' : '0';

        Product::create($data);
        return redirect()->route('products')->with('status', 'Product Created Success');
    }

    public function editProduct(Product $products)
    {
        $categories = Category::all();
        return view('admin.product.product-edit', compact('products', 'categories'));
    }

    public function updateProduct(Product $products, Request $request)
    {
        $data = $request->all();

        if ($request->image) {
            File::delete('assets/uploads/product/' . $products->image);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $exten = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . '.' . $exten;
            $file->move('assets/uploads/product/', $filename);

            $data['image'] = $filename;
        }
        $data['slug'] = Str::slug($request->name);
        $data['status'] = $request->status == TRUE ? '1' : '0';
        $data['trending'] = $request->trending == TRUE ? '1' : '0';

        $products->update($data);
        return redirect()->route('products')->with('status', 'Product Updated Success');
    }
    public function deleteProduct(Product $products)
    {
        if ($products->image) {
            File::delete('assets/uploads/product/' . $products->image);
        }
        $products->delete();
        return redirect()->route('products')->with('status', 'Product Deleted Success');
    }
}
