@extends('admin_master')
@section('content')
 
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Tips</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">All Tips</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Tips</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <a href="{{route('tips.create')}}" class="btn btn-primary add-new">Add New</a><br><br>
              	
               <div class="card">
                  <div class="card-body">
                     <div class="row">
                       <div class="col-md-4">
                       	 <div class="form-group">
		                   	 <label for="category_type">Select Category</label>
		                     <select name="category_type" class="form-control select2bs4" id="category_type" required="">
			                 		<option value="" selected="" disabled="">Select category type</option>

			                 		<option value="Free">Free</option>

			                 		<option value="VIP">VIP</option>
			                 		
			                 	</select>
		                   </div>
                       </div>

                       <div class="col-md-4">
                       	 <div class="form-group">
	                   	 <label for="category_id">Select Category</label>
	                     <select name="category_id" class="form-control select2bs4" id="category_id" required="">
		                 		<option value="" selected="" disabled="">Select category</option>
		                 		@foreach(allCategory() as $category)
		                 		 <option value="{{$category->id}}">{{$category->category_name}}</option>
		                 		@endforeach
		                 	</select>
	                   </div>
                       </div>


                       <div class="col-md-4">
                       	 <div class="form-group">
                          <label for="filter-section"><strong>Filter by Today & This Month</strong></label>
                          <select id="filter-section" class="form-control select2bs4">
                              <option value="" disabled="" selected="">Choose Option</option>
                              <option value="today">Today</option>
                              <option value="this_month">This Month</option>
                          </select>
                        </div>
                       </div>


                     </div>
                     <div class="form-group">
                       <button type="button" class="btn btn-primary btn-block filter-tips"><i class="fa fa-search"></i> Search</button>
                     </div>
                  </div>
              </div>

              	<div class="fetch-data table-responsive">
              	  <table class="table table-bordered table-striped vendor-table data-table" style="width: 100%;">
                  <thead>
                    <tr>
                      <th>Tips Name</th>
                      <th>League Name</th>
                      <th>Category Type</th>
                      <th>Category</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody class="conts">
                  
                  </tbody>


              	</div>
                

              </div>
              
            </div>
    </section>
 </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script type="text/javascript">
  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        stateSave: true,
        ajax: {
          url: "{{ url('tips') }}",
          data: function (d) {
                d.category_type = $('#category_type').val(),
                d.category_id = $('#category_id').val(),
                d.search = $('.dataTables_filter input').val(),
                d.filter_section = $('#filter-section').val()
            }
        }, 

        columns: [
            {data: 'tips_name', name: 'tips_name'},
            {data: 'league_name', name: 'league_name'},
            {data: 'category_type', name: 'category_type'},

            {data: 'category_name', name: 'category_name'},

            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });


    $('.filter-tips').click(function(){

        table.draw(); 
    });

  });
</script>

@endsection