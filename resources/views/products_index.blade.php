@extends('elaadmin')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-4">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Products Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li><a href="{{url('products')}}">Produk</a></li>
                            <li class="active">Data Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <form action="{{ route('products.index')}}" method="get" class="d-flex">
        <input type="search" name="search" class="form-control shorter-input" placeholder="Cari Produk" value="{{ $vcari }}">
        <button type="submit" class="btn btn-primary"><i class="ti ti-search"></i></button>
        <a href="{{ url('products')}}" class="ml-2">
            <button type="button" class="btn btn-info"><i class="ti ti-reload"></i></button>
        </a>
        </form>
    <a href="{{url('products/create')}}" class="btn btn-primary mt-4 mb-4">Tambah Data + </a>
    <div class="animated fadeIn">
        <div class="row">
            @foreach($products as $p)
                <div class="col-md-4 mb-4">
                    <div class="card rounded shadow">
                        <img class="card-img-top" src="{{ asset('uploads/' . $p->foto_produk) }}" alt="{{ $p->nama_produk }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $p->nama_produk }}</h5>
                            <p class="card-text">{{ 'Rp ' . number_format($p->harga_produk, 0, ',', '.') }}</p>
                            <p class="card-text">Stok: {{ $p->stok }}</p>
                            <p class="card-text">Kategori: {{ $p->category->kategori }}</p>
                            <p class="card-text">{{ $p->dproduk }}</p>
                            <p class="card-text">Tanggal Masuk: {{ $p->tanggal_masuk }}</p>
                            <div class="btn-group" role="group" aria-label="Actions">
                                <a href="{{ route('products.edit', $p->id) }}" class="btn btn-warning"><i class="menu-icon fa fa-edit"></i></a>
                                <a href="{{ url('products/delete', $p->id) }}" class="btn btn-danger" onclick="event.preventDefault(); if (confirm('Apakah anda yakin ingin menghapus?')) { document.getElementById('delete-form-{{$p->id}}').submit(); }"><i class="menu-icon fa fa-trash"></i></a>
                                <form id="delete-form-{{$p->id}}" action="{{ url('products/delete', $p->id) }}" method="POST" style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="detailModal{{ $p->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-body">
                                <!-- Isi modal dengan detail produk -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <img src="{{ asset('assets/images/products/' . $p->foto) }}" class="img-fluid" alt="Product Image">
                                    </div>
                                    <div class="col-md-5">
                                        <h4 class="modal-title" id="exampleModalLabel">{{ $p->nama_produk }}</h4>
                                        <br>
                                        <p> {{ $p->jenis_buku }}</p>
                                        <p>Penulis : {{ $p->penulis }}</p>
                                        <p>Penerbit : {{ $p->penerbit }}</p>
                                        <p>Stok : {{ $p->stok }}</p>
                                        <p>{{ 'Rp ' . number_format($p->harga_produk, 0, ',', '.') }}</p>
                                        <!-- Tambahkan informasi lain sesuai kebutuhan -->
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
        
                                <button type="button" class="btn btn-outline-primary m-1" data-dismiss="modal">Tutup</button>
                                <!-- Tambahkan tombol atau fungsi lain sesuai kebutuhan -->
                            </div>
                        </div>
                    </div>
                </div>



            @endforeach
        </div><!-- .row -->
    </div><!-- .animated -->
</div><!-- .container -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <!-- Your footer content goes here -->
                    </div>
                </div>
              
            </div>
        </footer>
@endsection 
