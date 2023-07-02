@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Account Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Account Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content"> 
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Account Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{URL::to('settings-account')}}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Name" value="{{ old('name', Auth::user()->name) }}">
                     @error('name')
		            <span class="alert alert-danger">{{ $message }}</span>
                   @enderror
                  </div>
                 

                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Email" value="{{ old('email', Auth::user()->email) }}">
                     @error('email')
		            <span class="alert alert-danger">{{ $message }}</span>
                   @enderror
                  </div>



                  <div class="row">
                  	<div class="col-md-9">
                  	  <div class="form-group">
                  	  	<label for="image">Image</label>
                  	  	 <input type="file" name="image" class="form-control"  accept="image/*"  id="image" onchange="readURL1(this);">
                  	  </div>
                  	</div> 
                    @if(Auth::user()->image == NULL)
                      <div class="col-md-3">
                  	  <img src="" class="preview-image-two">
                  	</div>
                    @else
                  	<div class="col-md-3">
                  	  <img src="{{URL::to(Auth::user()->image)}}" class="preview-image-two-update">
                  	</div>
                  	@endif
                  </div>

                  
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </form>
            </div>
    </section>
 </div>
@endsection