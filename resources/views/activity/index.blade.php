@extends('master')
@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<style type="text/css">

.error{
  color: red;
}
</style>
<section class="panel panel-primary">
<div class="panel-body">

<?php
//File
  if(!empty($_COOKIE['FileError'])) {     
    echo "<div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['FileError'];
    echo "</div>";
  } 
//ActivityErr 
  if(!empty($_COOKIE['ActivityErr'])) {      
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['ActivityErr'];
    echo "</div> </div>";
  } 
//EmptyActivityErr 
  if(!empty($_COOKIE['EmptyActivityErr'])) {     
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['EmptyActivityErr'];
    echo "</div> </div>";
  } 

?>

  <h1><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Activity </h1>

  <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-bottom: 20px;"> Add New activity </a>
<!-- model -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
         <h4 class="modal-title span7 text-center" id="myModalLabel"><span class="title">Login</span></h4>

    </div>
    <div class="modal-body">

        {!! Form::open(['route'=>'activity.store','method'=>'post','id'=>'form','files'=>'true']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

       
            <div class="form-group">
                <label for="input_goverment" class="control-label col-md-3">Goverment</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="goverment" name="goverment" placeholder="goverment">
                </div>
            </div>
           
            <div class="form-group">
                <label for="input_city" class="control-label col-md-3">City</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="city" name="city" placeholder="city">
                </div>
            </div>
           

          <div class="form-group">
                <label for="input_company" class="control-label col-md-3">company</label>
                <div class="col-md-9">
                  {!!Form::select('company', ([null => 'Select Company name'] + $company->toArray()) ,null,['class'=>'form-control','id' => 'prettify','name'=>'company'])!!}
                 </div>
            </div>




          <div class="form-group">
                        <label for="input_start_date" class="control-label col-md-3">Start Date</label>
                        <div class="col-md-9">
                          <input type="date" class="form-control" id="start_date" name="start_date" >
                        </div>
                    </div>



          <div class="form-group">
                        <label for="input_duration" class="control-label col-md-3">duration</label>
                        <div class="col-md-9">
                           <input type="text" class="form-control" id="duration" name="duration">
                         </div>
                    </div>


        <div class="form-group">
                        <label for="input_activity_type" class="control-label col-md-3">Activity Type</label>
                        <div class="col-md-9">
                           <input type="text" class="form-control" id="activity_type" name="activity_type">
                         </div>
                    </div>




        <div class="form-group">
                        <label for="input_description" class="control-label col-md-3">Description</label>
                        <div class="col-md-9">
                           <input type="text" class="form-control" id="description" name="description">
                         </div>
                    </div>


 <div class="form-group">
                        <label for="input_pic" class="control-label col-md-3">Chose the picture</label>
                        <div class="col-md-9">
<!--                           <input type="file" class="form-control" id="pic" name="pic">   -->


                              {!! Form::file('pic', ['class' => 'form-control','name'=>'pic']) !!}
                    </div>
                    </div>

    </div>
       
  
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="login_form_submit" value="Login">Save</button>
    </div>

      {!!Form::close() !!}
    </div>
    </div>
  </div>
<!-- ENDModal -->
          @if(Session::has('error'))
           
          <div class="alert alert-danger" style="text-align:center;" >
         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
                  <strong>Whoops!</strong> {{ Session::get('error') }}<br><br>

    
    </div>
    @endif
<table class="table table-hover table-bordered  dt-responsive nowrap display users" cellspacing="0" width="100%">
  <thead>
              <th>No</th>
                <th>Goverment</th>
                     <th>City</th>
                      <th> Company</th>
                           <th>Start Date</th>
                            <th>Duration</th>
                           <th>Activity Name</th>
                         <th>Description</th>
                         <th>Image</th>
                         <th>Action</th>            
  </thead>
    <tfoot>
        
                  <th></th> 
                <th>Goverment</th>
                    <th>City</th>
                      <th> Company</th>
                           <th>Start Date</th>
                            <th>Duration</th>
                           <th>Activity Name</th>
                         <th>Description</th>
                           <th>Image</th>
                            <th></th>
            
                  </tfoot>
               

<tbody style="text-align:center;">
  <?php $i=1;?>
  @foreach($activity as $activity)
    <tr>
    
     <td>{{$i++}}</td>
         <td><a  class="testEdit" data-type="text" data-name="goverment" data-pk="{{ $activity->id }}">{{$activity->goverment}}</a></td>

         <td><a  class="testEdit" data-type="text" data-name="city" data-pk="{{ $activity->id }}">{{$activity->city}}</a></td>

         <td><a class="testEdit" data-type="select"  data-value="{{$activity->company_id}}" data-source ="{{$company}}" data-name="company_id"  data-pk="{{$activity->id}}">{{$activity->getcompany->name}}</td>


         <td><a  class="testEdit" data-type="date" data-format="yyyy-mm-dd" data-name="start_date" data-pk="{{ $activity->id }}" data-title="Select date">{{$activity->start_date}}</a></td>

         <td><a  class="testEdit" data-type="text" data-name="duration" data-pk="{{ $activity->id }}">{{$activity->duration}}</a></td>

         <td><a  class="testEdit" data-type="text" data-name="activity_type" data-pk="{{ $activity->id }}">{{$activity->activity_type}}</a></td>

         <td><a  class="testEdit" data-type="text" data-name="description" data-pk="{{ $activity->id }}">{{$activity->description}}</a></td>

         <td>
          <img src="/activity/{{$activity->id}}" style="width:60px;hight:60px;"></td>
        
             <td>
   
       <a href="/activity/destroy/{{$activity->id}}"class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-trash"></span>  </a>


  </td>
   </tr>
     @endforeach
</tbody>
</table>
</div>
    
    </section>
  


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>


  <script type="text/javascript">

var editor;

  $(document).ready(function(){
     var table= $('.users').DataTable({
  
   
    responsive: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,
    "pagingType": "simple",
      dom: 'lBfrtip',
        buttons: [
           
            
            { extend: 'excel', className: 'btn btn-primary dtb' }
            
            
        ],


   

fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
$.fn.editable.defaults.send = "always";

$.fn.editable.defaults.mode = 'inline';










$('.testEdit').editable({

      validate: function(value) {
        name=$(this).editable().data('name');
        if(name=="goverment"||name=="city"||name=="start_date"||name=="company_id"||name=="duration"||name=="activity_type"||name=="description")
        {
                if($.trim(value) == '') {
                    return 'Value is required.';
                  }
                    }
        if(name=="goverment"||name=="city"||name=="activity_type"||name=="description"||name=="duration")
        {

      var regexp = /^[a-zA-Z\u0600-\u06FF,-][\sa-zA-Z\u0600-\u06FF,-]/;           

       if (!regexp.test(value)) {
            return 'This field is not valid';
        }
        
         }

        },

    placement: 'right',
    url:'{{URL::to("/")}}/ACupdate',
  
     ajaxOptions: {
     type: 'get',
    sourceCache: 'false',
     dataType: 'json'

   },

       params: function(params) {
            // add additional params from data-attributes of trigger element
            params.name = $(this).editable().data('name');

            // console.log(params);
            return params;
        },
        error: function(response, newValue) {
            if(response.status === 500) {
                return 'This Data Already Exist,Enter Correct Data.';
            } else {
                return response.responseText;
            }
        }


});

}
});

 



   $('.users tfoot th').each(function () {



      var title = $('.users thead th').eq($(this).index()).text();
               
 if($(this).index()>=1 && $(this).index()<=7)
        {

           $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
}
        

    });
  table.columns().every( function () {
  var that = this;
 $(this.footer()).find('input').on('keyup change', function () {
          that.search(this.value).draw();
            if (that.search(this.value) ) {
               that.search(this.value).draw();
           }
        });
      
    });


$.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || /^[a-zA-Z\u0600-\u06FF,-][\sa-zA-Z\u0600-\u06FF,-]/i.test(value);
 });




 $("#form").validate({
        rules: {

            goverment: {
                        
                        required: true,
               
                          alpha:true
            },
             city:{
                        
                        required: true,
               
                          alpha:true
            },
             duration:{
                        
                        required: true,
               
                          alpha:true
            },
             company:"required",

             activity_type:{
                        
                        required: true,
               
                          alpha:true
            },
             description:{
                        
                        required: true,
               
                          alpha:true
            },
            start_date:{
                        
                        required: true,
               
                          date: true
            },
            pic:{accept: "image/*"}
        },

        messages: {
            goverment: {
                required: "Please enter goverment",
                alpha: "Goverment must be at least 3 characters"
            },
            city:  {
                required: "Please enter city",
                alpha: "City must be at least 3 characters"
            },
             duration: {
                required: "Please enter duration",
                alpha: "Duration must be at least 3 characters"
            },
             company:"Please select company",
             activity_type: {
                required: "Please enter activity_type",
                alpha: "Activity_type must be at least 3 characters"
            },
             description: {
                required: "Please enter description",
                alpha: "Description must be at least 3 characters"
            },
            start_date:{
                        
                        required: "Please enter start date",
               
                          date:  "Please enter date format yyyy-mm-dd"
            },
            pic:{
                        
                  
               
                          accept:  "Please chose image format png ,jpg"
            }

        }
    });















 });
</script>

{!!Form::open(['action'=>'ActivityController@importactivity','method' => 'post','files'=>true])!!}
    <input type="file" name="file" class="btn btn-primary"/>
    <input type="submit" name="submit" value="Import File" class="btn btn-primary" style="margin-bottom: 20px;"/>  
{!!Form::close()!!}









@stop

