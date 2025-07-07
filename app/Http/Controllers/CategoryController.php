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
            // Tambahkan default type untuk new category
            $category = (object) ['id' => null, 'name' => null, 'type' => null, 'description' => null];
            return view('admin.categories.categoryForm', compact('category'));
        }
    }

    public function category_add(Request $request){
        $valid = $request->validate([
            'name' => 'required|string|max:150',
            'type' => 'required|in:pengaduan,aspirasi',
            'description' => 'nullable|string',
        ]);

        try {
            if ($request->filled('id')) {
                // Update
                Category::where('id', $request->id)->update($valid);
                return redirect()->route('category.list')->with('message', 'Kategori berhasil diperbarui.');
            } else {
                // Create
                Category::create($valid);
                return redirect()->route('category.list')->with('message', 'Kategori berhasil ditambahkan.');
            }
        } catch (\Throwable $th) {
            return back()->with('error', 'Terjadi kesalahan saat menyimpan kategori.')->withInput();
        }
    }

    public function category_delete($id){
        try {
            Category::where('id', $id)->delete();
            return back()->with('message', 'Kategori berhasil dihapus.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Gagal menghapus kategori.');
        }
    }
}
