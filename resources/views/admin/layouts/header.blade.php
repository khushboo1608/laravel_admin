<div class="app-container">
    <nav class="navbar navbar-default" id="navbar">
      <div class="container-fluid">
        <div class="navbar-collapse collapse in">
          <ul class="nav navbar-nav navbar-mobile">
            <li>
              <button type="button" class="sidebar-toggle"> <i class="fa fa-bars"></i> </button>
            </li>
            <li class="logo"> <a class="navbar-brand" href="#">{{Helper::AppName()}}</a> </li>
            <li>
              <button type="button" class="navbar-toggle">
              <img style="height: 50px;width: 50px;" alt="image" class="rounded-circle" src="{{Helper::LoggedUserImage()}}"/>               
                  
              </button>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
            <li class="navbar-title"> {{Helper::AppName()}} </li>
             
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile"> 
              <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">
              <img style="height: 50px;width: 50px;" alt="image" class="profile-img" src="{{Helper::LoggedUserImage()}}"/>   

              <!-- <img style="height: 50px;width: 50px;" alt="image" class="profile-img" src="http://localhost/adminDemo/admin_assets/images/profile.png"/>   -->
          
              
                <div class="title">Profile</div>
              </a>
              <div class="dropdown-menu">
                <div class="profile-info">
                  <h4 class="username">Admin</h4>
                </div>
                <ul class="action">
                  <li><a href="{{url('admin/profile')}}">Profile</a></li>                  
                  <li><a href="{{url('admin/logout')}}">Logout</a></li>
                </ul>
              </div>
              
            </li>
          </ul>
        </div>
      </div>
    </nav>
    
  <!-- </div> -->