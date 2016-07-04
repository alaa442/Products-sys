<!DOCTYPE html>
<html  lang="en">
<head>

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.12/angular.min.js"></script>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <title>Login</title>
       <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<!-- <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Arabic.json">
 -->
<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.1.min.js"></script>

<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>


<!--<script type="text/javascript" src="https://cdn.datatables.net/t/dt/jq-2.2.0,dt-1.10.11/datatables.min.js"></script>-->

  <script src="/assets/js/bootstrap.min.js"></script>
 
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap-horizon.css">
<!-- <link rel="stylesheet" type="text/css" href="/assets/css/rtl.css">
<!--  -->
 -->

<style type="text/css">
body{

      font-family: 'zocial', sans-serif;

    background: url(/assets/img/back.png);
    background-color: #444;
    background: url(http://mymaplist.com/img/parallax/pinlayer2.png),
    url(http://mymaplist.com/img/parallax/pinlayer1.png),
    url(/assets/img/back.png);    
}

.vertical-offset-100{
    padding-top:100px;
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
</style>

</head>

<body >

<div class="row">


        <div class="container-fluid">
            <main>
                @yield('content')
            </main>
        </div>

    </div>


</body>

</html>