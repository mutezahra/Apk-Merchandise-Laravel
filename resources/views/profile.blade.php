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
                     
                  
                        <a href="{{url('dashboard')}}"><i class="fa fa-arrow-left"></i></a>
                   
                    </div>
                  
                    <div class="card-body">
                        <div class="card-body card-block">
                        
                           
                            <form>
                               
                              
                          <div class="form-group">
                              <label> Username</label>
                              <input name="username" type="text"
                              class="form-control border" placeholder="..." value="{{Auth::user()->username}}" readonly>
                              @error ('username')
                              <p>{{$message}}</p>
                              @enderror
                          </div>
                          <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input name="nama" type="text"
                            class="form-control border" placeholder="..." value="{{Auth::user()->nama}}" readonly>
                            @error ('nama')
                            <p>{{$message}}</p>
                            @enderror
                          </div>
                         
                          <div class="form-group">
                            <label>Role</label>
                            <input name="role" type="text"
                            class="form-control border" placeholder="..." value="{{Auth::user()->role}}" readonly>
                            @error ('role')
                            <p>{{$message}}</p>
                            @enderror
                          </div>
                         


                       

                          <br>
                      
                          <a href="{{ route('profile.edit', Auth::user()->id) }}" class="btn btn-warning"><i class="menu-icon fa fa-edit"></i></a>
                          
                         {{-- <a href="{{ route('profile.changepassword', Auth::user()->id) }}" class="btn btn-primary"><i class="menu-icon fa fa-key"></i></a>
                         
                          --}}
          
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



















