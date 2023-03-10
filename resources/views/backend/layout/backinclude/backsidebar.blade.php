<div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-paw"></i> <span>Gentelella Alela!</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{asset('backend/images/img.jpg')}}" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>John Doe</h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <h3>General</h3>
                <ul class="nav side-menu">
                  <li class="nav-item {{ request()->is('module')? 'active' : '' }}">
                      <a href="{{ route('admin.modules.index') }}"> 
                          <span>Module</span>
                      </a>
                      </li>
                      <li>
                            <a href="{{ route('admin.role_permission.show') }}"> <span>Roles And Permissions</span></a>
                        </li>
                        <li class="nav-item {{ request()->is('assign-user-permission')? 'active' : '' }}">
                          <a href="{{ route('admin.assign-user-permission') }}">
                           <span>Users And Permissions</span>
                          </a>
                      </li>
                  {{--@if(auth()->user()->hasAnyPermission('Module','Roles And Permissions','Users And Permissions'))
                  <li><a><i class="fa fa-home"></i> Setting <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      @canany(['Module', 'Roles And Permissions', 'Users And Permissions'])
                      @can('Module')
                      <li class="nav-item {{ request()->is('module')? 'active' : '' }}">
                      <a href="{{ route('modules.index') }}"> 
                          <span>Module</span>
                      </a>
                      </li>
                      @endcan
                      @can('Roles And Permissions')
                        <li>
                            <a href="{{ route('role_permission.show') }}"> <span>Roles And Permissions</span></a>
                        </li>
                      @endcan
                      @can('Users And Permissions')
                      <li class="nav-item {{ request()->is('assign-user-permission')? 'active' : '' }}">
                          <a href="{{ route('assign-user-permission') }}">
                           <span>Users And Permissions</span>
                          </a>
                      </li>
                    @endcan
                      @endcanany
                    </ul>
                  </li>
                  @endif--}}
                </ul>
              </div>
              

            </div>
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="{{url('admin/logout')}}">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>