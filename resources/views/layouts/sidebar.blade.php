<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/')}}" class="brand-link text-center">
        <i class="brand-image pl-1 pt-2 fas fa-chart-line"></i>
        <span class="brand-text font-weight-bold">SPK </span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->


        <!-- SidebarSearch Form -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->

                {{-- <li class="nav-item">
                    <a href="{{ url('/') }}" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a href="{{ url('/kriteria') }}" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>
                            Kriteria
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/sub_kriteria') }}" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Sub Kriteria
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/alternatif') }}" class="nav-link">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                            Alternatif
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/perhitungan') }}" class="nav-link">
                        <i class="nav-icon fas fa-calculator"></i>
                        <p>
                            Data Perhitungan
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/hasil_akhir') }}" class="nav-link">
                        <i class="nav-icon fas fa-poll"></i>
                        <p>
                            Hasil Akhir
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
