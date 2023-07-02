$(document).ready(function(){

  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
   });

  $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

   
    var getUrl = window.location;
  var base_url = localStorage.getItem('base_url');

    
     
     var currentURL = window.location.pathname;

     var ajax_url = '';





  $(document).on('click', '.delete-tip', function(e){
     e.preventDefault();
     var tip_id = $(this).data('id');
     if(confirm('Do you want to delete this?'))
       {
          ajax_url = base_url+"/tips/"+tip_id;
            $.ajax({

                 url: ajax_url,
                 type:"DELETE",
                 dataType:"json",
                 success:function(data) {
                    toastr.success(data);

                     $('.data-table').DataTable().ajax.reload(null, false);
     
                 },
                        
            });
       }
  });


  $(document).on('click', '.delete-category', function(e){
       e.preventDefault();
       var category_id = $(this).data('id');
       if(confirm('Do you want to delete this?'))
       {
          ajax_url = base_url+"/categories/"+category_id;
            $.ajax({

                 url: ajax_url,
                 type:"DELETE",
                 dataType:"json",
                 success:function(data) {
                    toastr.success(data);

                     $('.data-table').DataTable().ajax.reload(null, false);
     
                 },
                        
            });
       }
  });
 

 $(document).on('change', '#category_type', function(){
     var categoryType = $(this).val();
      $('#category_id').html('');
     ajax_url = base_url+"/get-category";

      $.ajax({

           url: ajax_url,
           type:"GET",
           data:{'category_type': categoryType},
           dataType:"html",
           success:function(data) {
              $('#category_id').html(data);

           },
                  
      });
 });


 $(document).on('change', '#category_id', function(){
      var int_category_id = $(this).val();
      ajax_url = base_url+"/get-categorytype";

      $.ajax({

           url: ajax_url,
           type:"GET",
           data:{'category_id': int_category_id},
           dataType:"json",
           success:function(data) {
              $('.category_type').val(data.category_type);

           },
                  
      });
 });

$('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });



});




function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('.preview-image')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);

              $('.preview-image-update')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);

          };
          reader.readAsDataURL(input.files[0]); 
      }
   }

   function readURL1(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('.preview-image-two')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);


                  $('.preview-image-two-update')
                  .attr('src', e.target.result)
                  .width(80)
                  .height(80);
          };
          reader.readAsDataURL(input.files[0]); 
      }
   }
