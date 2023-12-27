<div class="loader"></div>
<!-- <div class="app app-default"> -->
<aside class="app-sidebar" id="sidebar">
    <div class="sidebar-header"> 
      <a class="sidebar-brand" href="{{url('admin/dashboard')}}">
      <img src="{{Helper::AppLogoImage()}}"  class="gambar img-responsive img-thumbnail" id="item-img-output" name="item-img-output" >
      </a>
      <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
    </div>
    <div class="sidebar-menu">
      <ul class="sidebar-nav">

  
        <li class="{{ Request::segment(2) == 'home' ? 'active' : '' }}">
            <a href="{{ url('admin', 'home') }}">
                <div class="icon"> <i class="fa fa-dashboard" aria-hidden="true"></i> </div>
                <div class="title">Dashboard</div>
            </a>
        </li>

        <li class="{{ Request::segment(2) == 'user' ? 'active' : '' }}">
            <a href="{{ url('admin', 'user') }}">
                <div class="icon"> <i class="fa fa-user" aria-hidden="true"></i> </div>
                <div class="title">Users</div>
            </a>
        </li>

        <li class="dropdown-li vendor {{ Request::segment(2) == 'vendor' ? 'active' : '' }} section">

          <a href="javascript:void(0)" class="dropdown-a">
            <div class="icon"> <i class="fa fa-users" aria-hidden="true"></i> </div>
            <div class="title">Vendor</div>
            <i class="fa fa-angle-right pull-right" style="padding-top: 7px;color: #fff;"></i>
          </a> 
        </li>
        
        <li class="cust-dropdown-container">
          <ul class="cust-dropdown">
          
            <li>
              <a href="{{ url('admin','vendor')}}" class="{{ Request::segment(2) == 'vendor'? 'active':'' }}">
                <div class="title"><i class="fa fa-file-o"></i>&nbsp;&nbsp;Vendor</div>
              </a> 
            </li>
          </ul>
        </li>

        <li class="dropdown-li setting {{ Request::segment(2) == 'generalsetting' || Request::segment(2) == 'setting' ? 'active' : '' }} section">

          <a href="javascript:void(0)" class="dropdown-a">
            <div class="icon"> <i class="fa fa-cogs" aria-hidden="true"></i> </div>
            <div class="title">Settings</div>
            <i class="fa fa-angle-right pull-right" style="padding-top: 7px;color: #fff;"></i>
          </a> 
        </li>
        
        <li class="cust-dropdown-container">
          <ul class="cust-dropdown">
          <li>
              <a href="{{ url('admin','generalsetting')}}" class="{{ Request::segment(2) == 'generalsetting'? 'active':'' }}">
                <div class="title"><i class="fa fa-gear"></i>&nbsp;&nbsp;General Settings</div>
              </a> 
            </li>

            <li>
              <a href="{{ url('admin','setting')}}" class="{{ Request::segment(2) == 'setting'? 'active':'' }}">
                <div class="title"><i class="fa fa-file-o"></i>&nbsp;&nbsp;Page Settings</div>
              </a> 
            </li>
                    
          </ul>
        </li>
      </ul>
    </div>
     
  </aside>   
<!-- </div> -->

<script>
  // Check if the dropdown item has the 'active' class
  if ($(".dropdown-li").hasClass("active")) {
    var activeSegment = '<?php echo Request::segment(2); ?>';

    // Check if the active segment is 'generalsetting'
    if (activeSegment == 'generalsetting') {
      // Open the Settings dropdown container
      $(".setting").next(".cust-dropdown-container").slideDown();
      
      // Add the 'active' class to the generalsetting link
      $(".generalsetting").addClass("active");

      // Update the angle icon to 'fa-angle-down'
      $(".generalsetting").find(".title").next("i").removeClass("fa-angle-right");
      $(".generalsetting").find(".title").next("i").addClass("fa-angle-down");

      // Close the Vendor dropdown container
      $(".vendor").next(".cust-dropdown-container").slideUp();
      
      // Remove the 'active' class from the vendor link
      $(".vendor").removeClass("active");

      // Update the angle icon to 'fa-angle-right'
      $(".vendor").find(".title").next("i").removeClass("fa-angle-down");
      $(".vendor").find(".title").next("i").addClass("fa-angle-right");
    }
  }
</script>

