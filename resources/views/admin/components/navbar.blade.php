<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-dark bg-dark" id="sidenav-main">
  <div class="container-fluid">
    <!-- Toggler -->
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
      aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Brand -->
    <a class="navbar-brand pt-0 mr-5" href="./index.html">
      <i class="fa fa-globe text-primary" style="font-size:80px;"></i>
    </a>
    <!-- Collapse -->
    <div class="navbar-collapse collapse" id="sidenav-collapse-main" style="">
      <!-- Collapse header -->
      <div class="navbar-collapse-header d-md-none">
        <div class="row">
          <div class="col-6 collapse-brand">
            <a href="./index.html">
              <img src="./assets/img/brand/blue.png">
            </a>
          </div>
          <div class="col-6 collapse-close">
            <button type="button" class="navbar-toggler collapsed" data-toggle="collapse"
              data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
              aria-label="Toggle sidenav">
              <span></span>
              <span></span>
            </button>
          </div>
        </div>
      </div>
      <!-- Form -->
      <form class="mt-4 mb-3 d-md-none">
        <div class="input-group input-group-rounded input-group-merge">
          <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search"
            aria-label="Search">
          <div class="input-group-prepend">
            <div class="input-group-text">
              <span class="fa fa-search"></span>
            </div>
          </div>
        </div>
      </form>
      <!-- Navigation -->
      <ul class="navbar-nav">
        <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
          <a class="nav-link" href="dashboard">
            <i class="ni ni-tv-2 text-primary"></i> Dashboard
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/order') ? 'active' : '' }}">
          <a class="nav-link " href="order">
            <i class="ni ni-bag-17 text-blue"></i> Orders
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/delivery') ? 'active' : '' }}">
          <a class="nav-link " href="delivery">
            <i class="ni ni-pin-3 text-orange"></i> Delivery
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/sales') ? 'active' : '' }}">
          <a class="nav-link " href="sales">
            <i class="ni ni-bullet-list-67 text-red"></i> Sales
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/reports') ? 'active' : '' }}">
          <a class="nav-link " href="reports">
            <i class="fa fa-clipboard text-yellow"></i> Reports/Accounts
          </a>
        </li>
        <li class="nav-item {{ Request::is('admin/transaction') ? 'active' : '' }}">
          <a class="nav-link " href="transaction">
            <i class="ni ni-single-02 text-yellow"></i> Transactions
          </a>
        </li>
        <li class="nav-item  {{ Request::is('admin/item') ? 'active' : '' }}">
          <a class="nav-link " href="item">
            <i class="ni ni-basket text-blue"></i>Items
          </a>
        </li>
        <li class="nav-item {{ Request::is(['admin', 'admin/medium']) ? 'active' : '' }}">
          <a class="nav-link " href="medium">
            <i class="fa fa-truck text-red"></i> Mediums
          </a>
        </li>
        <li class="nav-item {{ Request::is(['admin', 'admin/places']) ? 'active' : '' }}">
          <a class="nav-link " href="places">
            <i class="ni ni-pin-3 text-green"></i> Places
          </a>
        </li>
      </ul>
      <!-- Divider -->
    </div>
  </div>
</nav>