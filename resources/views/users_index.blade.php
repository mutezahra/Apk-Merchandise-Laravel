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
                     
                        <a href="{{url('users/create')}}" class="btn btn-primary">Tambah Data + </a>
                    </div>
                    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
                    <div class="card-body">
                        <table id="myTable" class="table table-striped table-bordered table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama</th>
                                    <th>Role</th>
                                  
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($usersM as $data)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{ $data->username }}</td>
                                    <td>{{ $data->nama }}</td>
                                    <td>{{ $data->role }}</td>
                                    <td>    
                                        <a href="{{ route('users.edit', $data->id) }}" class="btn btn-warning"><i class="menu-icon fa fa-edit"></i></a>
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
                                        <a href="{{ route('users.changepassword', $data->id)}}" 
                                            class="btn btn-primary"><i class=" menu icon fa fa-key"></i></a>
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
