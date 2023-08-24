@yield('header')
<header class="p-4 text-bg-dark bg-dark">
    <div class="container">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <i class="fa-solid fa-book fs-1 text-white"></i>

            <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                <li><a class="nav-link mx-3 fs-4 text-white gx-2" href="{{ route('main') }}">Главная</a></li>
                <li><a class="nav-link mx-3 fs-4 text-white gx-2" href="{{ route('authors') }}">Авторы</a></li>
                <li><a class="nav-link mx-3 fs-4 text-white gx-2" href="{{ route('books') }}">Список книг</a></li>
                <li><a class="nav-link mx-3 fs-4 text-white gx-2" href="{{ route('categories') }}">Жанры</a></li>
            </ul>

            <ul class="list-unstyled">
                @guest
                    @if (Route::has('login'))
                        <li class="list-inline-item">
                            <a class="nav-link" href="/login"><button type="button" class="btn btn-outline-light me-2 fs-5">Войти</button></a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="list-inline-item">
                            <a class="nav-link" href="'/register'"><button type="button" class="btn btn-warning fs-5">Регистрация</button></a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown d-inline-flex">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ route('cabinet') }}">
                            <button type="button" class="btn btn-warning me-2 fs-5">Личный кабинет:
                                <p class="p-0 m-0">{{ Auth::user()->name }}</p>
                            </button>
                        </a>
                        <a id="navbar" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <button type="button" class="btn no-border"></button>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                Выйти
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</header>
