<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item">
      <div class="d-flex sidebar-profile">
        <div class="sidebar-profile-image">
          <img src="{{asset('themes/template/images/faces/face29.png')}}"" alt="image">
          <span class="sidebar-status-indicator"></span>
        </div>
        <div class="sidebar-profile-name">
          <p class="sidebar-name">
            admin
          </p>
          <p class="sidebar-designation">
            Welcome
          </p>
        </div>
      </div>
      <!-- <div class="nav-search">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Type to search..." aria-label="search" aria-describedby="search">
          <div class="input-group-append">
            <span class="input-group-text" id="search">
              <i class="typcn typcn-zoom"></i>
            </span>
          </div>
        </div>
      </div> -->
      <!-- <p class="sidebar-menu-title">Dash menu</p> -->
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('home')}}">
        <i class="typcn typcn-device-desktop menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('users')}}">
        <i class="typcn typcn-device-desktop menu-icon"></i>
        <span class="menu-title">User</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
        <i class="typcn typcn-briefcase menu-icon"></i>
        <span class="menu-title">Application</span>
        <i class="typcn typcn-chevron-right menu-arrow"></i>
      </a>
      <div class="collapse" id="ui-basic">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"> <a class="nav-link" href="{{url('add_applicant')}}">Add</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{ url('show_applicant') }}">View</a></li>

        </ul>
      </div>
    </li>

  </ul>
</nav>