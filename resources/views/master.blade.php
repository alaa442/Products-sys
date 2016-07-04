<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gps System</title>
    <html xmlns="http://www.w3.org/1999/xhtml" >
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">


<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css" />


<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.0.2/js/dataTables.responsive.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.0.2/js/responsive.bootstrap.min.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript"src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.jqueryui.min.js"></script>

<script type="text/javascript"src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script type="text/javascript"src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.2.0/js/dataTables.select.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jeditable/1.7.3/jquery.jeditable.js"></script>



<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/t/dt/jq-2.2.0,dt-1.10.11/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/jquery.dataTables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.jqueryui.min.css
">

<link rel="stylesheet prefetch" href="http://cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.0.2/css/responsive.bootstrap.min.css"/>


<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css"/>
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>

<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>


 <link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-horizon.css"> 
<script src="/assets/js/jQuery.extendext.js"></script>
<script src="/assets/js/doT.min.js"></script>
<script src="/assets/js/query-builder.min.js"></script>


<link rel="stylesheet" type="text/css" href="/assets/css/query-builder.default.min.css">
<!-- 
 <script src="/assets/js/bootstrap.min.js"></script>
 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/css/bootstrap-dialog.min.css">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap3-dialog/1.34.7/js/bootstrap-dialog.min.js"></script>

<link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
<script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.12.0/jquery.validate.js"></script>
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.12.0/additional-methods.js"></script>
<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/1.10.12/api/fnReloadAjax.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.validation/1.13.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="http://cdn.jsdelivr.net/jquery.validation/1.13.0/additional-methods.min.js"></script>

<style type="text/css">
body{

      font-family: 'zocial', sans-serif;
      background-color: #f6f1ed;
   }

.chosen-choices {
    border: 1px solid #ccc;
    border-radius: 4px;
    min-height: 34px;
    padding: 6px 12px;
}
.chosenContainer .form-control-feedback {
    /* Adjust feedback icon position */
    right: -15px;
}
.chosen-container .chosen-drop {
    border-bottom: 0;
    border-top: 1px solid #aaa;
    top: auto;
    bottom: 40px;
}
   tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
 thead input {
        width: 100%;
        padding: 2px;
        box-sizing: border-box;
    }
.footer {
            position: absolute;
             text-align: center;
            bottom: 0;
            width: 100%;
            /* Set the fixed height of the footer here */
            height: 5%;
            background-color: #f5f5f5;
        }
        .wrapper{
          width:75%;
          margin: 0 auto;
          background: #eee;
        }
        .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover {
    color: #fff;
    background-color: #090450;
}
div.well{
  height: 250px;
} 

.Absolute-Center {
  margin: auto;
  position: relative;
  top: 0; left: 0; bottom: 0; right: 0;
}

.Absolute-Center.is-Responsive {
  width: 50%; 
  height: 50%;
  min-width: 200px;
  max-width: 400px;
  padding: 40px;
}
#logo-container{
  margin: auto;
  margin-bottom: 10px;
  width:200px;
  height:30px;
  background-image:url('http://placehold.it/200x30/000000/ffffff/&text=BRAND+LOGO');
}


</style>

<?php 
  function RemoveCookies(){
    //file
      if (isset($_COOKIE['FileError'])) {
          unset($_COOKIE['FileError']);
          setcookie('FileError', null, -1, '/');       
      }
     //CompanyErr
      if (isset($_COOKIE['CompanyErr'])) {
          unset($_COOKIE['CompanyErr']);
          setcookie('CompanyErr', null, -1, '/');       
      }
    //EmptyCompanyErr 
      if (isset($_COOKIE['EmptyCompanyErr'])) {
          unset($_COOKIE['EmptyCompanyErr']);
          setcookie('EmptyCompanyErr', null, -1, '/');       
      }
    //OfficeErr 
    if(!empty($_COOKIE['OfficeErr'])) {      
      unset($_COOKIE['OfficeErr']);
      setcookie('OfficeErr', null, -1, '/');  
    } 
    //EmptyOfficeErr 
    if(!empty($_COOKIE['EmptyOfficeErr'])) {     
      unset($_COOKIE['EmptyOfficeErr']);
      setcookie('EmptyOfficeErr', null, -1, '/');  
    } 
    //ProductErr 
    if(!empty($_COOKIE['ProductErr'])) {      
      unset($_COOKIE['ProductErr']);
      setcookie('ProductErr', null, -1, '/');
    } 
  //EmptyProductErr 
    if(!empty($_COOKIE['EmptyProductErr'])) {     
      unset($_COOKIE['EmptyProductErr']);
      setcookie('EmptyProductErr', null, -1, '/');
    } 
//PromoterErr 
  if(!empty($_COOKIE['PromoterErr'])) {      
      unset($_COOKIE['PromoterErr']);
      setcookie('PromoterErr', null, -1, '/');
  } 
//EmptyPromoterErr 
  if(!empty($_COOKIE['EmptyPromoterErr'])) {     
      unset($_COOKIE['EmptyPromoterErr']);
      setcookie('EmptyPromoterErr', null, -1, '/');
    }
//ActivityErr 
  if(!empty($_COOKIE['ActivityErr'])) {      
      unset($_COOKIE['ActivityErr']);
      setcookie('ActivityErr', null, -1, '/');
  } 
//EmptyActivityErr 
  if(!empty($_COOKIE['EmptyActivityErr'])) {     
      unset($_COOKIE['EmptyActivityErr']);
      setcookie('EmptyActivityErr', null, -1, '/');
    }
  
  }
?>
</head>

<body onload="<?php echo RemoveCookies() ?>">


<nav class="navbar navbar-inverse" style=" background-color: #16174f
;">
  <div class="container-fluid">
    <div class="navbar-header">

      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#"> <img src="/assets/img/icon1.png" width="10%" height="100%" style="float:left;">
        Gps System </a>
    
      
    </div>
 <div class="collapse navbar-collapse" id="myNavbar">
  
      <ul class="nav navbar-nav">
    
          <li><a href="/users">Users</a></li>

        
<li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Admin Panel
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
           <li><a class="side_menu" href="/adminpanel">Home</a></li>  

           <li><a class="side_menu" href="/map/show">Show Map</a></li>  
        </ul>
      </li>





           
          <li><a href="/reports">Reports</a></li>
         
         
        
    </ul>

    <ul class="nav navbar-nav navbar-right"> 
      <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
    </ul

  </div>
  </div>
</nav>

      <div class="container-fluid">
        <main>
          @yield('content')
        </main>
      </div>

  </div>


</body>

</html>