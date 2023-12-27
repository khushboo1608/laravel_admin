<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Basic Admin') }}</title>
    <link rel="icon" target="_blank" href="{{config('global.static_image.favicon')}}" type="image/x-icon" >
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/vendor.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/flat-admin.css')}}">
 
    
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/fonts/font-awesome/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" /> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/js/bootstrap-select.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.10.0/css/bootstrap-select.min.css" rel="stylesheet" /> -->
<!-- --------------------------------data table ------------------------------------>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>

    <!-- -------------------------------- end data table ------------------------------------>

    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/theme/blue-sky.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/theme/blue.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/theme/red.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/css/theme/yellow.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('public/admin_assets/custom_css.css')}}">

    <link href="{{url('public/admin_assets/ckeditor/ckeditor.js') }}" rel="stylesheet">
    <link href="{{url('public/admin_dir/css/sweetalert/sweetalert.css') }}" rel="stylesheet">

    <link href="{{url('public/admin_dir/css/switchery/switchery.css') }}" rel="stylesheet">    
 
    <style type="text/css">
  .btn_edit, .btn_delete, .btn_cust{
    padding: 5px 10px !important;
    font-size: 12px !important; 
  }
  .sa-button-container .btn{
    font-size: 16px;padding: 8px 20px;
  }

  .control-label-help{
    color: red !important;
  }

  .dropdown-li{
    margin-bottom: 0px !important;
  }
  .cust-dropdown-container{
    background: #E7EDEE;
    display: none;
  }
  .cust-dropdown{
    list-style: none;
    background: #eee;
  }
  .cust-dropdown li a{
    padding: 8px 5px;
    width: 100%;
    display: block;
    color: #444;
    float: left;
    text-decoration: none;
    transition: all linear 0.2s;
    font-weight: 500;
  }
  .cust-dropdown li a:hover{
    color: #db4437;
  }

  .cust-dropdown li a.active{
    color: #db4437;
  }

 </style>
</head>