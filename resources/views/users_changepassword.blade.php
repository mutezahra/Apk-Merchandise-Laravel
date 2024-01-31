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
                        <div class="card-body">
                           
                          
                            <form action="{{route('users.change', $users->id )}}" method="POST">
                            @csrf
                            @method('PUT')
                      <div class="form-group">
                          <label> Username</label>
                          <input name="username" type="text"
                          class="form-control border" placeholder="..." value="{{ $users->username}}" readonly >
                          @error ('username')
                          <p>{{$message}}</p>
                          @enderror
                      </div>
                  
                      <div class="form-group">
                          <label>Password Baru</label>
                          <input name="password_new" type="password" class="form-control border" placeholder="...">
                          @error('password_new')
                          <p>{{ $message }}</p>
                          @enderror
                      </div>
                      <div class="form-group">
                          <label>Ulangi Password Baru</label>
                          <input name="password_confirm" type="password" class="form-control border" placeholder="...">
                          @error('password_confirm')
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
