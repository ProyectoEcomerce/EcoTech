<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::paginate(6);
        return view('welcome', compact('categories'));
    }

    public function create(Request $request)
    {
        $request->validate(['name' => 'required']);
        $newCategory = new Category;
        $newCategory->name = $request->name;
        $newCategory->save();
        return back()->with('mensaje', 'Categoría creada');
    }

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

    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return back()->with('mensaje', 'Categoría eliminada exitosamente.');
    }

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
}