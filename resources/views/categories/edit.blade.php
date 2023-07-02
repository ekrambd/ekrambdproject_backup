@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Category</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('categories.update',$category->id)}}" method="POST" enctype="multipart/form-data">
              	@csrf
              	@method('PATCH')
                <div class="card-body">
                  <input type="hidden" name="order_no" value="{{$category->order_no}}"> 
                 <div class="form-group">
                   <label for="category_name">Category Name</label>
                   <input type="text" name="category_name" class="form-control" placeholder="Category Name" value="{{old('category_name',$category->category_name)}}" required="">
                   @error('category_name')
		                 <span class="alert alert-danger">{{ $message }}</span>
                   @enderror
                 </div>

                 <div class="form-group">
                 	<label for="category_type">Select Category Type</label>
                 	<select name="category_type" class="form-control select2bs4" id="category_type">
                 		<option value="" selected="" disabled="">Select category type</option>
                 		<option value="Free" <?php if($category->category_type == 'Free'){echo "selected";} ?>>Free</option>
                 		<option value="VIP" <?php if($category->category_type == 'VIP'){echo "selected";} ?>>VIP</option>
                 	</select>
                   @error('category_type')
		                 <span class="alert alert-danger">{{ $message }}</span>
                   @enderror
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