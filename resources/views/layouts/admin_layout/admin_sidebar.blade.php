  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
  <a href="{{route('admin.dashboard')}}" class="brand-link">
      <img src="{{asset('image/admin_image/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin | Dashboard</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('image/admin_image/admin_photos/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
          with font-awesome or any other icon font library -->
          @if(Session::get('page')=="dashboard")
           <?php $active = "active"; ?>
            @else
            <?php $active = ""; ?>
          @endif
          <li class="nav-item">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(Session::get('page')=="setting" || Session::get('page')=="updateAdminDetail")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}} ">
            <a href="#" class="nav-link {{$active}}">
              <i class="fas fa-cogs"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
                <span class="right badge badge-danger"></span>
              </p>
            </a>

            @if(Session::get('page')=="setting")
           <?php $active = "active"; ?>
            @else
            <?php $active = ""; ?>
            @endif
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.settings')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Password</p>
                </a>
              </li>
              @if(Session::get('page')=="updateAdminDetail")
              <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.update.admin.details')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>
            </ul>
          </li>
          @if(Session::get('page')=="section" || Session::get('page')=="brand" || Session::get('page')=="category" || Session::get('page')=="product" ||Session::get('page')=="coupon")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen="";
            ?>
           @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}}">
            <a href="#" class="nav-link {{$active}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Catalogues
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            @if(Session::get('page')=="section")
           <?php $active = "active"; ?>
            @else
            <?php $active = ""; ?>
           @endif
            <ul class="nav nav-treeview">
              <li class="nav-item ">
                <a href="{{route('admin.sections')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Section</p>
                </a>
              </li>
              @if(Session::get('page')=="brand")
              <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item ">
                <a href="{{route('admin.brand')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Brand</p>
                </a>
              </li>
              @if(Session::get('page')=="category")
              <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.categories')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>

                </a>
              </li>
              @if(Session::get('page')=="product")
              <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.products')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              @if(Session::get('page')=="coupon")
              <?php $active = "active"; ?>
                @else
                <?php $active = ""; ?>
              @endif
              <li class="nav-item">
                <a href="{{route('admin.coupons')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Coupons</p>
                </a>
              </li>
            </ul>
          </li>
          @if(Session::get('page')=="order")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}}">
            <a href="#" class="nav-link {{$active}} ">
              <i class="nav-icon ion ion-bag"></i>
              <p>
                Orders
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.view.orders')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Orders</p>
                </a>
              </li>
            </ul>
          </li>
          @if(Session::get('page')=="contact")
          <?php $active = "active";
          $menuOpen="menu-open"; ?>
           @else
           <?php $active = "";
           $menuOpen=""; ?>
         @endif
         <li class="nav-item has-treeview {{$menuOpen ??''}} ">
           <a href="#" class="nav-link {{$active}}">
           <i class="fa fa-phone" aria-hidden="true"></i>
             <p>
               Contact
               <i class="fas fa-angle-left right"></i>
               <span class="right badge badge-danger"></span>
             </p>
           </a>

           @if(Session::get('page')=="contact")
          <?php $active = "active"; ?>
           @else
           <?php $active = ""; ?>
           @endif
           <ul class="nav nav-treeview">
             <li class="nav-item">
               <a href="{{route('admin.contact')}}" class="nav-link {{$active}}">
                 <i class="far fa-circle nav-icon"></i>
                 <p>Conatact</p>
               </a>
             </li>
           </ul>
         </li>
          @if(Session::get('page')=="user")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}}">
            <a href="#" class="nav-link {{$active}} ">
              <i class="fa fa-user" aria-hidden="true"></i>
              <p>
                Users
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.view.users')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View User</p>
                </a>
              </li>
            </ul>
          </li>
        @if(Session::get('page')=="banner")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}}">
            <a href="#" class="nav-link {{$active}} ">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Banner
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.posts')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Banner</p>
                </a>
              </li>
            </ul>
        </li>
         <!-- @if(Session::get('page')=="cmspages")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          {{-- <li class="nav-item has-treeview {{$menuOpen ??''}}">
            <a href="#" class="nav-link {{$active}} ">
              <i class="nav-icon fas fa-book"></i>
              <p>
                CMS Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.view.cms.page')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View CMS Pages</p>
                </a>
              </li>
            </ul>
          </li> --}}-->
          @if(Session::get('page')=="newletter")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}}">
            <a href="#" class="nav-link {{$active}} ">
              <i class="nav-icon fas fa-book"></i>
              <p>
                NewLetter
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.view.newsletter.subscribers')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>View Newletter Pages</p>
                </a>
              </li>
            </ul>
          </li>
          @if(Session::get('page')=="user_chart" || Session::get('page')=="orders_chart")
           <?php $active = "active";
           $menuOpen="menu-open"; ?>
            @else
            <?php $active = "";
            $menuOpen=""; ?>
          @endif
          <li class="nav-item has-treeview {{$menuOpen ??''}}">
            <a href="#" class="nav-link {{$active}} ">
            <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Charts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            @if(Session::get('page')=="user_chart")
            <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
            @endif
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.user.chart')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users Charts</p>
                </a>
              </li>
            </ul>
            @if(Session::get('page')=="orders_chart")
            <?php $active = "active"; ?>
              @else
              <?php $active = ""; ?>
            @endif
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.orders.chart')}}" class="nav-link {{$active}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Orders Charts</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
