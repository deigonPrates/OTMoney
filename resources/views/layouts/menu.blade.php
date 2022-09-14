<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{ asset('img/AdminLTELogo.png') }}" alt="Logo" class="brand-image img-circle elevation-3 opacity-75">
        <span class="brand-text">{{ env('APP_NAME') }}</span>
    </a>
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="https://ui-avatars.com/api/?name={{ \Illuminate\Support\Facades\Auth::user()->name }}&background=random&color=random" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link">
                        <i class="nav-icon fa-solid fa-gauge"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item {{ \Illuminate\Support\Facades\Request::segment(1) === 'admin' ? 'menu-open' : ''}}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-gear"></i>
                        <p>Configurações
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview pl-3">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-receipt nav-icon"></i>
                                <p>Taxas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="fa-solid fa-cash-register nav-icon"></i>
                                <p>Forma de pagamento</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-square-poll-horizontal"></i>
                        <p>Simulação</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa-solid fa-clock-rotate-left"></i>
                        <p> Histórico</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
