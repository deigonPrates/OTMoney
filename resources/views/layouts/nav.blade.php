<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route('home') }}" class="nav-link">Home</a>
        </li>
        @if(isset($titlePage))
            <li class="nav-item">
                <a class="nav-link" href="#" role="button"><i class="fa-solid fa-ellipsis-vertical"></i></a>
            </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ route($routePage) }}" class="nav-link">{{ $titlePage }}</a>
        </li>
        @endif
        @if(isset($actionPage))
        <li class="nav-item">
            <a class="nav-link" href="#" role="button"><i class="fa-solid fa-ellipsis-vertical"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">{{ $actionPage }}</a>
        </li>
        @endif
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#" role="button" onclick="document.getElementById('logout').submit()">
                <i class="fa-solid fa-right-from-bracket"></i> Sair
            </a>
        </li>
        <form action="{{ route('logout') }}" method="post" id="logout">
            @csrf
        </form>
    </ul>
</nav>
