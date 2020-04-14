<header>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="/">FFFORUM</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="d-flex justify-content-between w-100">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">Главная <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('forum.categories.id', 1) }}">Форум <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <div class="d-md-flex w-100">
                    <div class="w-75 ml-auto mr-0 pt-1 pt-md-0">
                        <form method="POST" class="w-100 input-group mr-0" action="{{ route('search') }}">
                            @method('GET')
                            @csrf
                            <input class="form-control rounded-left" type="text" id="search" name="search" placeholder="Поиск по сайту" aria-label="Search">
                            <div class="input-group-append">
                                <button class="btn btn-outline-success" type="submit">Найти</button>
                            </div>
                        </form>
                    </div>
                    @if (Route::has('login'))
                        <div class="pl-md-1 pt-md-0 pt-1 top-right links">
                            @auth
                                <li class="nav-item dropdown d-flex">
                                    <a id="navbarDropdown" class="ml-auto btn btn-outline-success my-sm-0 dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Выйти
                                        </a>
                                        <a class="dropdown-item" href="{{ route('user.index') }}">Профиль</a>
                                        @if (Auth::user()->is_admin == 1)
                                            <a class="dropdown-item" href="{{ route('forum.admin.index') }}">Админка</a>
                                        @endif
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @else
                                <a class="btn btn-outline-success my-2 my-sm-0" href="{{ route('login') }}">Войти</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
