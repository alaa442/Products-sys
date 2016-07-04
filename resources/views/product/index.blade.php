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
//CompanyErr 
  if(!empty($_COOKIE['CompanyErr'])) {      
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['CompanyErr'];
    echo "</div> </div>";
  } 
//EmptyCompanyErr 
  if(!empty($_COOKIE['EmptyCompanyErr'])) {     
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['EmptyCompanyErr'];
    echo "</div> </div>";
  } 
//OfficeErr 
  if(!empty($_COOKIE['OfficeErr'])) {      
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['OfficeErr'];
    echo "</div> </div>";
  } 
//EmptyOfficeErr 
  if(!empty($_COOKIE['EmptyOfficeErr'])) {     
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['EmptyOfficeErr'];
    echo "</div> </div>";
  } 
//ProductErr 
  if(!empty($_COOKIE['ProductErr'])) {      
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['ProductErr'];
    echo "</div> </div>";
  } 
//EmptyProductErr 
  if(!empty($_COOKIE['EmptyProductErr'])) {     
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['EmptyProductErr'];
    echo "</div> </div>";
  } 
//PromoterErr 
  if(!empty($_COOKIE['PromoterErr'])) {      
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['PromoterErr'];
    echo "</div> </div>";
  } 
//EmptyPromoterErr 
  if(!empty($_COOKIE['EmptyPromoterErr'])) {     
    echo "<div><div class='alert alert-block alert-danger fade in center'>";
    echo $_COOKIE['EmptyPromoterErr'];
    echo "</div> </div>";
  } 

?>

  <h1><i class="fa fa-lightbulb-o" aria-hidden="true"></i> Product </h1>

  <a type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal" style="margin-bottom: 20px;"> Add New Product </a>
<!-- model -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-width="760">

  <div class="modal-dialog" role="document">
    <div class="modal-content">
    
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
         <h4 class="modal-title span7 text-center" id="myModalLabel"><span class="title">Create New Product</span></h4>

    </div>
    <div class="modal-body">

        {!! Form::open(['route'=>'product.store','method'=>'post','id'=>'form','files'=>'true']) !!}
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

       
            <div class="form-group">
                <label for="input_cement_name" class="control-label col-md-3">Cement Name</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="cement_name" name="cement_name" placeholder="Cement Name">
                </div>
            </div>
           
            <div class="form-group">
                <label for="input_weight" class="control-label col-md-3">Weight</label>
                <div class="col-md-9">
                    <input type="number" class="form-control" id="weight" name="weight" placeholder="weight">
                </div>
            </div>
           
              <div class="form-group">
                <label for="input_rank" class="control-label col-md-3">Rank</label>
                <div class="col-md-9">
                    <input type="number"  step="any" class="form-control" id="rank" name="rank" placeholder="rank">
                </div>
            </div>

           <div class="form-group">
                <label for="input_specifications" class="control-label col-md-3">Specifications</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="specifications" name="specifications" placeholder="specifications">
                </div>
            </div>

            <div class="form-group">
                <label for="input_guidlines" class="control-label col-md-3">Guidlines</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="guidlines" name="guidlines" placeholder="guidlines">
                </div>
            </div>

            <div class="form-group">
                <label for="input_security" class="control-label col-md-3">Security</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="security" name="security" placeholder="Security">
                </div>
            </div>

            <div class="form-group">
                <label for="input_others" class="control-label col-md-3">others</label>
                <div class="col-md-9">
                    <input type="text" class="form-control" id="others" name="others" placeholder="others">
                </div>
            </div>

          <div class="form-group">
                <label for="input_company" class="control-label col-md-3">company</label>
                <div class="col-md-9">
                  {!!Form::select('company', ([null => 'Select Company name'] + $company->toArray()) ,null,['class'=>'form-control','id' => 'prettify','name'=>'company'])!!}
                 </div>
            </div>

          <div class="form-group">
                        <label for="input_producation_date" class="control-label col-md-3">Producation Date</label>
                        <div class="col-md-9">
                          <input type="date" class="form-control" id="producation_date" name="producation_date" >
                        </div>
                    </div>

          <div class="form-group">
                        <label for="input_packing_date" class="control-label col-md-3">Packing Date</label>
                        <div class="col-md-9">
                          <input type="date" class="form-control" id="packing_date" name="packing_date" >
                        </div>
                    </div>

 <div class="form-group">
                        <label for="input_frontimg" class="control-label col-md-3">Chose the Front picture</label>
                        <div class="col-md-9">

                              {!! Form::file('frontimg', ['class' => 'form-control','name'=>'frontimg']) !!}
                    </div>
                    </div>


<div class="form-group">
                        <label for="input_backimg" class="control-label col-md-3">Chose the Back picture</label>
                        <div class="col-md-9">

                              {!! Form::file('backimg', ['class' => 'form-control','name'=>'backimg']) !!}
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
	<table id="product" style="width:100%" class="table table-hover table-bordered dt-responsive nowrap display product" cellspacing="0">
  	    
<thead>
  		<tr>
			 <th>No</th>
		     <th>Cement Name</th> 
             <th>Cement Weight</th>
			 <th>Cement Rank</th>
			 <th>Cement Specifications</th>
			 <th>Cement Producation Date</th>
             <th>Cement Packing Date</th>
			 <th>Cement Guidlines</th>
			 <th>Cement Security</th>
			 <th>Cement Others</th>
			 <th>Cement Front image</th>
			 <th>Cement back Image</th>
			 <th>Comapny Name</th> 
	         <th>Selleroffice</th> 
	         <th>Action</th>            


				
		</tr>
	</thead>

	<tbody id="tbody">
		<?php $i=1;  ?>

		@foreach($product as $product)
			<tr> 

				<td>{{$i++}}</td>
			<td>{{$product->cement_name}}</td>
			<td>{{$product->weight}}</td>
			<td>{{$product->rank}}</td>
			<td>{{$product->specifications}}</td>
			<td>{{$product->producation_date}}</td>
            <td>{{$product->packing_date}}</td>
			<td>{{$product->guidlines}}</td>
			<td>{{$product->security}}</td>
			<td>{{$product->others}}</td>
          
			<td>{{$product->frontimg}}</td>
			<td>{{$product->backimg}}</td>
			 <td>{{$product->getcompanyproduct->name}}</td>

			 <td>
                  @foreach($product->getproductselleroffice as $pro)
                <span> {{$pro->goverment}} , {{$pro->city}}</span>
                  @endforeach
                    </td>
			   <td>       <a href="/product/destroy/{{$product->id}}"class="btn btn-default btn-sm" ><span class="glyphicon glyphicon-trash"></span>  </a>
</td>
		 @endforeach	    

	</tbody>

	<tfoot>
 			<th></th>
			 <th>Cement Name</th> 
             <th>Cement Weight</th>
			 <th>Cement Rank</th>
			 <th>Cement Specifications</th>
			 <th>Cement Producation Date</th>
             <th> Cement Packing Date</th>
			 <th>Cement Guidlines</th>
			<th>Cement Security</th>
			<th>Cement Others</th>
			<th>Cement Front image</th>
			<th>Cement back Image</th>
			<th>Comapny Name</th> 
	       <th>Selleroffice</th> 
	
	</tfoot>

</table>

<script type="text/javascript">

  $(document).ready(function(){


    var table= $('.product').DataTable({ 
   
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

});


       




$('.product tfoot th').each(function () {

    var title = $('.product thead th').eq($(this).index()).text();

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


});

</script>


{!!Form::open(['action'=>'ProductController@importproduct','method' => 'post','files'=>true])!!}
    <input type="file" name="file" class="btn btn-primary"/>
    <input type="submit" name="submit" value="Import File" class="btn btn-primary" style="margin-bottom: 20px;"/>  
{!!Form::close()!!}

</div>
</div>
</div>
</section>
@stop