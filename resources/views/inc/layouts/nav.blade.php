<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @auth
                    <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown" role="button"
                           aria-expanded="false">Transactions</a>
                        <ul id="dropdown" class="dropdown-menu" role="menu">
                            <li><a class="nav-link" href="{{ url('/transactions') }}">All Transactions</a></li>
                            <li role="separator" class="dropdown-divider"></li>
                            <li><a class="nav-link" href="{{ url('/transactions/create') }}">New Transaction</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown" role="button"
                           aria-expanded="false">Categories</a>
                        <ul id="dropdown" class="dropdown-menu" role="menu">
                            <li><a class="nav-link" href="{{ url('/categories') }}">Manage Categories</a></li>
                            <li><a class="nav-link" href="{{ url('/categories/create') }}">New Category</a></li>
                            <li role="separator" class="dropdown-divider"></li>
                            @foreach(\App\Category::all() as $category)
                                <li><a class="nav-link" href="{{ url('/transactions/' . $category->slug) }}">
                                        {{ $category->name }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endauth
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li><a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span></a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
