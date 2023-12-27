@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.sidebar')
@include('admin.layouts.header')
<div class="row">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title">Manage Users</div>
                </div>
                <div class="col-md-7 col-xs-12">              
                    <div class="search_list">
                        <div class="add_btn_primary"> <a href="{{url('admin/user/add')}}">Add User</a> </div>
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
                        </div>
                  </div>
            </div>
            <div class="col-md-12 mrg-top table-responsive">
                <table class="table table-striped table-bordered table-hover data-table" >
                <thead>
                        <tr>
                            <th>No</th>
                            <!-- <th>ID</th> -->
                            <th>Name</th>
                            <th>Image</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>IsVerified</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@include('admin.layouts.footer')
@endsection

@section('scripts')
 <!--Data Table-->

 
<script type="text/javascript">
    var table;

    $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        // scrollX: true,
        ajax: "{{url('admin/user') }}",
        // "order": [[ 0, 'desc' ]],
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            // {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'imageurl', name: 'imageurl', orderable: false, searchable: false,width:"10%",render:function (data, type, row) {return  "<img style='height:50px;width:50px;border-radius: 25px;' src='"+data+"'>"}},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'is_verified', name: 'is_verified'},  
            {data: 'is_disable', name: 'is_disable'},           
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
    
  });
    function DeleteUser(UserId)
    {
        swal({
            title: "Are you sure ??",
            text: "You will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
                var delurl = "{{url('admin/user_delete')}}";
                $.ajax({
                    url: delurl,
                    type: "post",
                    data: {"_token": "{{ csrf_token() }}",'id': UserId},
                    dataType: 'json',
                    success: function (data) {
                        if (data.result == true)
                        {
                            swal("Deleted!", data.message, "success");
                            $('.data-table').DataTable().ajax.reload();
                        } else {
                            swal(data.message);
                        }
                    },
                    error: function (request, status, error) {
                        if(request.status == 419)
                        {
                            location.href = "{{url('admin/user')}}";
                        }
                    }
                });
            }
        });
    }

    function Status(UserId,status)
    {
        if(status === 0)
        {
            var btn_text = 'Disable';
            var status = 1;
        }
        else
        {
            var btn_text = 'Enable';
            var status = 0;
        }
        swal({
            title: "Are you sure ?",
            text: "You want to "+btn_text+" this user!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
          if (willDelete) {
                var delurl = "{{url('admin/change_status')}}";
                $.ajax({
                    url: delurl,
                    type: "post",
                    data: {"_token": "{{ csrf_token() }}",'id': UserId,'is_disable':status},
                    dataType: 'json',
                    success: function (data) {
                        if (data.result == true)
                        {
                            swal(data.text, data.message, "success");
                            $('.data-table').DataTable().ajax.reload();
                        } else {
                            swal(data.message);
                        }
                    },
                    error: function (request, status, error) {
                        if(request.status == 419)
                        {
                            location.href = "{{url('admin/user')}}";
                        }
                    }
                });
            }
        });
    }
</script>
@endsection