@extends('elaadmin')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Edit Products Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li><a href="{{url('products')}}">Products</a></li>
                            <li class="active">Edit Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{url('users')}}"><i class="fa fa-arrow-left"></i></a>
                   
                             </div>

                     <div class="card-body">
                     <div class="card-body card-block"></div>

                     <form method="POST" action="{{ route('products.update' , $products->id) }}"
                        enctype="multipart/form-data">

                        @csrf
                        @method('PUT')
    <div class="form-group">
        <label for="foto">Foto</label>
        <br>
        <input type="file" id="foto" class="form-control-file" name="foto" accept=".png, .jpg, .jpeg" onchange="previewImage(this);" value="{{$products->foto_produk}}">

        <br>
        <img id="foto-preview" src="{{ asset('uploads/' . $products->foto_produk) }}" alt="Pratinjau Foto" style="max-width: 200px; max-height: 200px;">


    </div>
    <div class="form-group">
        <label>Nama Produk</label>
        <input name="nama_produk" type="text" class="form-control border" placeholder=" ..." value="{{$products->nama_produk}}">
        @error('nama_produk')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label>Harga Produk</label>
        <input name="harga_produk" type="number" class="form-control border" placeholder=" ..." value="{{$products->harga_produk}}">
        @error('harga_produk')
            <p>{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
      <label>Stok</label>
      <input name="stok" type="number" class="form-control border" placeholder="..." value="{{$products->stok}}">
      @error('stok')
      <p>{{ $message }}</p>
      @enderror
  </div>
  <div class ="form-group">
    <label>Kategori</label>
    <select name="id_kategori" class="form-control" required>
        <option value="">- Pilih Kategori -</option>
        @foreach ($kategoriM as $ktg)
        <?php
            $selected = ($ktg->id == $products->id_kategori) ? "selected" : "";
        ?>
        <option {{ $selected }} value="{{ $ktg->id }}">
            {{ $ktg->kategori }} 
        </option>
    @endforeach
    </select>
    @error('id_kategori')
        <p>{{ $message }}</p>
    @enderror
</div>

    <div class="row form-group">
        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label">Deskripsi</label></div>
        <div class="col-8 col-md-8">
            <textarea name="dproduk" id="dproduk" rows="4" placeholder="Masukkan Deskripsi..." class="form-control">{{$products->dproduk}}</textarea>
            @error('dproduk')
            <p>{{ $message }}</p>
        @enderror</div>
    </div>
    <div class="form-group">
        <label>Tanggal Masuk</label>
        <input name="tanggal_masuk" type="date" class="form-control border" placeholder="..." value="{{$products->tanggal_masuk}}" readonly>
        @error('tanggal_masuk')
        <p>{{ $message }}</p>
        @enderror
    </div>
    <br>
    <input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container-fluid">
  
        <div class="row">
            <div class="col-md-6">
                <!-- Your footer content goes here -->
            </div>
        </div>
      
    </div>
</footer>

<script type="text/javascript">
    function previewImage(input) {
        var fotoPreview = document.getElementById('foto-preview');

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                fotoPreview.src = e.target.result;
                fotoPreview.style.display = 'block';
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>



@endsection