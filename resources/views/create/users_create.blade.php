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
                  
                    <div class="modal-body">
                    <div class="card-body">
                        <div class="card-body card-block">
                        
                           
                            <form action="{{route('users.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input name="nama" type="text" class="form-control border" placeholder=" ...">
                                    @error('nama')
                                    <p>{{ $message }}</p>
                                    @enderror
                                </div>
                                                   
                                <div class="form-group">
                                    <label>Username</label>
                                    <input name="username" type="text" class="form-control border" placeholder=" ..." >
                                    @error('username')
                                        <p>{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                  <label>Password</label>
                                  <input name="password" type="password" class="form-control border" placeholder="...">
                                  @error('password')
                                  <p>{{ $message }}</p>
                                  @enderror
                              </div>
                        
                                <div class="form-group">
                                    <label>Ulangi Password</label>
                                    <input name="password_confirm" type="password" class="form-control border" placeholder="...">
                                    @error('password_confirm')
                                    <p>{{ $message }}</p>
                                    @enderror
                                </div>
                        
                                <div class="form-group">
                                    <label>Role</label>
                                    <select name="role" class="form-control border">
                                        <option>-Pilih Role-</option>
                                        <option value="owner">Owner</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                    </select>    
                                    @error('role')
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
</div>

<footer class="footer">
    <div class="container-fluid">
  
        <div class="row">
            <div class="col-md-6">
                <!-- Your footer content goes here -->
            </div>
        </div>
      
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




@endsection





















{{-- 
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

<div class="content">
    <div class="animated fadeIn">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    
                   
            </div>
        </div>

    </div>

</div>




@endsection  --}}
