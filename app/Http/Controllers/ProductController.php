<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Image;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //listar los productos
    public function getProducts()
    {
        $products = Product::paginate(6); // Paginación de 6 productos
        return view('welcome', compact('products'));
    }

    public function create(Request $request){
        $request->validate(['name'=>'required','price'=>'required','offerPrice'=>'required','voltage'=>'required','guarantee'=>'required','manufacturing_price'=>'required','weigth'=>'required','materials'=>'required','description'=>'required','dimensions'=>'required','battery'=>'required','engine'=>'required','components'=>'required']);
        $newProduct= new Product;
        $newProduct->name=$request->name;
        $newProduct->price=$request->price;
        $newProduct->offerPrice=$request->offerPrice;
        $newProduct->voltage=$request->voltage;
        $newProduct->guarantee=$request->guarantee;
        $newProduct->manufacturing_price=$request->manufacturing_price;
        $newProduct->weigth=$request->weigth;
        $newProduct->materials=$request->materials;
        $newProduct->description=$request->description;
        $newProduct->dimensions=$request->dimensions;
        $newProduct->battery=$request->battery;
        $newProduct->engine=$request->engine;
        $newProduct->components=$request->components;
        $newProduct->save();
        return back() -> with('mensaje', 'Producto creado');
    }

    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'offerPrice'=>'required',
            'voltage'=>'required',
            'guarantee'=>'required',
            'manufacturing_price'=>'required',
            'weigth'=>'required',
            'materials'=>'required',
            'description'=>'required',
            'dimensions'=>'required',
            'battery'=>'required',
            'engine'=>'required',
            'components'=>'required'
        ]);
        $updateProduct=Product::findOrFail($id);
        $updateProduct->name=$request->name;
        $updateProduct->price=$request->price;
        $updateProduct->offerPrice=$request->offerPrice;
        $updateProduct->voltage=$request->voltage;
        $updateProduct->guarantee=$request->guarantee;
        $updateProduct->manufacturing_price=$request->manufacturing_price;
        $updateProduct->weigth=$request->weigth;
        $updateProduct->materials=$request->materials;
        $updateProduct->description=$request->description;
        $updateProduct->dimensions=$request->dimensions;
        $updateProduct->battery=$request->battery;
        $updateProduct->engine=$request->engine;
        $updateProduct->components=$request->components;
        $updateProduct->save();
        return back() -> with('mensaje', 'Producto editado exitosamente');
    }

    public function delete($id){
        $deleteProduct=Product::findOrFail($id);
        $deleteProduct->delete();
        return back() -> with('mensaje', 'Producto eliminado');
    }

    public function adminIndex(){
        $products = Product::paginate(9); // Paginación de 9 productos
        return view('layouts.adminProduct', compact('products'));
    }

    public function showProduct($id){
        $product=Product::findOrFail($id);
        return view('productos', compact('product') );
    }
}
