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
                            <li><a href="{{url('kategori')}}">Kategori</a></li>
                            <li class="active">Edit Kategori</li>
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
                             <div class="card-body card-block"></div>

   <form action="{{route('kategori.update', $kategoriM->id )}}" method="POST">
          @csrf
            @method('PUT')
            <div class="form-group">
                <label>Nama Kategori</label>
                    <input name="kategori" type="text" class="form-control border" placeholder=" ..." value="{{$kategoriM->kategori}}">
                       @error('kategori')
                        <p>{{ $message }}</p>
                             @enderror
 </div>
 <div class="row form-group">
        <div class="col col-md-6"><label for="textarea-input" class=" form-control-label" >Keterangan</label></div>
           <div class="col-8 col-md-8"><textarea name="keterangan"  id="keterangan" rows="4" placeholder="Masukkan Keteranga..."  class="form-control">{{$kategoriM->keterangan}}</textarea>
            @error('keterangan')
            <p>{{ $message }}</p>
        @enderror</div>
    </div>
    <br>
    <input type="submit" name="submit" class="btn btn-primary" value="Simpan Perubahan"/>
                    </div>

                 
                </div>
            </div>
        </div>
    </div>
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
@endsection