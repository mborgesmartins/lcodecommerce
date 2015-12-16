<?php

namespace CodeCommerce\Http\Controllers;

use CodeCommerce\Category;
use CodeCommerce\Http\Requests;

class CategoriesController extends Controller
{
    //

    private $categoriesmodel;

    public function __construct(Category $categoriesmodel) {

        $this->categoriesmodel = $categoriesmodel;

    }

    public function index() {

        $categories = $this->categoriesmodel->all();

        return view('categories.index', compact('categories'));

    }

    public function create() {


        return view('categories.create');

    }

    public function store(Requests\CategoriesRequest $request) {

        $input = $request->all();
        $this->categoriesmodel->fill($input);
        $this->categoriesmodel->save();

        return redirect()->route('categories');

    }

    public function edit($id) {

        $category = $this->categoriesmodel->find($id);

        return view('categories.edit', compact('category'));

    }

    public function update(Requests\CategoriesRequest $request, $id) {

        $this->categoriesmodel->find($id)->update($request->all());

        return redirect()->route('categories');

    }


    public function destroy($id) {

        $this->categoriesmodel->find($id)->delete();

        return redirect()->route('categories');

    }

}
