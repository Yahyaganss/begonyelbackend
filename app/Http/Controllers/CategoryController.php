<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();
        // dd($categories);
        return view('backend.category.index',[
            'categories' => $categories,
        ]);
    }

    public function create() {
        return view('backend.category.add');  
    }

    //insert data to table
    public function store(Request $request) {
        //data yg akan diterima function store
        $name = $request->nama_kategori;

        //validasi sebelum insert ke table
        $request->validate([
            'nama_kategori' => 'required|min:3',
        ]);

        //buat objek untuk simpan data ke table
        $category = new Category;

        //kirim nilai" yg didapat dari form ke table
        $category->nama_kategori = $name;

        //simpan data yg telah diterima kedalam dable
        $category->save();

        //redirect ke halaman users
        return redirect('categories');   
    }

    public function edit($id) {
        $category = Category::find($id);
        // dd($user);

        //tampilkan form edit dan kirim datanya
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request) {
        //data yg akan diterima function store
        $id = $request->id;
        $name = $request->nama_kategori;

        //buat objek untuk simpan data ke table
        $category = Category::find($id);

        //kirim nilai" yg didapat dari form ke table
        $category->nama_kategori = $name;

        //simpan data yg telah diterima kedalam dable
        $category->update();

        //redirect ke halaman users
        return redirect('categories');   
    }

    public function delete($id) {
        $category = Category::find($id)->delete();

        return redirect('categories');
    }
}

