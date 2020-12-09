<!-- Main Header -->
<header class="main-header">

  <!-- Logo -->
  <a href="{{url('/')}}" class="logo"><b>SWA</b> Admin Panel</a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
   
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
       
        <!-- User Account Menu -->
       
        <li class="user user-menu">
          <a href="{{ route('logout') }}"><i class="fa fa-power-off text-red"></i><span> Logout</span></a>
        </li>
      </ul>
    </div>
  </nav>
</header>