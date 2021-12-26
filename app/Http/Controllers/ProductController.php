<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Exception;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index() {
        $products = Product::orderBy('nama_produk','ASC')->get();

        return view('backend.product.index', compact('products'));
    }

    //menampilkan data category
    public function listCategory() {
        $data = Category::orderBy('nama_kategori','ASC')->get();
        return $data;
    }

    public function create() {
        //ambil data category untuk diinputkan ke tabel product
        $categories = $this->listCategory();
        return view('backend.product.add', compact('categories'));
    }

    public function store(Request $request) {
        //validasi sebelum insert ke table
        $request->validate([
            'nama_produk' => 'required|min:3',
            'harga' => 'required',
            'gambar' => 'required|image|file|max:2048',
            'kategori_id' => 'required'
        ]);

        try {
            $pathGambar = $request->file('gambar')->store('product-images');

            //insert data to products table
            Product::create([
                'nama_produk' => $request->nama_produk,
                'harga' => $request->harga,
                'gambar' => $pathGambar,
                'kategori_id' => $request->kategori_id,
            ]);

            return redirect('products')->with(['pesan' =>'Data Berhasil disimpan!']);

        } catch (Exception $err) {
            return redirect()->back()->with(['pesan' => $err->getMessage()]);
        }

        $pathGambar = $request->file('gambar')->store('product-images');
    }

    public function edit($id) {
        $categories = $this->listCategory();

        $product = Product::find($id);

        return view('backend.product.edit', compact('categories','product'));
    }

    public function update(Request $request) {

        // ddd($request->all());
        $request->validate([
            'nama_produk' => 'required|min:3',
            'harga' => 'required',
            'gambar' => 'image|file|max:2048',
            'kategori_id' => 'required'
        ]);

        try {
            //ambil data produk berdasarkan id yg dipilih
            $product = Product::find($request->id);

            //mengecek apakah ada gambar yg sudah diupload
            if($request->file('gambar')) {
                //cek gambar lama
                if($product->gambar){
                    Storage::delete($product->gambar);
                    $pathGambar = $request->file('gambar')->store('product-images');
                }
            } else { 
                $pathGambar = $product->gambar;
            }

            //update data di tabel produk (db)
            Product::where('id', $request->id)->update([
                'nama_produk' => $request->name_produk,
                'harga' => $request->harga,
                'gambar' => $pathGambar,
                'kategori_id' => $request->kategori_id
            ]);

            return redirect('products')->with(['pesan' =>'Data Berhasil disimpan!']);

        } catch (Exception $err) {
            return redirect()->back()->with(['pesan' => $err->getMessage()]);
        }
    }

    public function delete($id) {
        $product = Product::find($id);

        if($product->gambar) {
            Storage::delete($product->gambar);
        }

        Product::destroy($id);

        return redirect('products')->with([
            'pesan' => 'Data Berhasil Disimpan',
        ]);
    }
}
