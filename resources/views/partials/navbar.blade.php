<div class="page-header">
    <nav class="navbar navbar-expand-lg d-flex justify-content-between">
        <div class="container">
            <div class="fw-bold">Forecasting DES</div>

            <div class="" id="navbarNav">
                <ul class="navbar-nav" id="leftNav">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == '/' ? 'active' : '' }}"
                            href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'aktual' ? 'active' : '' }}"
                            href="{{ route('actual.index') }}">Data Aktual</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'perhitungan' ? 'active' : '' }}"
                            href="{{ route('calculate.index') }}">Perhitungan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::path() == 'user' ? 'active' : '' }}" href="#">Pengguna</a>
                    </li>
                </ul>
            </div>
            <div class="" id="headerNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link profile-dropdown" href="#" id="profileDropDown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><img
                                src="../../assets/images/avatars/profile-image.png" alt="" /></a>
                        <div class="dropdown-menu dropdown-menu-end profile-drop-menu"
                            aria-labelledby="profileDropDown">

                            <form action="{{ route('logout') }}" method="POST" class="dropdown-item">
                                @csrf
                                <button class="dropdown-item text-danger fw-bold rounded-1"
                                    onclick="return confirm('Apakah anda ingin logout?')">Logout</button>
    
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
