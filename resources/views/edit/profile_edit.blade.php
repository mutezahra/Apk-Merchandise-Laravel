@extends('elaadmin')
@section('content')

<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Profile Pages</h1>
                    </div>
                </div>
            </div>

            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="{{url('dashboard')}}">Dashboard</a></li>
                            <li><a href="#">Profile</a></li>
                          
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
                     
                  
                        <a href="{{url('profile')}}"><i class="fa fa-arrow-left"></i></a>
                   
                    </div>
                  
                    <div class="card-body">
                        <div class="card-body card-block">
                        
                           
                            <form action="{{route('profile.update', $users->id )}}" method="POST">
                                @csrf
                                @method('PUT')
                              
                          <div class="form-group">
                              <label> Username</label>
                              <input name="username" type="text"
                              class="form-control border" placeholder="..." value="{{ $users->username}}">
                              @error ('username')
                              <p>{{$message}}</p>
                              @enderror
                          </div>
                          <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input name="nama" type="text"
                            class="form-control border" placeholder="..." value="{{ $users->nama}}">
                            @error ('nama')
                            <p>{{$message}}</p>
                            @enderror
                          </div>

                         <!-- Add this in your form -->
                        <div class="form-group">
                          <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" {{ isset($readonlyRole) && $readonlyRole ? 'disabled' : '' }}>
                             <option value="">- Pilih Role -</option>
                                <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
                              <option value="kasir" {{ $users->role == 'kasir' ? 'selected' : '' }}>Kasir</option>
                                <option value="owner" {{ $users->role == 'owner' ? 'selected' : '' }}>Owner</option>
                            </select>
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



















