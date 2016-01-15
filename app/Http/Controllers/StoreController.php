<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Product;
use Illuminate\Http\Request;

use CodeCommerce\Http\Requests;
use CodeCommerce\Http\Controllers\Controller;

class StoreController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $categories = Category::all();

        $Fproducts = Product::featured()->get();
        $Rproducts = Product::recommended()->get();

        return  view('store.index', compact('categories', 'Fproducts', 'Rproducts'));

    }

    public function category($id) {

        $categories = Category::all();
        $category =  Category::find($id);

        $products = Product::ofCategory($id)->get();

        return view('store.category', compact('categories', 'products', 'category'));
    }

    public function product($id) {

        $categories = Category::all();
        $product =  Product::find($id);

        return view('store.product', compact('categories', 'product'));
    }
}