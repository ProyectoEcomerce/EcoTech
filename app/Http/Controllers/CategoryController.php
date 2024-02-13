<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function getCategories()
    {
        $categories = Category::paginate(6);
        return view('welcome', compact('categories'));
    }

    public function create(Request $request){
        $request->validate(['name'=>'required']);
        $newCategory= new Category;
        $newCategory->name=$request->name;
        $newCategory->save();
        return back() -> with('mensaje', 'Categoria creada');
    }
    public function update(Request $request, $id){
        $request->validate([
            'name'=>'required',
            
        ]);
        $updateCategory=Category::findOrFail($id);
        $updateCategory->name=$request->name;
        $updateCategory->save();
        return back() -> with('mensaje', 'Categoría editada correctamente');
    }
    public function delete($id)
    {
        // Encuentra la categoría por su ID
        $category = Category::findOrFail($id);
        // Elimina la categoría
        $category->delete();
        // Redirige de vuelta con un mensaje
        return back()->with('mensaje', 'Categoría eliminada exitosamente.');
    }

    public function adminIndex(){
        $categories = Category::paginate(9); // Paginación de 9 productos
        return view('layouts.adminCategory', compact('categories'));
    }

    public function showProduct($id){
        $category=Category::findOrFail($id);
        return view('categorias', compact('category') );
    }
}
