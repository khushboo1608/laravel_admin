@extends('admin.layouts.app')
@section('style')
   <style>
.btn-primary {
    margin-right: 20px !important;
    margin-top: 20px !important;
}

/* Validation */
label.error {
  color: #cc5965 !important;
  display: inline-block;
  margin-left: 5px;
}
.form-control.error {
  border: 1px dotted #cc5965 !important;
}
   </style>
@endsection
@section('content')
<div id="wrapper">
    {{-- Sidebar goes here --}}
    @include('admin.layouts.sidebar')
     <div id="page-wrapper" class="gray-bg">
         {{-- Header goes here --}}
         @include('admin.layouts.header')
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">profile</div>
            </div>
            <div class="col-md-7 col-xs-12">
                  <div class="search_list">
                      <a href="{{url('admin/home')}}"><button type="button"  class="btn btn-primary waves-effect waves-light"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</button></a>                                          
                  </div>
            </div>
          </div>
          <div class="clearfix"> 
          </div>
          <div class="card-body mrg_bottom">
          <div class="row">
            @if(Session::has('profile-update'))
                <p id="msgs" class="alert alert-success">{{ Session::get('profile-update') }}</p>
            @endif 
            @if(Session::has('profile-error'))
                    <p id="msgs1" class="alert alert-danger">{{ Session::get('profile-error') }}</p>  
                    @endif 
                <div class="col-md-4">
                    <div class="ibox float-e-margins">
                    
                        <div class="ibox-title">
                            <h5>Profile Detail</h5>
                        </div>
                        <div>
                            <form action="{{ url('admin/update_profile') }}" method="POST" enctype="multipart/form-data" >
                            
                                @csrf
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <label class="cabinet center-block">
                                        <figure>
                                            <img src="{{Helper::LoggedUserImage()}}"  class="gambar img-responsive img-thumbnail" id="item-img-output" name="item-img-output">
                                             <input type="hidden" name="image1" id="image1" >
                                        </figure>
                                        <input name="imageurl"  type="file" value="fileupload" id="imageurl" required="true" style="margin-top: 10px !important; " accept="image/png, image/jpeg, image/jpg">
                                    </label>
                                    <div class="text-center profile-widget-social">
                                        <input type="submit" name="submit" value="Upload Image" class="btn btn-primary uploadbtnImage" id="uploadbtnImage">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change Password</h5>
                        </div>
                        <div class="ibox-content">    
                            <form id="admin-change-password" name="admin-change-password" action="{{ url('admin/change_password') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="old_password">Old  password:</label>
                                    <input placeholder="Enter Password" type="password" class="form-control" id="old_password" name="old_password">
                                </div>

                                <div class="form-group">
                                    <label for="new_password">New  password:</label>
                                    <input placeholder="Enter New Password" type="password" class="form-control" id="new_password" name="new_password">
                                </div>

                                <div class="form-group">
                                    <label for="confirm_password">Confirm password:</label>
                                    <input placeholder="Enter Confirm Password" type="password" class="form-control" id="confirm_password" name="confirm_password">
                                </div>
                                <div class="profile-wall-action">
                                    <div class="wall-action-right">
                                        <button type="submit" class="btn btn-primary" id="chnge-submit">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
@section('scripts')
<script src="{{ url('public/admin/js/form-validation/custom-form-validation.js') }}"></script>
<script type="text/javascript">
     $(document).ready(function ()
    {
        // chnage password form validation
        $('#admin-change-password').validate({ // initialize the plugin
            rules: {
                old_password: {
                    noSpacePassword: true,
                    required: true,
                    remote: {
                        url: "{{url('admin/check_old_password')}}",
                        type: 'post',
                        data: {
                            _token: '{{csrf_token()}}',
                        }
                    }
                },
                new_password: {
                    noSpacePassword:true,
                    required: true,
                    notEqual: "#old_password",
                    // ValidPassword:true
                    
                },
                confirm_password: {
                    noSpacePassword: true,
                    required: true,
                    equalTo: "#new_password",
                    // ValidPassword:true
                }
            },
            
            errorElement: 'span',
            errorPlacement: function (error, element) {
               
                error.addClass('invalid-feedback');
               
                element.closest('.form-group').append(error);
                $('.error').css("font-weight", "bold");
            },
            highlight: function (element, errorClass, validClass) {
                // alert(validClass);
                $(element).addClass('is-invalid');
                
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            messages: {
                old_password: {
                    required: "{{__('messages.admin.user.old_password_required')}}",
                    remote: "{{__('messages.admin.user.current_password_not_match')}}"
                },
                new_password: {
                    required: "{{__('messages.admin.user.new_password_required')}}",
                },
                confirm_password: {
                    required: "{{__('messages.admin.user.confirm_password_required')}}",
                    equalTo: "{{__('messages.admin.user.confirm_new_password_not_match')}}",
                }
            }
        });
    });    
</script>
@endsection