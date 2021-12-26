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
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ $message }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="card card-primary">
                        <div class="card-header">
                          <h3 class="card-title">Add Category</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{ route('products-store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                          <div class="card-body">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk</label>
                                <input type="text" class="form-control" id="name" name="nama_produk" placeholder="Enter Name" value="{{ old('nama_produk') }}">
                                <span class="text-danger">{{ $errors->first('nama_produk') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga</label>
                                <input type="number" class="form-control" id="name" name="harga" placeholder="Enter Price" value="{{ old('harga') }}">
                                <span class="text-danger">{{ $errors->first('harga') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar</label>
                                <input type="file" style="height: 45px" class="form-control" id="gambar" name="gambar" placeholder="Input Images"  onchange="previewImage()">
                                <img class="img-preview img-fluid mb-3 mt-1 col-sm-5">
                                <span class="text-danger">{{ $errors->first('gambar') }}</span>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Kategori</label>
                                <select name="kategori_id" id="jk" class="form-control">
                                <span class="text-danger">{{ $errors->first('kategori_id') }}</span>    
                                  <option value="">--Pilih Kategori--</option>
                                  @foreach ($categories as $ct)
                                      <option value="{{ $ct->id }}">{{ $ct->nama_kategori }}</option>
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

    <script>
        function previewImage() {
            const image = document.querySelector('#gambar');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(previewImg) {
                imgPreview.src = previewImg.target.result;
            } 
        }
    </script>

@endsection