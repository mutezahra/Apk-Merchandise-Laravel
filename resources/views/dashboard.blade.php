@extends('elaadmin')
@section('content')

<!-- Content -->
<div class="content">
    <!-- Animated -->
    <div class="animated fadeIn">
        <!-- Widgets  -->
        <div class="card shadow mb-6" style="background-color: #08CCCA; border-radius: 15px;">
            <div class="card-body" style="padding: 20px; text-align: left;">
                <h1 style="color: azure; font-family: 'Arial', sans-serif;">Hi!, {{ Auth::user()->nama }} [{{ Auth::user()->role }}] </h1>
                <p style="color: white; font-family: 'Arial', sans-serif;">Semoga harimu cerah!</p>
            </div>
        </div>

        @if (Auth::user()->role == 'admin' || Auth::user()->role == 'owner')
            <div class="row">
                <div class="col-lg-4 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-1">
                                    <i class="pe-7s-cash"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text">Rp.<span class="count">{{ $totalharga }}</span></div>

                                        <div class="stat-heading">Total Pendapatan</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-3">
                                    <i class="pe-7s-cart"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{ $productsCount }}</span></div>
                                        <div class="stat-heading ">Jumlah Produk</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="stat-widget-five">
                                <div class="stat-icon dib flat-color-4">
                                    <i class="pe-7s-users"></i>
                                </div>
                                <div class="stat-content">
                                    <div class="text-left dib">
                                        <div class="stat-text"><span class="count">{{$userCount}}</span></div>
                                        <div class="stat-heading">Users</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if (Auth::user()->role == 'kasir')
            <!-- Tampilkan konten khusus untuk kasir -->
           
        @endif

        <div class="kotak" style="height: 265px"></div>
    </div>
</div>

<!-- /.content -->

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- Your footer content goes here -->
            </div>
        </div>
    </div>
</footer>

@endsection
