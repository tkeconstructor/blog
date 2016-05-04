      <div class="container">
        <div class="navbar-header">
         <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a href="/" class="navbar-brand">Quản trị viên</a>
      </div>
        <div id="navbar" class="navbar-collapse collapse">
          <!-- <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          
          </ul> -->
          <ul class="nav navbar-nav navbar-right">
            @if (Auth::guard('admins')->check())
         <!-- <li>
            <a href="#">Prototype</a>
         </li> -->
         <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::guard('admins')->user()->name }} <b class="caret"></b></a>
            <ul class="dropdown-menu">
               <li>
                  <a href="#"><i class="fa fa-fw fa-user"></i>Profile</a>
               </li>
               <li>
                  <a href="#"><i class="fa fa-fw fa-envelope"></i> Inbox</a>
               </li>
               <li>
                  <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
               </li>
               <li class="divider"></li>
               <li>
                  <a href="{{ url('admin/logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
               </li>
            </ul>
         </li>
         @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
