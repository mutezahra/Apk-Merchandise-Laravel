@extends('elaadmin')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Users Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li><a href="#">Users</a></li>
                            <li class="active">Data Users</li>
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
                        <div class="card-body card-block">
                        
                            <form action="{{ route('transactions.update', $transactionsM->id) }}" method="POST">

                                @csrf
                                @method('PUT')
                              
                                <div class ="form-group">
                                    <label>Nomor Unik</label>
                                    <input name="nomor_unik" type="number" class="form-control" placeholder="..."
                                    value="{{ $transactionsM->nomor_unik }}" readonly>
                                    @error('nomor_unik')
                                     <p>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class ="form-group">
                                    <label>Nama Pelanggan</label>
                                    <input name="nama_pelanggan" type="text" class="form-control" placeholder="..."
                                    value="{{ $transactionsM->nama_pelanggan }}">
                                    @error('nama_pelanggan')
                                     <p>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class ="form-group">
                                    <label>Nama Produk + Harga</label>
                                    <select name="id_produk" class="form-control" required>
                                        <option value="">- Pilih Produk -</option>
                                        @foreach ($products as $data)
                                        <?php
                                        if ($data->id == $transactionsM->id_produk):
                                             $selected = "selected";
                                        else :
                                             $selected = "";
                                        endif;
                                        ?>
                                        <option {{ $selected }} value="{{ $data->id}}">
                                            {{ $data->nama_produk }} - {{ $data->harga_produk }} {{ $data->stok }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('id_produk')
                                     <p>{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="qty">Quantity</label>
                                    <input name="qty" type="number" class="form-control" placeholder="..." value="{{$transactionsM->qty}}">
                                    @error('qty')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                         
                                <div class ="form-group">
                                    <label>Uang Bayar</label>
                                    <input name="uang_bayar" type="number" class="form-control" placeholder="..."
                                    value="{{ $transactionsM->uang_bayar }}">
                                    @error('uang_bayar')
                                     <p>{{ $message }}</p>
                                    @enderror
                                </div>

                             
                          <br>
                          <input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan"/>
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



















