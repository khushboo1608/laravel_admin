@extends('admin.layouts.app')
@section('content')

<div class="app app-default">
  <div class="app-container app-login">
    <div class="flex-center">
      <div class="app-body">
        <div class="app-block">
          <div class="app-form login-form">
            <div class="form-header">
              <div class="app-brand">        
              
               <img src="{{Helper::AppLogoImage()}}" height="100px" width="100px" class="gambar img-responsive img-thumbnail" id="item-img-output" name="item-img-output" >
              
              </div>
            </div>
            <!-- <div class="form-header">
              <div class="app-brand">{{env('APP_NAME')}} </div>
            </div> -->
            <div class="login_title_lineitem"></div>
            <div class="clearfix"></div>
            <form action="{{ route('login') }}" method="post" id="admin-login-form" name="admin-login-form">

            @if(session()->has('message')) 
              <div class="input-group" style="border:0px;">
                <div class="alert alert-danger  alert-dismissible" role="alert">
                {{session('message')}}
              </div>
            </div>
            @endif   
                        
            @csrf
              <div class="input-group"> 
                <span class="input-group-addon" id="basic-addon1"> <i class="fa fa-user" aria-hidden="true"></i></span>
                <label for="email"></label>
                <input type="text" name="email" id="email" class="form-control" placeholder="Email" aria-describedby="basic-addon1" required="true">
              </div>
              <div class="input-group"> <span class="input-group-addon" id="basic-addon2"> <i class="fa fa-lock" aria-hidden="true"></i></span>
              <label for="password"></label>
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2"  autocomplete="on" required="true">
              </div>
              <div class="text-center">
                <input type="submit" class="btn btn-success btn-submit" value="Login">
              </div>
              @if(session()->has('error'))
                  <div class="sufee-alert alert with-close alert-danger alert-dismissible fade show">
                      {{session('error')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">×</span>
                      </button>
                  </div>
              @endif
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->
<script>
    $(document).ready(function ()
    {
        // $('.pace-done').css('background','#f3f3f4');
        $('#admin-login-form').validate({ // initialize the plugin
            rules: {
                email: {
                    noSpace: true,
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    noSpacePassword:true
                },
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
               
                error.addClass('invalid-feedback');
                $('#invalid-feedback_email').hide();
                $('#invalid-feedback_password').hide();
                // element.closest('.input-group').append(error);
                // $('.error').css("font-weight", "bold");
                if(element.parent('.input-group').length) {
                    error.insertAfter(element.parent());
                } else {
                    error.insertAfter(element);
                }
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
                
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            messages: {
                email: {
                    required: "{{__('messages.admin.user.email_required')}}",
                    email: "{{__('messages.admin.user.email_format')}}"
                },
                password: {
                    required: "{{__('messages.admin.user.password_required')}}",
                }
            }
        });

        setTimeout(function(){
            $("div.alert").remove();
        }, 5000 ); // 5 secs
    });  
</script>
@endsection