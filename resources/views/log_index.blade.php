@extends('elaadmin')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Log Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li><a href="#">Log</a></li>
                            <li class="active">Data Log</li>
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
                    
                    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Activity</ th>
                                    <th>Tanggal & Waktu</th>
                                </tr>
                            </thead>
                            <tbody>

                               
                             
                                    @foreach($logM as $data)
                                    <tr>
                                        <td>{{ $data->user->username}}</td>
                                        <td>{{ $data->user->role}}</td>
                                        <td>{{ $data->activity }}</td>
                                        <td>{{ $data->created_at }}</td>
                                    </tr>
                                    @endforeach
                              
                                <!-- Data Users -->
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


{{-- script JsQuery mYTable --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<!-- Setelah script CDN, baru panggil DataTable() -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
@endsection