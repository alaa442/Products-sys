@extends('master')
@section('content')
<meta   name="csrf-token" content="{{ csrf_token() }} " />
<style type="text/css">

.error{
  color: red;
}
</style>


<section class="panel panel-primary">
<div class="panel-body">
  <h1><i class='fa fa-fax'></i> Users </h1>
  <a type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal" style="margin-bottom: 20px;"> Add New user </a>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
        {!! Form::open(['route'=>'selleroffice.store','method'=>'post','id'=>'form']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
         <h4 class="modal-title span7 text-center" id="myModalLabel"><span class="title">Login</span></h4>

    </div>
    <div class="modal-body">
        <div class="col-md-6">
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
                <label for="input_telephone" class="control-label col-md-3">Telephone</label>
                <div class="col-md-9">
                  <input type="number" class="form-control"  id="telephone" name="telephone" >
                </div>
            </div>



  <div class="form-group">
                <label for="input_adress" class="control-label col-md-3">Address</label>
                <div class="col-md-9">
                   <input type="text" class="form-control" id="adress" name="adress">
                 </div>
            </div>


 <div class="form-group">
                <label for="input_cement" class="control-label col-md-3">Avaliable Cement</label>
                <div class="col-md-9">
     {!!Form::select('cement[]', ( $cement->toArray()) ,null,['class'=>'form-control cement chosen-select ','id' => 'prettify','multiple' => true])!!}               
      </div>
            </div>

  <div class="form-group">
                <label for="input_company" class="control-label col-md-3">company</label>
                <div class="col-md-9">
                  {!!Form::select('company', ([null => 'Select Company name'] + $company->toArray()) ,null,['class'=>'form-control','id' => 'prettify','name'=>'company'])!!}
                 </div>
            </div>

    </div>
       
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="login_form_submit" value="Login">Login</button>
    </div>

      {!!Form::close() !!}
    </div>
    </div>
  </div>
</div>
<!-- ENDModal -->

<div id="middlecol">
  <div class="table-responsive"> 
  <table id="selleroffice" style="width:100%" class="table table-hover table-bordered dt-responsive nowrap display selleroffice" cellspacing="0">
<thead>
      <tr>
      <th>No</th>
      <th>Goverment</th> 
      <th>City</th>
      <th>Telephone</th>
            <th>Adress</th>
      <th>Product</th>

      <th>Company</th>
            <th>Process</th>
          
    </tr>
  </thead>

  <tbody id="tbody">
    <?php $i=1;  ?>

    @foreach($selleroffice as $selleroffice)

      <tr> 

        <td>{{$i++}}</td>
          <td><a class="testEdit" data-type="text" data-name="goverment" data-pk="{{ $selleroffice->id }}">{{$selleroffice->goverment}}</a></td>
          <td><a class="testEdit" data-type="text" data-name="city" data-pk="{{ $selleroffice->id }}">{{$selleroffice->city}}</a></td>
          <td><a class="testEdit"   data-type="number" data-name="telephone" data-pk="{{ $selleroffice->id }}">{{$selleroffice->telephone}}</a></td>
          <td><a class="testEdit" data-type="text" data-name="street" data-pk="{{ $selleroffice->id }}">{{$selleroffice->street}}</a></td>
                <td>
                  @foreach($selleroffice->getsellerofficeproduct as $seller)
                <span> {{$seller->cement_name}}, </span>
                         

                    
                    @endforeach
                    </td>
          <td>
            
    <a class="testEdit" data-type="select"  data-value="{{$selleroffice->company_id}}" data-source ="{{$company}}" data-name="company_id"  data-pk="{{$selleroffice->id}}"> 
   </a></td> 
           <td>
   
       <a href="/selleroffice/destroy/{{$selleroffice->id}}"class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-trash"></span>  </a>


  </td>       
             
      </tr>    
    @endforeach 

    

  </tbody>

  <tfoot>
      <th></th>
      <th>Goverment</th> 
      <th>City</th>
      <th>Telephone</th>
      <th>Adress</th>
      <th>Product</th>

      <th>Company</th>
                  <th>Process</th>

  </tfoot>

</table>
</div>
</div>
</div>
</section>
<script type="text/javascript">

  $(document).ready(function(){
    var table= $('.selleroffice').DataTable({ 
    responsive: true,
      lengthChange: false,
      buttons: true,
    "order":[[0,"asc"]],
    'searchable':true,
    "scrollCollapse":true,
    "paging":true,
    "pagingType": "simple",


   lengthChange: false,
    
  
 
      dom: 'Bfrtip',
        buttons: [
            
            'excel'
            
            
        ],
        fnRowCallback: function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
$.fn.editable.defaults.send = "always";

$.fn.editable.defaults.mode = 'inline';

$('.testEdit').editable({

      validate: function(value) {
        name=$(this).editable().data('name');
        if(name=="goverment"||name=="city"||name=="telephone"||name=="street"||name=="company_id")
        {
                if($.trim(value) == '') {
                    return 'Value is required.';
                  }
                    }
        if(name=="goverment"||name=="city"||name=="street")
        {

            var regexp = /^[a-zA-Z\u0600-\u06FF,-][\sa-zA-Z\u0600-\u06FF,-]/;
            if (!regexp.test(value)) {
            return 'This field is not valid';
        }
        
        }
        if(name=="telephone")
        {

            var regexp = /^\d{7,11}$/;;
            if (!regexp.test(value)) {
            return 'This field is not valid';
        }
        
        }


        },

    placement: 'right',
 url:'{{URL::to("/")}}/fupdate',
  
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
   



   $('.selleroffice tfoot th').each(function () {



      var title = $('.selleroffice thead th').eq($(this).index()).text();
               
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
 $.validator.addMethod("checktelephone", 
        function(value, element) {
            var result = false;
            $.ajax({
                  data: {telephone:telephone},
    url: '/telephone',
    type: 'get',

    beforeSend: function (request) {
        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        },

                success: function(data) {
                    result = (data == true) ? true : false;
                }
            });
            // return true if username is exist in database
            return result; 
        }, 
        "This username is already taken! Try another."
    );
   $.validator.addMethod("alpha", function(value, element) {
    return this.optional(element) || /^[a-zA-Z\u0600-\u06FF,-][\sa-zA-Z\u0600-\u06FF,-]/i.test(value);
 });
     var result = false;
 $("#form").validate({
   onkeyup: false,
        rules: {
            goverment: {
                required: true,
                alpha:true

            },
            city:
            { 
              required:true,
               alpha:true
        },
            telephone:
            {
             required:true,
           
           remote: {
          url: "/telephone",
         type: "get",
         data: {
          telephone: function() {
            return $( "#telephone" ).val();
          }
        },
          beforeSend: function (request) {
        return request.setRequestHeader('X-CSRF-Token', $("meta[name='csrf-token']").attr('content'));
        }
      },
           minlength:7,
           maxlength:14




        },
            adress:
            {
             required:true,
               alpha:true
        },
          cement:
            {
             required:true,
             
        },
           company:
            {
             required:true,
             
        }
      },
        messages: {
            goverment: {
                required: "Please provide your Goverment",
                alpha: "Enter Correct Data"

            },
            city: {
                required: "Please provide your City"
            },
             telephone: {
                required: "Please provide your Telephone",
                minlength: " Enter Correct Telephone min",
                maxlength: " Enter Correct Telephone max",

                remote:jQuery.validator.format("This Number {0} is Already Existed")



            },
             adress: {
                required: "Please provide your Adress"
            },
               cement: {
                required: "Please provide your Cement"
            },
             company: {
                required: "Please provide your Company"
            }

        }
    });

  $(".cement").chosen({ 
                   width: '100%',
                   no_results_text: "There is no result",
                   allow_single_deselect: true, 
                   search_contains:true, });
 $(".cement").trigger("chosen:updated");
});
</script>




@stop