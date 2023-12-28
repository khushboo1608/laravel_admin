@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.sidebar')
@include('admin.layouts.header')

<div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">

              <div class="col-md-5 col-xs-12">
                    <div class="page_title">Edit User</div>
              </div>
              <div class="col-md-7 col-xs-12">
                    <div class="search_list">
                        <button type="button" onclick="window.location.href='{{url('admin/user')}}'" class="btn btn-primary waves-effect waves-light"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</button>
                    </div>
              </div>

          </div>
          <div class="clearfix"></div>
          <div class="row mrg-top">
            <div class="col-md-12">
               
              <div class="col-md-12 col-sm-12">
                @if(session()->has('message')) 
                <div class="input-group" style="border:0px;">
                    <div class="alert alert-danger  alert-dismissible" role="alert">
                    {{session('message')}}
                </div>
                </div>
                @endif   
              </div>
            </div>
          </div>
          <div class="card-body mrg_bottom"> 
            <form action="{{route('user.saveuser')}}" class="form form-horizontal" method="post" enctype="multipart/form-data" >
            @csrf 
            <input type="hidden" name="id" id="id" value="{{$UserData->id}}">         
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label">Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="name" id="name" value="{{$UserData->name}}" class="form-control" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label">Email :-</label>
                    <div class="col-md-6">
                      <input type="email" name="email" id="email" value="{{$UserData->email}}" class="form-control" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Password :-</label>
                    <div class="col-md-6">
                      <input type="password" name="password" autoci id="password" value="" class="form-control" >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-md-3 control-label">Phone :-</label>
                    <div class="col-md-6">
                      <input type="text" name="phone" id="phone" value="{{$UserData->phone}}" class="form-control">
                    </div>
                  </div>
                     <div class="form-group">
                    <label class="col-md-3 control-label">Select Image :-
                      <p class="control-label-help">(Recommended resolution: 300x300,400x400 or Square Image)</p>
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="imageurl" value="fileupload" id="fileupload"  accept="image/png, image/jpeg, image/jpg">
                            <?php 
                            if(!empty($UserData->imageurl) )
                            {
                              $url = url('public/images/app/user_profile/' . $UserData->imageurl);
                            }else{
                              $url = config('global.no_image.no_image');
                            }
                            ?>
                            <img type="image" src="{{$url}}" alt="image" style="width: 100%;height: 100%;" />
                           
                      </div>
                    </div>
                  </div>
                 
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                      <a class="btn btn-danger" href="{{url('admin/user')}}">Cancel</a>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@include('admin.layouts.footer')
@endsection