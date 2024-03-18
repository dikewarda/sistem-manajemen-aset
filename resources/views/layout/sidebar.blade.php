<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link{{ Route::is('dashboard') ? ' active' : '' }}" href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

        <li class="nav-item">
            <a class="nav-link{{ Route::is('hi_calculator') ? ' active' : '' }}" href="{{ route('hi_calculator') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Health Index Calculator</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link{{ Route::is('custom_formula') ? ' active' : '' }}" href="{{ route('custom_formula') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Kustom Rumus</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link{{ Route::is('parameter') ? ' active' : '' }}" href="{{ route('parameter') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Parameter</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link{{ Route::is('trafo_data') ? ' active' : '' }}" href="{{ route('trafo_data') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Data Trafo</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link{{ Route::is('variable') ? ' active' : '' }}" href="{{ route('variable') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Variabel</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link{{ Route::is('user') ? ' active' : '' }}" href="{{ route('user') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>User</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link{{ Route::is('database') ? ' active' : '' }}" href="{{ route('database') }}">
                <i class="bi bi-layout-text-window-reverse"></i>
                <span>Database</span>
            </a>
        </li>
    </ul>

</aside><!-- End Sidebar-->