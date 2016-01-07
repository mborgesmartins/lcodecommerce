<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;
use CodeCommerce\Product;
use CodeCommerce\ProductImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    //

    private $productsmodel;

    public function __construct(Product $productsmodel) {

        $this->productsmodel = $productsmodel;

    }

    public function index() {

        $products = $this->productsmodel->paginate(10);

        return view('products.index', compact('products'));

    }

    public function create(Category $category) {

        $categories = $category->lists('name','id');
        return view('products.create', compact('categories'));

    }

    public function store(Requests\ProductsRequest $request) {

        $input = $request->all();
        $this->productsmodel->fill($input);
        $this->productsmodel->save();

        return redirect()->route('products');

    }

    public function edit($id, Category $category) {

        $product = $this->productsmodel->find($id);

        $categories = $category->lists('name','id');

        return view('products.edit', compact('product'), compact('categories'));

    }

    public function update(Requests\ProductsRequest $request, $id) {

        $this->productsmodel->find($id)->update($request->all());

        return redirect()->route('products');

    }


    public function destroy($id) {

        $this->productsmodel->find($id)->delete();

        return redirect()->route('products');

    }

    public function images_index($id) {

        $product = $this->productsmodel->find($id);

        return view('products.images.index', compact('product'));

    }

    public function images_create($id) {

        $product = $this->productsmodel->find($id);

        return view('products.images.create', compact('product'));

    }

    public function images_store(Requests\ProductImageRequest $request, $id, ProductImages $productimage) {


        $file = $request->file('image');

        $extension = $file->getClientOriginalExtension();

        $image = $productimage::create(['product_id'=>$id, 'extension'=>$extension]);

        Storage::disk('publiclocal')->put($image->id . '.' . $extension, File::get($file));

        return redirect()->route('products.images', ['id'=>$id]);

    }

    public function images_destroy($id, ProductImages $productimage) {

        $image = $productimage::find($id);
        $image->delete();
        $product_id = $image->product_id;

        $filename = public_path() . '/uploads/' . $id . '/' . $image->extension;

        if (file_exists($filename)) {

            //
            Storage::disk('publiclocal')->delete($id . '/' . $image->extension);

        }

        return redirect()->route('products.images', ['id'=>$product_id]);

    }

}
