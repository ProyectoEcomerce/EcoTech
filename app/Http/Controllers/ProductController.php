<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();
        try{
            $request->validate([
                'name'=>'required',
                'price'=>'required|numeric|min:0',
                'offerPrice'=>'required|numeric|min:0',
                'voltage'=>'required|integer|min:0',
                'guarantee'=>'required|integer|min:0',
                'manufacturing_price'=>'required|numeric|min:0',
                'weigth'=>'required|numeric|min:0',
                'materials'=>'required',
                'description'=>'required',
                'dimensions'=>'required',
                'battery'=>'required',
                'engine'=>'required',
                'components'=>'required',
                'image.*' => 'required|image|mimes:jpeg,png,jpg|max:2048'
            ]);
    
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

            if($request->hasFile('image')){
                foreach($request->file('image') as $img){ //Iteramos por el array de imagenes
                    $imageName = $img->getClientOriginalName(); //Guardamos el nombre del archivo 
                    $img->move(public_path('/img'), $imageName); //Lo movemos a public
                    
                    $newImage = new Image(); //Guardamos la imagen con su id y su ruta
                    $newImage->product_id = $newProduct->id;
                    $newImage->product_photo = '/img/' . $imageName;
                    $newImage->save();
                }
            }

            DB::commit();
            return back() -> with('mensaje', 'Producto creado');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo crear el producto');
        }
        
    }

    public function update(Request $request, $id){
        DB::beginTransaction();
        try{
            $request->validate([
                'name'=>'required',
                'price'=>'required|numeric|min:0',
                'offerPrice'=>'required|numeric|min:0',
                'voltage'=>'required|integer|min:0',
                'guarantee'=>'required|integer|min:0',
                'manufacturing_price'=>'required|numeric|min:0',
                'weigth'=>'required|numeric|min:0',
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
            DB::commit();
            return back() -> with('mensaje', 'Producto editado exitosamente');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo editar el producto');
        }
    }

    public function delete($id){
        $deleteProduct=Product::findOrFail($id);
        DB::beginTransaction();
        try{
            DB::table('products_wishlists')->where('product_id', $id)->delete();
            DB::table('categories_products')->where('product_id', $id)->delete();
            DB::table('carts_products')->where('product_id', $id)->delete();
            DB::table('images')->where('product_id', $id)->delete();
            $deleteProduct->delete();
            DB::commit();
            return back() -> with('mensaje', 'Producto eliminado');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->withErrors('No se pudo eliminar el producto');
        }
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

