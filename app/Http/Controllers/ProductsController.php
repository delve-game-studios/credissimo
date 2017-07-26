<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Requests\StoreProductRequest;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    private function checkIsAdmin() {
        if(!Auth::user()->hasRole('Admin')) {
            redirect('/shop')->with('error', 'Access Denied!')->send();
        }

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->checkIsAdmin();
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->checkIsAdmin();
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->checkIsAdmin();
        $data = $request->all();

        $imagePath = $request->file('image')->disk('images')->store('img');
        var_dump($imagePath);exit;
        $image = Image::make(Storage::get($imagePath))->resize(320,240)->encode();
        Storage::disk('uploads')->put($imagePath, $image);

        $imagePath = str_replace('img/', '', $imagePath);

        $data['image'] = $imagePath;
        $data['slug'] = strtolower(implode('-', explode(' ', $data['name'])));

        Product::create($data);
        return redirect()->route('products.index')->with(['message' => 'Product added successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->checkIsAdmin();
        $product = Product::findOrFail($id);
        return view('products.view', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->checkIsAdmin();
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreProductRequest $request, $id)
    {
        $this->checkIsAdmin();
        $data = $request->all();
        $product = Product::findOrFail($id);

        if(!empty($data['image'])) {
            $imagePath = $request->file('image')->store('img');
            $image = Image::make(Storage::get($imagePath))->encode();
            Storage::disk('images')->put($imagePath, $image);
            Storage::disk('images')->delete("{$product->image}");

            $data['image'] = $imagePath;
        } else {
            $data['image'] = $product->image;
        }
        
        $data['slug'] = strtolower(implode('-', explode(' ', $data['name'])));
        $product->update($data);
        return redirect()->route('products.index')->with(['message' => 'Product updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $back = false)
    {
        $this->checkIsAdmin();
        $product = Product::findOrFail($id);
        Storage::disk('images')->delete("img/{$product->image}");
        $product->delete();

        return !$back ? redirect()->route('products.index')->with(['message' => 'Product deleted successfully']) : true;
    }

    public function massDestroy(Request $request)
    {
        $this->checkIsAdmin();
        $products = explode(',', $request->input('ids'));
        foreach ($products as $product_id) {
            $temp = $this->destroy($product_id, true);
        }
        return redirect()->route('products.index')->with(['message' => 'Products deleted successfully']);
    }
}
