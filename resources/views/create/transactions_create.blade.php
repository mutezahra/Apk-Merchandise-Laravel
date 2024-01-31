@extends('elaadmin')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Transactions Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li><a href="#">Transactions</a></li>
                            <li class="active">Data Transactions</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><div class="content">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                     
                  
                        <a href="{{url('users')}}"><i class="fa fa-arrow-left"></i></a>
                   
                    </div>
                  
                    <div class="card-body">
                        <div class="card-body card-block">
                            <form action ="{{ route('transactions.store') }}"  method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nomor Unik</label>
                                    <input name="nomor_unik" type="text" class="form-control" placeholder="..." value="{{ random_int(1000000000, 9999999999) }}" readonly>
                                    @error('nomor_unik')
                                    <p>{{ $message }}</p>
                                    @enderror
                                </div>
                            
                               
                                <div class="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input name="nama_pelanggan" type="text" class="form-control" placeholder="..." >
                                    @error('nama_pelanggan')
                                    <p>{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <div class="form-group">
                                    <label>Pilih Produk</label>
                                    <div class="input-group">
                                        <select class="form-control" id="produk" name="id_produk" required>
                                            <option value="">Pilih Produk</option>
                                            @foreach ($products as $data)
                                                <option value="{{ $data->id }}">{{ $data->nama_produk }} - {{ $data->harga_produk }} , {{ $data->stok }}</option>
                                            @endforeach
                                            @error('id_produk')
                                            <p>{{ $message }}</p>
                                           @enderror
                                        </select>
                                        {{-- <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-primary m-1" onclick="addSelectedProduct()"><i class="ti ti-plus"></i></button>
                                        </div> --}}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="qty">Quantity</label>
                                    <input name="qty" type="number" class="form-control" placeholder="..." required>
                                    @error('qty')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                                
                            
                              
                            
                                <div class="form-group mt-3">
                                    <label>Uang Bayar</label>
                                    <input name="uang_bayar" type="text" class="form-control" placeholder="...">
                                    @error('uang_bayar')
                                    <p>{{ $message }}</p>
                                    @enderror
                                </div>
                        
                           
                            <br>
                            <input type="submit" name="submit" class="btn btn-primary" value="Simpan Data"/>
                            </form>
                           
                        </div>

                      
                    </div>
                </div>
            </div>
        </div>
    </div><!-- .animated -->
</div><!-- .content -->

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