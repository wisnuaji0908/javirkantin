<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-lightblue elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="{{ asset("image/logossss.png") }}"  class="img-circle elevation-2" width="40px">
        <span class="brand-text font-weight-light">Kantin Virtual</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-1 mb-3 d-flex">
            <div class="image mt-1">
                <img src="{{ asset('dist/img/default.png')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                @if (auth()->user())
                    <a href="#">{{ auth()->user()->name }}</a>
                    <p class="text-muted text-capitalize">{{ auth()->user()->role }}</p>
                @endif
            </div>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2 pb-3">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="true">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link {{ Request::is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
		        @if(auth()->user()->role=='admin')
                <!-- Left bar khusus penjual -->
                    {{-- Tabel --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('table*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Tabel
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/table/profile" class="nav-link {{ Request::is('table/profile*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Profile</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="/table/barang" class="nav-link {{ Request::is('table/barang*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Barang</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    {{-- Transaksi --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link {{ Request::is('transaction*') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-th"></i>
                            <p>Transaksi<i class="fas fa-angle-left right"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/transaction/order" class="nav-link {{ Request::is('transaction/order*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Order</p>
                                </a>
                            </li>
                            <!-- <li class="nav-item">
                                <a href="/transaction/checkout" class="nav-link {{ Request::is('transaction/checkout*') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Checkout</p>
                                </a>
                            </li> -->
                        </ul>

                    </li>

                    @endif

                <!-- left bar khusus pembeli -->
                @if (auth()->user()->role=='member')           
                <li class="nav-item">
                    <a href="/order" class="nav-link {{ Request::is('order*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>Order</p>
                    </a>
                </li>
                {{-- 
                <li class="nav-item">
                    <a href="/wishlist" class="nav-link {{ Request::is('wishlist*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-bookmark"></i>
                        <p>Wishlist</p>
                    </a>
                </li> --}}
                @endif
            </ul>
        </nav>

    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
