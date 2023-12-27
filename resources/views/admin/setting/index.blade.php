@extends('admin.layouts.app')
@section('content')
<div id="wrapper">
    {{-- Sidebar goes here --}}
    @include('admin.layouts.sidebar')
     <div id="page-wrapper" class="gray-bg">
         {{-- Header goes here --}}
         @include('admin.layouts.header')
         <div class="row">
            <div class="col-xs-12">
                <div class="card mrg_bottom">
                    <div class="page_title_block">
                        <div class="col-md-5 col-xs-12">
                            <div class="page_title">App Settings</div>
                        </div>
                </div>
                    <div class="clearfix"></div> 
                    @if(Session::has('setting-add'))
                        <p id="msgs" class="alert alert-success">{{ Session::get('setting-add') }}</p>
                    @endif 
                    
                <div class="card-body mrg_bottom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#api_about_us" aria-controls="api_about_us" role="tab" data-toggle="tab">About us</a></li>
                        <li role="presentation"><a href="#api_contact_us" aria-controls="api_contact_us" role="tab" data-toggle="tab">Contact us</a></li>
                        <li role="presentation" ><a href="#api_privacy_policy" aria-controls="api_privacy_policy" role="tab" data-toggle="tab">App Privacy Policy</a></li>
                        <li role="presentation"><a href="#api_terms_condition" aria-controls="api_terms_condition" role="tab" data-toggle="tab">App terms conditions</a></li>
                        <li role="presentation"><a href="#api_cancellation_refund" aria-controls="api_cancellation_refund" role="tab" data-toggle="tab">App Cancellation/Refund Policies</a></li>
                    </ul>

                    <div class="tab-content">
                        <div id="api_about_us" class="tab-pane fade in active">
                            <form action="{{route('setting.savepagesetting')}}" name="api_about_us" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}"> 
                                <div class="section">
                                    <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App About us :-</label>
                                        <div class="col-md-6">
                                    
                                        <textarea name="app_about_us" id="app_about_us" class="form-control">{{$SettingsData->app_about_us}}</textarea>
                                        <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script>                                 
                                        <script>CKEDITOR.replace( 'app_about_us' );</script>    
                                        </div>
                                    </div>               
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="btn_about_us" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="api_contact_us" class="tab-pane fade">
                            <form action="{{route('setting.savepagesetting')}}" name="api_contact_us" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}"> 
                                <div class="section">
                                    <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Contact us :-</label>
                                        <div class="col-md-6">                                   
                                        <textarea name="app_contact_us" id="app_contact_us" class="form-control">{{$SettingsData->app_contact_us}}</textarea>
                                        <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script> 
                                        <script>CKEDITOR.replace( 'app_contact_us' );</script>
                                        </div>
                                    </div>               
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="btn_contact_us" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="api_privacy_policy" class="tab-pane fade">
                            <form action="{{route('setting.savepagesetting')}}" name="api_privacy_policy" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}"> 
                                <div class="section">
                                    <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Privacy Policy :-</label>
                                        <div class="col-md-6">
                                    
                                        <textarea name="app_privacy_policy" id="app_privacy_policy" class="form-control">{{$SettingsData->app_privacy_policy}}</textarea>
                                        <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script> 
                                        <script>CKEDITOR.replace( 'app_privacy_policy' );</script>
                                        </div>
                                    </div>               
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="btn_privacy_policy" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="api_terms_condition" class="tab-pane fade">
                            <form action="{{route('setting.savepagesetting')}}" name="api_terms_condition" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}"> 
                                <div class="section">
                                    <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Terms & Condition :-</label>
                                        <div class="col-md-6">
                                    
                                        <textarea name="app_terms_condition" id="app_terms_condition" class="form-control">{{$SettingsData->app_terms_condition}}</textarea>
                                        <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script> 
                                        <script>CKEDITOR.replace( 'app_terms_condition' );</script>
                                        </div>
                                    </div>               
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="btn_terms_condition" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="api_cancellation_refund" class="tab-pane fade">
                            <form action="{{route('setting.savepagesetting')}}" name="api_cancellation_refund" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}"> 
                                <div class="section">
                                    <div class="section-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">App Cancellation/Refund Policies :-</label>
                                        <div class="col-md-6">
                                    
                                        <textarea name="app_cancellation_refund" id="app_cancellation_refund" class="form-control">{{$SettingsData->app_cancellation_refund}}</textarea>
                                        <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script> 
                                        <script>CKEDITOR.replace( 'app_cancellation_refund' );</script>
                                        </div>
                                    </div>               
                                    <div class="form-group">
                                        <div class="col-md-9 col-md-offset-3">
                                        <button type="submit" name="btn_cancellation_refund" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
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
         {{-- Footer goes here --}}
         <!-- @include('admin.layouts.footer') -->
     </div>
 </div>
@endsection
@section('scripts')
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<script src="https://code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
 
@endsection