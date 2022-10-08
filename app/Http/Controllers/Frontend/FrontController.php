<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

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
                $ratings = Rating::where('prod_id', $products->id)->get();
                $rating_sum = Rating::where('prod_id', $products->id)->sum('stars_rated');
                $user_rating = Rating::where('prod_id', $products->id)->where('user_id', Auth::id())->first();

                $reviews = Review::where('prod_id', $products->id)->get();

                if ($ratings->count() > 0) {
                    $rating_value = $rating_sum / $ratings->count(); // find average of rating
                } else {
                    $rating_value = 0;
                }

                return view('frontend.products.product-details', compact('products', 'ratings', 'rating_value', 'user_rating', 'reviews'));
            } else {
                return redirect()->route('category')->with('status', 'No Realted Product Available');
            }
        }
    }

    public function productlistAjax()
    {
        //$products = Product::select('name')->where('status', 0)->get();
        $products = Product::select('name')->get();
        $data = [];
        foreach ($products as $item) {
            $data[] = $item['name'];
        }
        //return response()->json(['status' => $data]);
        return $data;
    }

    public function searchProduct(Request $request)
    {
        $search = $request->search;
        if ($search != '') {
            $product = Product::where('name', 'LIKE', "%$search%")->first();
            if ($product) {
                return redirect('category/' . $product->category->slug . '/' . $product->slug);
            } else {
                return redirect()->back()->with('status', 'No match item in our list');
            }
        } else {
            return redirect()->back();
        }
    }
}
