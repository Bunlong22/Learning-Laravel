<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Validator;
use Session;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = array();
        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }
        return view('product.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:20|min:3',
            'category_id' => 'required|integer',
            'price' => 'required|max:20|min:2',
            'image' => 'required|mimes:jpg,jpeg,png,gif',
            'description' => 'required|max:1000|min:10',
        ]);
          
        if ($validator->fails()) {
            return redirect('product/create')
                ->withInput()
                ->withErrors($validator);
        }
    
        // Create The product
        $image = $request->file('image');
        $upload = 'img/products/';
        $filename = time().$image->getClientOriginalName();
        move_uploaded_file($image->getPathName(), $upload. $filename);
    
        $product = new Product();
        $product->name = $request->name;
	$product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->image = $filename;
        $product->description = $request->description;
        $product->save();
        Session::flash('product_create','New data is created.');
        return redirect('product/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = array();
        foreach (Category::all() as $category) {
            $categories[$category->id] = $category->name;
        }
        $product = Product::findOrFail($id);
        return view('product.edit')->with('product', $product)->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
			'name' => 'required|max:20|min:3',
			'price' => 'required|max:20|min:2',
			'image' => 'mimes:jpg,jpeg,png,gif',
			'description' => 'required|max:1000|min:5',
		]);

		if ($validator->fails()) {
			return redirect('product/'.$id.'/edit')
				->withInput()
				->withErrors($validator);
		}
        $product = Product::find($id);
		// Create The Post
		if($request->file('image') != ""){
            $image = $request->file('image');
            $upload = 'img/products/';
            $filename = time().$image->getClientOriginalName();
move_uploaded_file($image->getPathName(), $upload . $filename);
		}
		
		$product->name = $request->Input('name');
		$product->price = $request->Input('price');
		if(isset($filename)){
		    $product->image = $filename;
		}
        
		$product->description = $request->Input('description');
		$product->save();

		Session::flash('product_update','Data is updated');
		return redirect('product/'.$product->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
    	$image_path = 'img/products/'.$product->image;
    	File::delete($image_path);
    	$product->delete();
    	Session::flash('product_delete','Data is deleted.');
    	return redirect('product');
    }
}