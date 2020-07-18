<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Product;
use App\Model\ProductImages;

class FrontController extends Controller
{
    public function index(){
        $products = Product::orderBy("id", "DESC")->limit(10)->get();
        $featured = Product::where('is_featured', "1")->orderBy("id", "DESC")->limit(10)->get();
        return view("front.pages.home", compact("products", "featured"));
    }

    public function view($slug){
        $product = Product::where('slug', $slug)->first();
        $product_imgs = ProductImages::where("product_id", $product->id)->get();
        return view('front.pages.product', compact("product", "product_imgs"));
    }
}
