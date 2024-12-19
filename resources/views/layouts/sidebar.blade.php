  <!-- Brand Logo -->
  <a href="#" class="brand-link tengah">
    <span class="brand-text font-weight-light"><strong>Aplikasi </strong></span>
    <div class="kab">
      <span><b> SPK Mayora</b></span>
    </div>
    <div class="d-flex user-header">
      <img class="user-icon" src="{{ asset('adminLTE3/dist/img/user_icon.png')}}" />
      <div class="user-admin">
        <span>{{ Auth::user()->name }}</span>
      </div>
    </div>
    <div class="user-role">
      <span>{{ Auth::user()->role }}</span>
    </div>
  </a>

<section class="sidebar">
     <div class="user-panel mb-3 d-flex">
        <div class="image-digi">
          <img src="{{ asset('adminLTE3/dist/img/logo-mayora.png')}}" class="img-digi" style="height: 49px" alt="User Image">
        </div>
        
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dashboard">
            <a href="{{ url('/') }}" class="nav-link {{ Request::is('beranda') ? 'active' : '' }}">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @if(Auth::user()->role == 'admin')
          <li class="nav-header">MASTER DATA</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('user') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Data Admin Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('user') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Data User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('area*') || Request::is('area/add*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Data Area
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('area') }}" class="nav-link {{ Request::is('area') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('area/add') }}" class="nav-link {{ Request::is('area/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Area</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('mesin*') || Request::is('mesin/add*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-pallet"></i>
              <p>
                Data Mesin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('mesin') }}" class="nav-link {{ Request::is('mesin') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Mesin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('mesin/add') }}" class="nav-link {{ Request::is('mesin/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Mesin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('spk*') || Request::is('spk/add*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-pallet"></i>
              <p>
                Data SPK
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('spk') }}" class="nav-link {{ Request::is('spk') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List SPK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('spk/add') }}" class="nav-link {{ Request::is('spk/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah SPK</p>
                </a>
              </li>
            </ul>
          </li>
          
          @elseif(Auth::user()->role == 'staff')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('area*') || Request::is('area/add*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Data Area
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('area') }}" class="nav-link {{ Request::is('area') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('area/add') }}" class="nav-link {{ Request::is('area/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Area</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('mesin*') || Request::is('mesin/add*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-pallet"></i>
              <p>
                Data Mesin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('mesin') }}" class="nav-link {{ Request::is('mesin') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Mesin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('mesin/add') }}" class="nav-link {{ Request::is('mesin/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Mesin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('spk*') || Request::is('spk/add*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-pallet"></i>
              <p>
                Data SPK
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('spk') }}" class="nav-link {{ Request::is('spk') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List SPK</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('spk/add') }}" class="nav-link {{ Request::is('spk/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah SPK</p>
                </a>
              </li>
            </ul>
          </li>

          @elseif(Auth::user()->role == 'tehnik')
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('area*') || Request::is('area/add*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-list-alt"></i>
              <p>
                Data Area
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('area') }}" class="nav-link {{ Request::is('area') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('area/add') }}" class="nav-link {{ Request::is('area/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Area</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link {{ Request::is('mesin*') || Request::is('mesin/add*') ? 'active' : '' }}">
              <i class="nav-icon fas fa-pallet"></i>
              <p>
                Data Mesin
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('mesin') }}" class="nav-link {{ Request::is('mesin') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Mesin</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('mesin/add') }}" class="nav-link {{ Request::is('mesin/add') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tambah Mesin</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('pengajuan-spk') }}" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Pengajuan SPK
              </p>
            </a>
          </li>

             
              @endif
              <li class="nav-header">USER PROFIL</li>
              <li class="nav-item">
                <a href="{{ url('profil') }}" class="nav-link">
                  <i class="nav-icon fas fa-user"></i>
                  <p>
                    Data Profil
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('password') }}" class="nav-link">
                  <i class="nav-icon fas fa-key"></i>
                  <p>
                    Ubah Password
                  </p>
                </a>
              </li>
              <li><a href="{{ url('/logout') }}"><i class="fas fa-fw fa-sign-out-alt"></i> Logout</span></a></li>
            </ul>
          </nav>
        </section>