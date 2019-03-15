<header class="main-header">
    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SPM</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SPM</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
      @if(Auth::check())
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs">{{Auth::user()->name}}</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">


                <p>
                  {{Auth::user()->name }} - {{Auth::user()->role}}
                  <small>{{Auth::user()->status == 1 ? 'Active User' : 'Inactive User'}}</small>
                </p>
              </li>
              <!-- Menu Body -->
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="{{route('user.change', Auth::user()->id )}}" class="btn btn-default btn-flat">Change Password</a>
                </div>
                <div class="pull-right">
                 <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                              
                </div>
              </li>
            </ul>
          </li>
          @else

          @endif
        </ul>
      </div>
    </nav>
  </header>
  @if(Auth::check())
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Menu</li>
        @if(Auth::user()->role == 'Admin')
        <li class="treeview">
          <a href="#">
            <span>Project</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{route('project.index')}}"><i class="fa fa-circle-o"></i> Show Project</a></li>
            <li><a href="{{route('project.create')}}"><i class="fa fa-circle-o"></i> Create Project</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <span>User</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('user.index')}}"><i class="fa fa-circle-o"></i>User Index</a></li>
            <li><a href="{{route('user.create')}}"><i class="fa fa-circle-o"></i> Create User</a></li>
            
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
           
            <span>Daily Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('daily.index')}}"><i class="fa fa-circle-o"></i>Report</a></li>
            <li><a href="{{route('daily.create')}}"><i class="fa fa-circle-o"></i> Create Report</a></li>
          </ul>
        </li>
        @else 
        <li class="treeview">
          <a href="#">
            <span>Project</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="active"><a href="{{route('project.index')}}"><i class="fa fa-circle-o"></i> Show Project</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
           
            <span>Daily Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{route('daily.index')}}"><i class="fa fa-circle-o"></i>Report</a></li>
            <li><a href="{{route('daily.create')}}"><i class="fa fa-circle-o"></i> Create Report</a></li>
          </ul>
        </li>
        @endif
      </ul>
    
    </section>
    <!-- /.sidebar -->
  </aside>
  @else
<p></p>
@endif