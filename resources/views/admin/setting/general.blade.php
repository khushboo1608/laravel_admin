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
                        <li role="presentation" class="active"><a href="#general_settings" aria-controls="general_settings" role="tab" data-toggle="tab">General Settings</a></li>
                        <li role="presentation" ><a href="#app_settings" aria-controls="app_settings" role="tab" data-toggle="tab">App Settings</a></li>
                        <li role="presentation"><a href="#notification_settings" aria-controls="notification_settings" role="tab" data-toggle="tab">Notification Settings</a></li>
                        <li role="presentation"><a href="#delivery_settings" aria-controls="delivery_settings" role="tab" data-toggle="tab">Delivery Settings</a></li>
                        <li role="presentation"><a href="#payment_settings" aria-controls="payment_settings" role="tab" data-toggle="tab">Payment Settings</a></li>
                        <li role="presentation"><a href="#banking_settings" aria-controls="banking_settings" role="tab" data-toggle="tab">Banking Settings</a></li>
                    </ul>

                    <div class="tab-content">
                        
                        <div  class="tab-pane fade in active" id="general_settings">   
                            <form action="{{route('setting.savegeneral')}}" name="settings_from" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}"> 
                            <div class="section">
                                <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Name :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_name" id="app_name" value="{{$SettingsData->app_name }}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Logo :- <p class="control-label-help">(Recommended resolution: 100x100 Image)</p></label>
                                    <div class="col-md-6">
                                    <div class="fileupload_block">
                                        <input type="file" name="app_logo" id="fileupload"> 
                                        
                                        @if($SettingsData->app_logo !='')
                                        @php
                                        $url = url('public/images/app/app_logo/' . $SettingsData->app_logo)
                                        @endphp
                            <div class="fileupload_img"><img type="image" src="{{$url}}" /></div>
                            @else
                            <div class="fileupload_img"><img type="image" src="{{config('global.no_image.add_image')}}"  /></div>
                            @endif
                            <input id="app_logo" type="hidden" name="app_logo_edit"  value="{{$SettingsData->app_logo ?  $SettingsData->app_logo:''}}">
                            <input id="app_upi_image" type="hidden" name="app_upi_image_edit"  value="{{$SettingsData->app_upi_image ?  $SettingsData->app_upi_image:''}}">
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Description :-</label>
                                    <div class="col-md-6">
                                
                                    <textarea name="app_description" id="app_description" class="form-control">{{$SettingsData->app_description }}</textarea>
                                    <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script> 
                                    <script>CKEDITOR.replace( 'app_description' );</script>
                                    </div>
                                </div>
                                <div class="form-group">&nbsp;</div>                 
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Contact :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_contact" id="app_contact" value="{{$SettingsData->app_contact}}" class="form-control">
                                    </div>
                                </div>     
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Email :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_email" id="app_email" value="{{$SettingsData->app_email}}" class="form-control">
                                    </div>
                                </div>                 
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Website :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_website" id="app_website" value="{{$SettingsData->app_website}}" class="form-control">
                                    </div>
                                </div>                               
                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Facebook :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_facebook" id="app_facebook" value="{{$SettingsData->app_facebook}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Youtube :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_youtube" id="app_youtube" value="{{$SettingsData->app_youtube}}" class="form-control">
                                    </div>
                                </div>
                                   
                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Twitter :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_twitter" id="app_twitter" value="{{$SettingsData->app_twitter}}" class="form-control">
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Instagram :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_instagram" id="app_instagram" value="{{$SettingsData->app_instagram}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Whatsapp :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_whatsapp" id="app_whatsapp" value="{{$SettingsData->app_whatsapp}}" class="form-control">
                                    </div>
                                </div>
                                                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">App Linkedin :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_linkedin" id="app_linkedin" value="{{$SettingsData->app_linkedin}}" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="submit" id="btngeneral" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div  class="tab-pane fade" id="app_settings">   
                            <form action="{{route('setting.savegeneral')}}" name="frmapp_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}"> 
                            <div class="section">
                                <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Maintenance :-</label>
                                    <div class="col-md-6">
                                        <div class="row" style="margin-top: 15px">
                                        <input type="checkbox" id="chk_update" name="app_maintenance_status" value="1" {{ $SettingsData->app_maintenance_status == 1 ? 'checked' : null }} class="cbx hidden" />
                                            <label for="chk_update" class="lbl" style="left:13px;"></label>
                                            <br />
                                        </div>
                                        </div>
                                </div>
                                <br />
                                <div class="form-group">
                                    <label class="col-md-3 control-label">New App Version Code :- <br /><span>
                                        (How to get version code)</span></label>
                                    
                                    <div class="col-md-6">
                                    <input type="text" name="app_version" id="app_version" value="{{$SettingsData->app_version}}" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label"> Maintenance Description :- </label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_maintenance_description" id="app_maintenance_description" value="{{$SettingsData->app_maintenance_description}}"  class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group"> 
                                    <label class="col-md-3 control-label"> Update Description :- </label>
                                    <div class="col-md-6">
                                    <input type="text" name="app_update_description" id="app_update_description" value="{{$SettingsData->app_update_description}}" class="form-control">
                                    </div>
                                </div>
                                
                        
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Cancel Option :-<br /> ( Cancel button option will show in app update popup ) </label>
                                    <div class="col-md-6">
                                        <input type="checkbox" id="chk_cancel_update" name="app_update_cancel_button" value="1" {{ $SettingsData->app_update_cancel_button == 1 ? 'checked' : null }} class="cbx hidden"/>
                                            <label for="chk_cancel_update" class="lbl" style="left:13px;"></label>
                                    </div>
                                </div>
                                <br />

                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="btn_app_settings" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div  class="tab-pane fade" id="notification_settings">
                            <form action="{{route('setting.savegeneral')}}" name="settings_api" method="post" class="form form-horizontal" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}"> 
                                <div class="section">
                                <div class="section-body">
                                <div class="form-group">
                                    <label class="col-md-3 control-label">OneSignal App ID :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="onesignal_app_id" id="onesignal_app_id" value="{{$SettingsData->onesignal_app_id}}" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">OneSignal Rest Key :-</label>
                                    <div class="col-md-6">
                                        <input type="text" name="onesignal_rest_key" id="onesignal_rest_key" value="{{$SettingsData->onesignal_rest_key}}" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Server Key :-</label>
                                    <div class="col-md-6">
                                    
                                    <textarea name="firebase_server_key" id="firebase_server_key"  rows="3" cols="4" class="form-control">{{$SettingsData->firebase_server_key}}</textarea>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">2 Factor API Key :-</label>
                                    <div class="col-md-6">
                                        <input type="text" name="factor_apikey" id="factor_apikey" value="{{$SettingsData->factor_apikey}}" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">2 Factor Option :-<br /> ( This button option will show in live or not 2 Factor ) </label>
                                    <div class="col-md-6">
                                        <input type="checkbox" id="chk_factor_update" name="app_update_factor_button" value="1" {{ $SettingsData->app_update_factor_button == 1 ? 'checked' : null }} class="cbx hidden">
                                            <label for="chk_factor_update" class="lbl" style="left:13px;"></label>
                                    </div>
                                </div>                                                           
                                <div class="form-group">
                                <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="notification_submit" class="btn btn-primary">Save</button>
                                </div>
                                </div>
                                </div>
                                </div>
                            </form>
                        </div>  
                        <div  class="tab-pane fade" id="delivery_settings">   
                            <form action="{{route('setting.savegeneral')}}" name="delivery_settings" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}">
                            <div class="section">
                                <div class="section-body">                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Agent Onboard Commission :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="agent_onboard_commission" id="agent_onboard_commission" value="{{$SettingsData->agent_onboard_commission}}" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Agent Approve Commission :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="agent_approve_commission" id="agent_approve_commission" value="{{$SettingsData->agent_approve_commission}}" class="form-control">
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Reffer Earn Amount :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="reffer_earn_amount" id="reffer_earn_amount" value="{{$SettingsData->reffer_earn_amount}}" class="form-control">
                                    </div>
                                </div> 
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Radius :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="radius" id="radius" value="{{$SettingsData->radius}}" class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Minimum Amount for Add in wallet :-</label>
                                    <div class="col-md-6">
                                    <input type="text" name="add_min_wallet_amount" id="add_min_wallet_amount" value="{{$SettingsData->add_min_wallet_amount}}" class="form-control">
                                    </div>
                                </div>                         
                                
                                <div class="form-group">
                                    <div class="col-md-9 col-md-offset-3">
                                    <button type="submit" name="delivery_settings" class="btn btn-primary">Save</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            </form>
                        </div>
                        <div  class="tab-pane fade" id="payment_settings">
                            <form action="{{route('setting.savegeneral')}}" name="payment_settings" method="post" class="form form-horizontal" enctype="multipart/form-data" >
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}">
                                <div class="section">
                                    <div class="section-body">                            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Razorpay Key :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="razorpay_key" id="razorpay_key" value="{{$SettingsData->razorpay_key}}" class="form-control">
                                            </div>
                                        </div>                                                  
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Map Key :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="map_api_key" id="map_api_key" value="{{$SettingsData->map_api_key}}" class="form-control">
                                            </div>
                                        </div>                               
                                        <div class="form-group">
                                            <div class="col-md-9 col-md-offset-3">
                                                <button type="submit" name="payment_settings" class="btn btn-primary">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>          
                        <div  class="tab-pane fade" id="banking_settings">   
                            <form action="{{route('setting.savegeneral')}}" name="settings_banking_form" method="post" class="form form-horizontal" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="id" value="{{$SettingsData->setting_id}}">
                                <div class="section">
                                    <div class="section-body">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Address :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="app_address" id="app_address" value="{{$SettingsData->app_address}}" class="form-control">
                                            </div>
                                        </div>                                    
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">GSTIN :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="app_gstin" id="app_gstin" value="{{$SettingsData->app_gstin}}" class="form-control">
                                            </div>
                                        </div>                                
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">PAN No :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="app_pan" id="app_pan" value="{{$SettingsData->app_pan}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Bank Name :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="app_bank_name" id="app_bank_name" value="{{$SettingsData->app_bank_name}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Bank Account No :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="app_acount_no" id="app_acount_no" value="{{$SettingsData->app_acount_no}}" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">IFSC Code :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="app_ifsc" id="app_ifsc" value="{{$SettingsData->app_ifsc}}" class="form-control">
                                            </div>
                                        </div>                                
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Branch Name :-</label>
                                            <div class="col-md-6">
                                            <input type="text" name="app_branch" id="app_branch" value="{{$SettingsData->app_branch}}" class="form-control">
                                            </div>
                                        </div>                            
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">App Upi Image :- <p class="control-label-help">(Recommended resolution: 200x200 Image)</p></label>
                                            <div class="col-md-6">
                                                <div class="fileupload_block">
                                                    <input type="file" name="app_upi_image" id="fileupload">
                                                    @if($SettingsData->app_upi_image !='')
                                        @php
                                        $url = url('public/images/app/app_upi_image/' . $SettingsData->app_upi_image)
                                        @endphp
                            <div class="fileupload_img"><img type="image" src="{{$url}}"  /></div>
                            @else
                            <div class="fileupload_img"><img type="image" src="{{config('global.no_image.app_upi_image')}}"   /></div>
                            @endif
                            <!-- src="{{config('global.no_image.add_image')}}"  -->
                            <input id="app_upi_image" type="hidden" name="app_upi_image_edit"  value="{{$SettingsData->app_upi_image ?  $SettingsData->app_upi_image:''}}">
                            <input id="app_logo" type="hidden" name="app_logo_edit"  value="{{$SettingsData->app_logo ?  $SettingsData->app_logo:''}}">
                                                </div>
                                            </div>
                                        </div>                                
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Notes Description :-</label>
                                            <div class="col-md-6">                                
                                            <textarea name="app_notes_desc" id="app_notes_desc" class="form-control">{{$SettingsData->app_notes_desc}}</textarea>
                                            <script src="https://cdn.ckeditor.com/4.5.6/standard/ckeditor.js"></script> 
                                            <script>CKEDITOR.replace( 'app_notes_desc' );</script>
                                            </div>
                                        </div>
                                        <div class="form-group">&nbsp;</div>
                                        <div class="form-group">
                                            <div class="col-md-9 col-md-offset-3">
                                            <button type="submit" name="banking_submit" class="btn btn-primary">Save</button>
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
<script type="text/javascript">

</script>
@endsection