


@extends('elaadmin')

@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-4">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Laporan Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li class="active">Data Laporan</li>
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
                    <div class="card-body">
                        <form action="{{ route('laporan.filter' , ['startDate' => '2024-01-01', 'endDate' => '2024-12-31']) }}" method="GET" >
                            <div class="form-row">
                                <div class="form-group col-md-5">
                                    <label for="startDate">Tanggal Awal:</label>
                                    <input type="date" name="startDate" id="startDate" class="form-control">
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="endDate">sampai</label>
                                    <input type="date" name="endDate" id="endDate" class="form-control">
                                </div>
                                <div class="form-group col-md-4">
                                    <button type="submit" class="btn btn-primary">Cari Data</button>
                                    <button type="button" class="btn btn-info btn-close" onclick="cancelFilter()">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                                <div class="d-flex justify-content-between align-items-center col-md-4">
                                   
                                    @if(request()->has('startDate') && request()->has('endDate'))
                                        <a href="{{ route('laporan.export', ['startDate' => request('startDate'), 'endDate' => request('endDate')]) }}" class="btn btn-secondary">Export PDF</a>
                                    @else
                                  
                                        <a href="{{ route('laporan.export') }}" class="btn btn-secondary">Export PDF</a>
                                    @endif
                                
                                  
                                </div>
                            
                                
                    <div class="content">
                          
                    <div class="laporan-table">
                        <div class="table-responsive">
                            <h5 class="card-title text-center" style="font-size: 24px; color: #000000">Hasil Filter </h5>
                            <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
                            @if(($transactionsM)->count() > 0)
                            <table class="table table-bordered text-nowrap" id="myTable" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Kode Transaksi</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Nama Produk</th>
                                            <th>Harga Produk</th>
                                            <th>Qty</th>
                                            <th>Total Harga</th>
                                            <th>Uang Bayar</th>
                                            <th>Uang Kembali</th>
                                            <th>Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transactionsM as $data)
                                            <tr>
                                                <td>{{ $data->nomor_unik}}</td>
                                                <td>{{ $data->nama_pelanggan }}</td>
                                                <td>{{ $data->products->nama_produk }}</td>
                                                <td>{{ $data->products->harga_produk }}</td>
                                                <td>{{ $data->qty }}</td>
                                                <td>{{ $data->total_harga }}</td>
                                                <td>{{ $data->uang_bayar }}</td>
                                                <td>{{ $data->uang_kembali }}</td>
                                                <td>{{ $data->created_at }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                
                                  <tfoot>
                                    <tr>
                                        <th colspan="5">Total</th>
                                        <th id="total-harga"></th>
                                        <th colspan="3"></th> <!-- colspan="3" to align with the columns in the thead -->
                                    </tr>
                                </tfoot>
                                

                            @else
                                <p class="mt-3">Tidak ada data yang sesuai dengan filter.</p>
                            @endif
                            </table>
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

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });

 
  
</script>

<script>

function cancelFilter() {
        // Clear the input fields
        document.getElementById('startDate').value = '';
        document.getElementById('endDate').value = '';

        // Redirect to the laporan index page
        window.location.href = "{{ route('laporan.index') }}";
    }
</script>

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();

        // Calculate and display the total sum
        var totalHarga = 0;
        $('tbody tr').each(function () {
            var harga = parseFloat($(this).find('td:eq(5)').text().replace(',', '')) || 0; // Assuming 'total_harga' is in the 6th column
            totalHarga += harga;
        });
        $('#total-harga').text(totalHarga.toFixed(2));
    });
</script>

