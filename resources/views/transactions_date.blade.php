@extends('elaadmin')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-4">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Pdf Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li><a href="{{url('transactions')}}">Transactions</a></li>
                            
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-center" style="font-size: 24px; color: #08CCCA;">CETAK DATA TRANSAKSI </h5>
            <br>
            
            <form action="{{ route('transactions.pertanggal', ['tgl_awal' => '2024-01-01', 'tgl_akhir' => '2024-12-31']) }}" method="GET">


              <div class="form-group">
                  <label>Tanggal Awal</label>
                  <input name="tgl_awal" type="date" class="form-control" style="border: 1px 
                  solid rgb(88, 88, 88);">
                  @error('tgl_awal')
                  <p>{{ $message }}</p>
                  @enderror
              </div>
              <div class="form-group">
                  <label>Tanggal Akhir</label>
                  <input name="tgl_akhir" type="date" class="form-control" style="border: 1px solid rgb(88, 88, 88);">
                  @error('tgl_akhir')
                  <p>{{ $message }}</p>
                  @enderror
              </div>
              {{-- <h6>*Tanggal Akhir Tidak Masuk Data</h6> --}}
              <div class="text-center">
                <button type="submit" class="btn btn-primary me-2" onclick="showSuccessPopup()">Submit</button>
                <a href="{{ route('transactions.index') }}" class="btn btn-outline-warning">Cancel</a>
            </div>
            </form>

        </div>
    </div>
    <script>
        function showSuccessPopup() {
            Swal.fire(
         'Sukses!',
         'Data berhasil ditampilkan!',
         'success'
     );
     // Pastikan tidak ada event.preventDefault() atau nilai yang menghentikan submit form.
     }
     </script>


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