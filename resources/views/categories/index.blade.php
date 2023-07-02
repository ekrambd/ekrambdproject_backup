@extends('admin_master')
@section('content')
 
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">All Category</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{URL::to('/dashboard')}}">Dashboard</a></li>
              <li class="breadcrumb-item active">All Category</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
    	<div class="card">
              <div class="card-header">
                <h3 class="card-title">All Category</h3>

              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <a href="{{route('categories.create')}}" class="btn btn-primary add-new">Add New</a><br><br>
              	
               <div class="card">
                  <div class="card-body">
                      <div class="form-group">
                          <label for="filter-categoryType"><strong>Filter by Category Type :</strong></label>
                          <select id="filter-categoryType" class="form-control select2bs4">
                              <option value="" disabled="" selected="">Select Category Type</option>
                              <option value="Free">Free</option>
                              <option value="VIP">VIP</option>
                          </select>
                      </div>
                  </div>
              </div>

              	<div class="fetch-data table-responsive">
              	  <table class="table table-bordered table-striped vendor-table data-table" style="width: 100%;" id="category-table">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Category Type</th>
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

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>


<script type="text/javascript">
  $(function () {

    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        stateSave: true,
        ajax: {
          url: "{{ url('categories') }}",
        
         data: function (d) {
                d.category_type = $('#filter-categoryType').val(),
                d.search = $('.dataTables_filter input').val()
            }
        },

        columns: [
            {data: 'category_name', name: 'category_name'},
            {data: 'category_type', name: 'category_type'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]


    });




  $('#filter-categoryType').change(function(){

        table.draw();
    });

  $( "#category-table" ).sortable({
          items: "tr",
          cursor: 'move',
          opacity: 0.6,
          update: function() {
              sendOrderToServer();
          }
        });

     function sendOrderToServer() {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
        //   by this function User can Update hisOrders or Move to top or under
          $('tr.row1').each(function(index,element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
          });
// the Ajax Post update 
          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "{{ url('custom-sortable') }}",
                data: {
              order: order,
              _token: token
            },
            success: function(data) {
            }
          });
        }

  });
</script>

@endsection