@extends('layouts.master')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Products</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                {{-- content tabel --}}
                <div class="col-12">
                    @if ($message = Session::get('pesan'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Edit Product</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('products-update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $product->id }}">

                          <div class="card-body">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="nama_produk" placeholder="Enter Name" value="{{ $product->nama_produk }}">
                                <span class="text-danger">{{ $errors->first('nama_produk') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="name" name="harga" placeholder="Enter Price" value="{{ $product->harga }}">
                                <span class="text-danger">{{ $errors->first('harga') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" style="height: 45px" class="form-control" id="gambar" name="gambar" placeholder="Input Images" >
                                <img src="{{ asset('storage/'.$product->gambar) }}" width="300px">
                                <span class="text-danger">{{ $errors->first('gambar') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Kategori</label>
                                <select name="kategori_id" id="jk" class="form-control">
                                <span class="text-danger">{{ $errors->first('kategori_id') }}</span>    
                                  <option value="">--Pilih Kategori--</option>
                                  @foreach ($categories as $ct)
                                      <option value="{{ $ct->id }}" @if($product->kategori_id == $ct->id) {{ 'selected' }} @endif>{{ $ct->nama_kategori }}</option>
                                  @endforeach
                                </select>
                            </div>
          
                          <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </form>
                      </div>
                </div>
            </div>
        </div>
    </section>

@endsection