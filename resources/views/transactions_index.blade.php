
@extends('elaadmin')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-4">
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
                            <li><a href="{{url('products')}}">Transaction</a></li>
                            <li class="active">Data Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">

        <div class="animated fadeIn">
            <div class="row-md-1">
                <div class="col-sm-12">
                    <div class="card">

                        
                            
                        @if (Auth::user()->role == 'kasir')
                        <div class="card-header">
                            <a href="{{url('transactions/create')}}" class="btn btn-primary">Tambah Data + </a>
                           
                {{-- <a href="{{url('transactions/pdf2')}}" class="btn btn-info btn-icon-text">
                    <i class=" menu-icon mdi-printer btn-icon-prepend"></i>Unduh PDF
                </a> --}}
             
                        </div>

                        @endif
                        <div class="card-body">
                            <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap" id="myTable" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Transaksi</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Nama Produk</th>
                                        <th>Harga Produk</th>
                                        <th>Qty</th>
                                        <th>Total Harga</th>
                                        <th>Uang Bayar</th>
                                        <th>Uang Kembali</th>
                                        <th>Tanggal</th>
                                        @if (Auth::user()->role !== 'owner')
                                        <th>Aksi</th>
                                        @endif
                                    </tr>
                                    </thead>
                                    <tbody>
                            @foreach($transactionsM as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->nomor_unik }}</td>
                                <td>{{ $data->nama_pelanggan }}</td>
                                <td>{{ $data->nama_produk }}</td>
                                <td>{{ $data->harga_produk }}</td>
                                <td>{{ $data->qty }}</td>
                                <td>Rp.{{ number_format($data->total_harga, 0, ',', '.') }}</td>
                                <td>Rp.{{ number_format($data->uang_bayar, 0, ',', '.') }}</td>
                                <td>Rp.{{ number_format($data->uang_kembali, 0, ',', '.') }}</td>
                                
                              
                                <td>{{ $data->tanggal_trans}}</td>

                              <td>
                                @if (Auth::user()->role == 'kasir')
                                <a href="{{route('transactions.struk',['id' =>$data->id_trans])}}"class="btn btn-outline-primary"><i class="menu icon fa fa-print"></i></a>
                               
                                @endif
                                @if (Auth::user()->role == 'admin')
                                <a href="{{ route('transactions.edit', ['id' => $data->id_trans]) }}" class="btn btn-outline-warning"><i class="menu icon fa fa-edit"></i></a>
                                <!-- Button untuk memunculkan modal konfirmasi -->
                                <a href="{{ route('users.destroy', $data->id) }}"
                                    class="btn btn-danger"
                                    onclick="event.preventDefault();
                                                if (confirm('Apakah anda yakin ingin menghapus?')) {
                                                    document.getElementById('delete-form-{{ $data->id }}').submit();
                                                }">
                                    <i class="menu-icon fa fa-trash"></i>
                                </a>
                                <form id="delete-form-{{ $data->id }}"
                                    action="{{ route('users.destroy', $data->id) }}" method="POST"
                                    style="display: none;">
                                    @method('DELETE')
                                    @csrf
                                </form>
                                  <!-- Modal konfirmasi -->
                                  <div class="modal fade" id="deleteTransactionsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Penghapusan</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                                 </div>
                             <div class="modal-body">
                                        Apakah Anda yakin ingin menghapus transaksi ini?
                                 </div>
                                     <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                             <form action="{{ route('transactions.delete', $data->id_trans) }}" method="POST" style="display: inline;">
                            
                                          @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Hapus</button>

                                            @endif
                            </td>
                        

                            </tr>
                        @endforeach
                                    </tbody>
                                </table>
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
