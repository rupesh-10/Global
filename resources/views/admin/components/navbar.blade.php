
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark bg-dark" id="sidenav-main">
  <div class="container-fluid">
      <a class="navbar-brand d-flex" href="#">
          <i class="ni ni-world text-danger mr-2" style="font-size:25px;"></i>
          <strong> Global Suppliers</strong>
      </a>
    
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
      aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collapse -->
    <div class="navbar-collapse collapse" id="sidenav-collapse-main" style="">
      <!-- Collapse header -->
      <div class="navbar-collapse-header d-md-none">
        <div class="row">
          <div class="col-md-12 collapse-close ">
            <button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
              data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
              aria-label="Toggle sidenav">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <li class="nav-item text-center" style="list-style:none;">
          <i class="ni ni-single-02 p-3 text-orange" style="font-size:25px; border:1px solid red; border-radius:50%;"></i>
          <a class="nav-link pr-0 text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="mb-0 text-md  font-weight-bold">{{ auth()->user()->name }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow col-md-3 ml-2" style="position:relative;">
            <a href="/admin/edit" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Edit Profile</span>
            </a>
            <a href="/admin/password" class="dropdown-item">
              <i class="ni ni-single-02"></i>
              <span>Change Password</span>
            </a>
           
        </div>
      </li>
      <!-- Navigation -->
      <ul class="navbar-nav pt-4 ml-2">
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="/admin/dashboard">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/order') ? 'active' : '' }}">
          <a class="nav-link " href="/admin/order">
            <i class="ni ni-bag-17 text-blue"></i> Orders
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/delivery') ? 'active' : '' }}">
          <a class="nav-link " href="/admin/delivery">
            <i class="ni ni-pin-3 text-orange"></i> Delivery
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/sales') ? 'active' : '' }}">
          <a class="nav-link " href="/admin/sales">
            <i class="ni ni-bullet-list-67 text-red"></i> Sales
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/transaction') ? 'active' : '' }}">
          <a class="nav-link " href="/admin/transaction">
            <i class="ni ni-single-02 text-yellow"></i> Transactions
          </a>
        </li>
        <li class="nav-item  {{ Request::is('admin/item') ? 'active' : '' }}">
          <a class="nav-link " href="/admin/item">
            <i class="ni ni-basket text-blue"></i>Items
          </a>
        </li>
        <li class="nav-item {{ Request::is(['admin', 'admin/medium']) ? 'active' : '' }}">
          <a class="nav-link " href="/admin/medium">
            <i class="fa fa-truck text-red"></i> Mediums
          </a>
        </li>
        <li class="nav-item {{ Request::is(['admin', 'admin/places']) ? 'active' : '' }}">
          <a class="nav-link " href="/admin/places">
            <i class="ni ni-pin-3 text-green"></i> Places
          </a>
        </li>
    
      </ul>
      <div class="pt-4 d-flex text-danger">
      &copy; <a href="https://www.alphatech.com.np" class="pl-2 ">Alpha Tech</a>
      </div>
      <!-- Divider -->
    </div>
  </div>
</nav>