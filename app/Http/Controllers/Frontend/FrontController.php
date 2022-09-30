<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontController extends Controller
{
    public function index()
    {
        $feature_products = Product::where('trending', '1')->take(15)->get();
        $trending_cat = Category::where('popular', '1')->take(10)->get();
        return view('frontend.index', compact('feature_products', 'trending_cat'));
    }

    public function category()
    {
        //$category = Category::where('status', '0')->get();
        $category = Category::all();
        return view('frontend.category', compact('category'));
    }

    public function fetch_by_cat(Category $category)
    {
        //$products = Product::where('cate_id', $category->id)->where('status', '0')->get();
        $products = Product::where('cate_id', $category->id)->get();
        return view('frontend.products.product', compact('category', 'products'));
    }

    public function product_detail(Category $category, $pro_slug)
    {
        if ($category) {
            $pro_slug = Product::where('slug', $pro_slug);
            if ($pro_slug->exists()) {
                $products = $pro_slug->first();
                return view('frontend.products.product-details', compact('products'));
            } else {
                return redirect()->route('category')->with('status', 'No Realted Product Available');
            }
        }
    }
}
