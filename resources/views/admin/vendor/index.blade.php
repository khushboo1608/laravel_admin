@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.sidebar')
@include('admin.layouts.header')


<div class="row">
      <div class="col-xs-12">
        <div class="card mrg_bottom">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Manage Vendor</div>
            </div>
            <div class="col-md-7 col-xs-12">              
                  <div class="search_list">
                    <div class="search_block">
                        <form method="get" id="searchForm" action="">
                            <input class="form-control input-sm" placeholder="Search here..." aria-controls="DataTables_Table_0" type="search" name="keyword" value="<?php if(isset($_GET['keyword'])){ echo $_GET['keyword'];} ?>" required="required">
                            <button type="submit" class="btn-search"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="add_btn_primary"> <a href="{{url('admin/vendor/add')}}">Add Vendor</a> </div>
                  </div>
            </div>
            
          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                @if(session()->has('message')) 
                    <div class="alert alert-success alert-dismissible" role="alert"> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    {{session('message')}}</a> 
                </div>
                @endif 
                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                    {{ session('error') }}</a>
                </div>
                @endif  
              </div>
            </div>
          </div>
          <div class="col-md-12 table-responsive mrg-top">
            <table class="table table-striped table-bordered table-hover data-table">
              <thead>
                <tr>
                	<th>Id</th>
                    <!-- <th> Id </th> -->
                    <th> Name </th>
                    <th>Image</th>
                    <th>Email</th>	
                    <th>Phone</th>
                    <th>Feature</th>
                    <th>Status</th>	 
                  <th class="cat_action_list">Action</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
    </div>   

@include('admin.layouts.footer')
@endsection

@section('scripts')
<script type="text/javascript">
    var table;
  // alert('dvxdv');
    $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        ajax: "{{url('admin/vendor') }}",
        // "order": [[ 0, 'desc' ]],
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            // {data: 'id', name: 'id'},
            {data: 'vendor_name', name: 'vendor_name'},
            {data: 'vendor_icon', name: 'vendor_icon', orderable: false, searchable: false,render:function (data, type, row) {return  "<img style='height:50px;width:50px;border-radius: 25px;' src='"+data+"'>"}},
            {data: 'vendor_email', name: 'vendor_email'},
            {data: 'vendor_phone', name: 'vendor_phone'},
            {data: 'vendor_feature', name: 'vendor_feature'},          
            {data: 'vendor_status', name: 'vendor_status'},           
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
  function Feature(VendorId,status)
  {
    // alert(VendorId);
    if(status == 0)
    {
      var btn_text = 'Disable';
      var status = 1;
    }else{
      var btn_text = 'Enable';
      var status = 0;
    }
    swal({
      title: "Are you sure?",
      text: "You want to "+btn_text+" this vendor!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        var delurl = "{{url('admin/feature_vendor')}}";
        $.ajax({
          url: delurl,
          type: "post",
          data: {"_token":"{{csrf_token()}}","id":VendorId,"vendor_feature":status},
          dataType:"json",
          success: function (data) {
            if (data.result == true)
            {
                swal(data.text, data.message, "success");
                $('.data-table').DataTable().ajax.reload();
            } else {
                swal(data.message);
            }
          },
          error:function(request, status, error){
            if(request.status == 419){
              location.href = "{{url('admin/vendor')}}";
            }
          }
        });
      }
    });
  }

  function Status(VendorId,status)
  {
    // alert(status);
    if(status == 1)
    {
      var btn_text = 'Disable';
      var status = 0;
    }else{
      var btn_text = 'Enable';
      var status = 1;
    }
    // alert(status);
    swal({
      title: "Are you sure?",
      text: "You want to "+btn_text+" this vendor!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    }).then((willDelete) => {
      if(willDelete){
        var delurl = "{{url('admin/status_vendor')}}";
        $.ajax({
          url: delurl,
          type: "post",
          data: {"_token":"{{csrf_token()}}","id":VendorId,"vendor_status":status},
          dataType:"json",
          success: function (data) {
            if (data.result == true)
            {
                swal(data.text, data.message, "success");
                $('.data-table').DataTable().ajax.reload();
            } else {
                swal(data.message);
            }
          },
          error:function(request, status, error){
            if(request.status == 419){
              location.href = "{{url('admin/vendor')}}";
            }
          }
        });
      }
    });
  }
  </script>
@endsection