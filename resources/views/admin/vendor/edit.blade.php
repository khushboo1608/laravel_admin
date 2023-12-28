@extends('admin.layouts.app')
@section('content')
@include('admin.layouts.sidebar')
@include('admin.layouts.header')

<div class="row">
    <div class="col-md-12">
        <div class="card">
          <div class="page_title_block">
            <div class="col-md-5 col-xs-12">
              <div class="page_title">Edit Vendor List </div>
            </div>
            <div class="col-md-7 col-xs-12">
              <div class="search_list">
                  <button type="button" onclick="javascript:window.location='{{url('admin/vendor')}}';" class="btn btn-primary waves-effect waves-light"><i class="fa fa-arrow-left"></i>&nbsp;&nbsp;Back</button>
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
          <div class="card-body mrg_bottom"> 
            <form action="{{route('vendor.savevendor')}}" name="addedituser" method="post" class="form form-horizontal" enctype="multipart/form-data" >
                @csrf
            	<input  type="hidden" name="vendor_id" id="vendor_id" value="{{$VendorData->vendor_id}}" />

                  
              <div class="section">
                <div class="section-body">
                  <div class="form-group">
                    <label class="col-md-3 control-label"> Name :-</label>
                    <div class="col-md-6">
                      <input type="text" name="vendor_name" id="vendor_name" value="{{$VendorData->vendor_name}}" class="form-control" >
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-md-3 control-label"> Description :-</label>
                    <div class="col-md-6">
                      <textarea name="vendor_desc" id="vendor_desc"  rows="5"  class="form-control">{{$VendorData->vendor_desc}}</textarea>
                    </div>
                  </div>
         
                  <div class="form-group">
                    <label class="col-md-3 control-label">Select Image :-
                    <p class="control-label-help">(Recommended resolution: 696x300 Image)</p>
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="vendor_icon"  accept="image/png, image/jpeg, image/jpg" value="fileupload" id="fileupload">
                            <?php 
                            if(!empty($VendorData->vendor_icon) )
                            {
                              $vendor_icon_url = $VendorData->vendor_icon;
                            }else{
                              $vendor_icon_url = config('global.no_image.no_image');
                            }
                            ?>
                            <div class="fileupload_img"><img type="image" src="{{$vendor_icon_url}}" alt="category image" /></div>
                      </div>
                    </div>
                  </div>
                
                  <div class="form-group">
                    <label class="col-md-3 control-label">Banner Image :-
                    <p class="control-label-help">(Recommended resolution: 696x300 Image)</p>
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="vendor_banner" accept="image/png, image/jpeg, image/jpg" value="fileupload" id="fileupload">
                        <?php 
                            if(!empty($VendorData->vendor_banner) )
                            {
                              $vendor_banner_url = $VendorData->vendor_banner;
                            }else{
                              $vendor_banner_url = config('global.no_image.no_image');
                            }?>

                            <div class="fileupload_img"><img type="image" src="{{$vendor_banner_url}}" alt="category image" /></div>
                           
                      </div>
                    </div>
                  </div>
                  
                 <div class="form-group">
                    <label class="col-md-3 control-label">Phone No :-</label>
                    <div class="col-md-6">
                      <input type="number"  onKeyPress="if(this.value.length==10) return false;" name="vendor_phone" id="vendor_phone" value="{{$VendorData->vendor_phone}}" class="form-control">
                    </div>
                  </div>
                  
                   <div class="form-group">
                    <label class="col-md-3 control-label">Email :-</label>
                    <div class="col-md-6">
                      <input type="email" name="vendor_email" id="vendor_email" value="{{$VendorData->vendor_email}}" class="form-control" >
                    </div>
                  </div>    
                           <div class="form-group">
                    <label class="col-md-3 control-label">Password :- </label>
                    <div class="col-md-6">
                      <input type="password" name="vendor_password" id="vendor_password" value="" class="form-control" >
                    </div>
                  </div>        
                
                        
                  <div class="form-group">
                    <label class="col-md-3 control-label">Select Mutiple Image :-
                      <p class="control-label-help">(Recommended resolution: 696x300 Image)</p>
                    </label>
                    <div class="col-md-6">
                      <div class="fileupload_block">
                        <input type="file" name="vendor_gallery[]" value="fileupload" id="fileupload" multiple>
                            
                            <div class="fileupload_img"><img type="image" src="{{config('global.no_image.add_image')}}" alt="category image" /></div>
                           
                      </div>
                    </div>
                  </div>
                  <br>
                    <div class="form-group">
                      <?php 
                      $vendor_gallery = [];
                      $url=route("admin.vendor");
                      // echo $VendorData->vendor_gallery;
                      // exit;
                      ?>
                      @if(isset($VendorData) && isset($VendorData->vendor_gallery))
                        @if($VendorData->vendor_gallery !='')
                          @foreach ($VendorData->vendor_gallery as $item)
                          <?php //dd($item); ?>
                          <?php //echo $item;  ?>
                            <div class="col-md-2">
                            <div class="fileupload_block">
                              <div class="fileupload_img">
                                <img type="image" src="{{$item}}" alt="Vendor Gallery image" />
                                <a href="{{$item}}" target="_blank" ><b> View </b></a> 
                                @if($item !='')
                                @php 
                                  $img_id = explode('vendor_img', $item); 
                                 
                                  $gallery_img = $img_id[1];
                                  @endphp
                                  <a href="{{$url}}/delete_img/{{$VendorData->vendor_id}}/{{$gallery_img}}" style="margin-left: 20px;"><b> Delete </b></a>
                                @endif
                              </div>                          
                            </div>
                            </div> 
                           
                            @endforeach
                            <?php //exit; ?>
                        @endif
                      @endif
                     
                     
                    </div>
                    @if(isset($VendorData) && isset($VendorData->vendor_gallery))
                        @if(is_array($VendorData->vendor_gallery))
                            {{-- Convert the array to a string --}}
                            <?php  $galleryValue = implode(',', $VendorData->vendor_gallery); ?>
                            <input id="vendor_gallery_edit1" type="hidden" name="vendor_gallery_edit1" value="{{ htmlspecialchars($galleryValue) }}">
                        @else
                            <input id="vendor_gallery_edit" type="hidden" name="vendor_gallery_edit" value="{{ htmlspecialchars($VendorData->vendor_gallery) }}">
                        @endif
                    @endif
                    <br>                   
                    </div>
                  <!-- Search input -->
                  <input id="searchInput" class="controls" type="text" placeholder="Enter a location">

                  <!-- Google map -->
                  <div id="map"></div>

                  <ul class="geo-data">
                  <!--    <li>Full Address: <span id="location"></span></li>
                      <li>Postal Code: <span id="postal_code"></span></li>
                      <li>Country: <span id="country"></span></li>
                      <li>Latitude: <span id="lat"></span></li>
                      <li>Longitude: <span id="lon"></span></li>-->
                  </ul>
                                   
                  <div class="form-group">
                    <label class="col-md-3 control-label">Address :-</label>
                    <div class="col-md-6">
                      <input type="text"  name="vendor_adderss" id="address" value="{{$VendorData->vendor_adderss}}" class="form-control" >
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label class="col-md-3 control-label">Postal_Code :-</label>
                    <div class="col-md-6">
                      <input type="text"  name="vendor_postal_code" id="postal_code" value="{{$VendorData->vendor_postal_code}}" class="form-control" >
                    </div>
                  </div>
                   
                  <div class="form-group">
                    <label class="col-md-3 control-label">Lattitude :-</label>
                    <div class="col-md-6">
                      <input type="text"  name="vendor_lat" id="lattitude" value="{{$VendorData->vendor_lat}}" class="form-control" >
                    </div>
                  </div>
                  
                     
                  <div class="form-group">
                    <label class="col-md-3 control-label">Longitude :-</label>
                    <div class="col-md-6">
                      <input type="text"  name="vendor_long" id="longitude" value="{{$VendorData->vendor_long}}" class="form-control" >
                    </div>
                  </div>
                  
                              
                   <div class="form-group">
                    <label class="col-md-3 control-label">Distance(Radius cover for Delievry for this Vendor) :-</label>
                    <div class="col-md-6">
                      <input type="text"   name="vendor_distance" id="vendor_distance" value="{{$VendorData->vendor_distance}}" class="form-control">
                    </div>
                  </div>
                 
                  
                  <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                      <button type="submit" name="submit" class="btn btn-primary">Save</button>
                      <a class="btn btn-danger" href="{{url('admin/vendor')}}">Cancel</a>
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

<style>
#map {
    width: 100%;
    height: 400px;
}

input#searchInput

{
  z-index: 0;
  position: absolute;
  left: 230px;
  top: 10px !important;
  width: 250px;
  padding: 12px;
}

</style>
@section('scripts')
<script>
function initMap() {
    
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -33.8688, lng: 151.2195},
      zoom: 13
    });
    
    var input = document.getElementById('searchInput');
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.bindTo('bounds', map);

    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29)
    });

    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(true);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
  
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
      
        //Location details
        for (var i = 0; i < place.address_components.length; i++) {
            if(place.address_components[i].types[0] == 'postal_code'){
                document.getElementById('postal_code').value = place.address_components[i].long_name;
            }
            if(place.address_components[i].types[0] == 'city'){
                document.getElementById('city').value = place.address_components[i].long_name;
            }
        }
        console.log(place.address_components);
        document.getElementById('address').value = place.formatted_address;
        document.getElementById('lattitude').value = place.geometry.location.lat();
        document.getElementById('longitude').value = place.geometry.location.lng();
    });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key={{Helper::AppMapKey()}}&libraries=places&callback=initMap" async defer></script>
@endsection