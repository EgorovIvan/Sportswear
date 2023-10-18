<header class="container">
    <div class="header">
        <ul class="header__list">
            <li class="header__list">
                <a href="{{ route('main.index') }}">
                    <img class="header__logo" src="/img/logo.png" alt="logo">
                </a>
            </li>
            <li class="header__list-item">
                <a class="header__list-link" href="{{ route('catalog.index')}}">каталог</a>
            </li>
            <li class="header__list-item">
                <a class="header__list-link" href="{{ route('catalog.filter', ['key' => 'link', 'men' => 100]) }}">мужское</a>
            </li>
            <li class="header__list-item">
                <a class="header__list-link" href="{{ route('catalog.filter', ['key' => 'link', 'women' => 101]) }}">женское</a>
            </li>
            <li class="header__list-item">
                <a class="header__list-link" href="{{ route('catalog.filter', ['key' => 'link', 'kids' => 102]) }}">детское</a>
            </li>
            <li class="header__list-item">
                <a class="header__list-link"
                   href="{{ route('catalog.filter', ['key' => 'link', 'accessories' => 103]) }}">аксессуары</a>
            </li>
            <li class="header__list-item">
                <a class="header__list-link" href="{{ route('catalog.index') }}">новинки</a>
            </li>
            @if(optional(Auth::user())->isAdmin)
                <li class="header__list-item"><a class="header__list-link" href="{{route('admin.index')}}">Панель админа</a></li>
            @endif
        </ul>
        <div class="header__icons">
            <a class="header__icon" href="{{ route('cart.index') }}">
                <img src="/img/main/cart.png" alt="">
            </a>
            @if(Auth::user())
                <a class="header__icon" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    <img src="/img/main/logout.png" alt="">
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <a class="header__icon" href="{{ route('login') }}">
                    <img src="/img/main/login.png" alt="">
                </a>
            @endif
        </div>

    </div>
</header>


