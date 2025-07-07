<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category_list(){
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.categories.categoryList', compact('categories'));
    }

    public function category_form(Request $request){
        if ($request->input('id')) {
            $category = Category::find($request->input('id'));
            return view('admin.categories.categoryForm', compact('category'));
        } else {
            $category = (object) ['name' => null, 'description' => null];
            return view('admin.categories.categoryForm', compact('category'));
        }
    }

    public function category_add(Request $request){
        $valid = $request->validate([
            'name' => 'required|string|max:150',
            'description' => 'required|string',
        ]);

        try {
            Category::create($valid);
            return redirect()->route('category.list')->with('message', 'Kategori Sukses Batu Dibuat!');
        } catch (\Throwable $th) {
            return back()->with('error', 'Kesalahan saat menambahkan kategori, mohon coba beberapa saat lagi');
        }
    }

    public function category_delete($id){
        try {
            Category::where('id', $id)->delete();
            return back()->with('message', 'Kategori Sukses di Hapus');
        } catch (\Throwable $th) {
            return back()->with('message', 'Kesalahan saat mengapus kategori, coba beberapa saat lagi.');
        }
    }
}
