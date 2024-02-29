<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    //Listar categorias en la vista Categorias
    public function getCategories()
    {
        $categories = Category::paginate(6);
        return view('layouts.adminCategory', compact('categories'));
    }

    //Crear nueva categoría
    public function create(Request $request)
    {
        $request->validate(['name' => 'required']);
        $newCategory = new Category;
        $newCategory->name = $request->name;
        $newCategory->save();
        return back()->with('mensaje', 'Categoría creada');
    }

    //Actualizar categoría
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $updateCategory = Category::findOrFail($id);
        $updateCategory->name = $request->name;
        $updateCategory->save();
        return back()->with('mensaje', 'Categoría editada correctamente');
    }

    //Eliminar categoría
    public function delete($id)
    {

        $category = Category::findOrFail($id);
        DB::table('categories_products')->where('category_id', $id)->delete();
        $category->delete();
        return back()->with('mensaje', 'Categoría eliminada exitosamente.');
    }

    //
    public function adminIndex()
    {
        $categories = Category::paginate(9);
        $allProducts = Product::all();
        return view('layouts.adminCategory', compact('categories', 'allProducts'));
    }

    public function showProduct($id)
    {
        $category = Category::findOrFail($id);
        return view('categorias', compact('category'));
    }

    public function addProducts(Request $request, $categoryId)
    {
        $category = Category::find($categoryId);
        $productIds = $request->input('product_ids', []);
        $category->products()->syncWithoutDetaching($productIds);
        return back()->with('success', 'Productos añadidos correctamente a la categoría.');
    }

    
    public function showCategoriesAndProducts()
    {
        $categories = Category::with('products')->get();
        return view('layouts.adminCategory', compact('categories'));
    }

public function showCategoriesWithProducts()
{
    $categories = Category::with('products')->get(); 

    return view('categorias_con_productos', compact('categories'));
}

public function removeProducts(Request $request, $category)
{
    $category = Category::findOrFail($category);

    // Asumiendo una relación muchos a muchos entre categorías y productos
    if($request->has('product_ids')) {
        $category->products()->detach($request->input('product_ids'));
    }

    return back()->with('success', 'Productos eliminados de la categoría con éxito.');
}

}