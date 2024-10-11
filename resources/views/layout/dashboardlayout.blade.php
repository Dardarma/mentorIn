@extends('layout.layout')
@section('layout')

  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{asset('storage/mentorIn_property/logo.png')}}" alt="AdminLTELogo" height="100px" width="auto">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{url('/dashboard')}}" class="nav-link">Home</a>
      </li>
    </ul>

    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <button type="button" class="btn btn-danger">Logout</button>
      </li>
    </ul>
  </nav>


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
      <img src="{{asset ('storage/mentorIn_property/logo.png')}}" alt="AdminLTE Logo" class="brand-image mx-1 mt-3" style="height:80px">

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{url('/dashboard')}}" class="nav-link {{request()->is('dashboard') ? 'active' : ''}}">
              <i class="fa-solid fa-house"></i>
              <p>
                Home
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/kalender')}}" class="nav-link  {{request()->is('kalender') ? 'active' : ''}}">
              <i class="fa-solid fa-calendar-days"></i>
              <p>
                Kalender
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/mentoring/list')}}" class="nav-link {{request()->is('mentoring/*')? 'active' : ''}}">
              <i class="fa-solid fa-list"></i>
              <p>
               List Mentoring
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="{{url('/admin/user/list')}}" class="nav-link {{request()->is('admin/*') ? 'active' : ''}} ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Admin Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/admin/user/list')}}" class="nav-link {{request()->is('admin/user/*')? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/role/list')}}" class="nav-link {{request()->is('admin/role/*')? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Role</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/permision/list')}}" class="nav-link {{request()->is('admin/permision/*')? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Permision</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/menu/list')}}" class="nav-link {{request()->is('admin/menu/*')? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Master</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('/admin/periode-magang/list')}}" class="nav-link {{request()->is('admin/periodeMagang/*')? 'active' : ''}}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Periode Magang</p>
                </a>
              </li>
            </ul>
          </li>
         

          
        </ul>
      </nav>
    </div>
  </aside>

  <div class="content-wrapper">
    @yield('content')
  </div>
  @endsection