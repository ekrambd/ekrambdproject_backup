@extends('admin_master')
@section('content')
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Edit Tips</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">Edit Tips</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Tips</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="{{route('tips.update',$tip->id)}}" method="POST" enctype="multipart/form-data">
              	@csrf
              	@method('PATCH')
                <div class="card-body">
                  
                 <div class="row">
                  
                  <input type="hidden" name="category_type" class="category_type" value="{{$tip->category_type}}">


                  <div class="col-md-12">
                     <div class="form-group">
                      <label for="message_box">Message Box</label>
                     <input type="text" name="message_box" class="form-control" id="message_box" placeholder="Message Box"  value="{{$tip->message_box}}">
                     </div>
                   </div>


                   <div class="col-md-12">
                    <div class="form-group">
                       <label for="category_id">Select Category</label>
                       <select name="category_id" class="form-control select2bs4" id="category_id" required="">
                        <option value="" selected="" disabled="">Select category</option>

                         @foreach(allCategory() as $category)

                          <option value="{{$category->id}}" <?php if($tip->category_id == $category->id){echo "selected";} ?>>{{$category->category_name}}</option>

                         @endforeach
                        
                      </select>
                     </div>
                   </div>

                   <div class="col-md-12">
                    <div class="form-group">
                      <label for="league_name">League Name</label>
                     <input type="text" name="league_name" class="form-control" id="league_name" placeholder="League Name" required="" value="{{$tip->league_name}}">
                    </div>
                     
                   </div>


                   <div class="col-md-12">
                    <div class="form-group">
                       <label for="teams">Team</label>
                      <input type="text" class="form-control" name="teams" id="teams" placeholder="Team" required="" value="{{$tip->teams}}">
                    </div>
                   </div>




                   <div class="col-md-12">
                   	  <div class="form-group">
                   	  	<label for="tips_name">Tips Name</label>
	                   	 <input type="text" name="tips_name" class="form-control" id="tips_name" placeholder="Tips Name" required="" value="{{$tip->tips_name}}">
                   	  </div>
                   </div>


                   <div class="col-md-12">
                   	 <div class="form-group">
                   	 	<label for="odds_value">Odds Value</label>
                   	 <input type="text" name="odds_value" class="form-control" id="odds_value" placeholder="Odds Value" value="{{$tip->odds_value}}" required="">
                   	 </div>
                   </div>

	                 <div class="col-md-6">
	                 	<div class="form-group">
	                 	   <label for="date">Date</label>
		                 	<input type="date" class="form-control" name="date" id="date" placeholder="Date" value="{{$tip->date}}">
	                 	</div>
	                 </div>
                   

                 </div>

                   <div class="form-group">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
                </div>
                <!-- /.card-body -->

               
              </form>
            </div>
    </section>
 </div>
@endsection