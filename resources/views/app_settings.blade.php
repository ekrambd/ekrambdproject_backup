@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">App Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">App Settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">App Settings</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{URL::to('settings-app')}}" method="POST" enctype="multipart/form-data">
              	@csrf
                <div class="card-body">
                  <div class="form-group">
                    <label for="app_name">Application Name</label>
                    <input type="text" name="app_name" class="form-control" id="app_name" placeholder="Application Name" value="{{ old('app_name', setting()->app_name) }}">
                     @error('app_name')
		            <span class="alert alert-danger">{{ $message }}</span>
                   @enderror
                  </div>
                 

                  <div class="row">
                  	<div class="col-md-9">
                  	  <div class="form-group">
                  	  	<label for="app_logo">App logo</label>
                  	  	 <input type="file" name="app_logo" class="form-control"  accept="image/*"  id="app_logo" onchange="readURL1(this);">
                  	  </div>
                  	</div> 
                    @if(setting()->app_logo == NULL)
                      <div class="col-md-3">
                  	  <img src="" class="preview-image-two">
                  	</div>
                    @else
                  	<div class="col-md-3">
                  	  <img src="{{URL::to(setting()->app_logo)}}" class="preview-image-two-update">
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