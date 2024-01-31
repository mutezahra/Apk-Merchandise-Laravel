@extends('elaadmin')
@section('content')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Kategori Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li><a href="#">Kategori</a></li>
                            <li class="active">Data Kategori</li>
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
                        <a href="{{url('kategori/create')}}" class="btn btn-primary">Tambah Data + </a>
                    </div>
                    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Kategori</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($kategoriM as $ktg)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $ktg->kategori }}</td>
                                    <td>{{ $ktg->keterangan }}</td>
                
                                    <td>    
                                        <a href="{{ route('kategori.edit', $ktg->id) }}" class="btn btn-warning"><i class="menu-icon fa fa-edit"></i></a>
                                        <a href="{{ route('kategori.destroy', $ktg->id) }}"
                                            class="btn btn-danger"
                                            onclick="event.preventDefault();
                                                        if (confirm('Apakah anda yakin ingin menghapus?')) {
                                                            document.getElementById('delete-form-{{ $ktg->id }}').submit();
                                                        }">
                                            <i class="menu-icon fa fa-trash"></i>
                                        </a>
                                        <form id="delete-form-{{ $ktg->id }}"
                                            action="{{ route('kategori.destroy', $ktg->id) }}" method="POST"
                                            style="display: none;">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                       
                                    </td>
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


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>

@endsection
