<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            The Forum
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li><a  style="padding: 10px"href="/threads">Threads</a></li>
           

                <li class="dropdown">
                    <a  style="padding: 10px" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Browse <span class="caret"></span></a>

            
                    <ul style="list-style: none;" class="dropdown-menu">
                       <li style="list-style: none;"><a href="/threads">All Threads</a></li> 

                       @if (auth()->check())
                            <li><a href="/threads?by={{ auth()->user()->name }}">My Threads</a><li>
                    @endif
                    </ul>
                </li>
            </ul>

                <li style="list-style: none; padding: 10px">
                    <a href="/threads/create">New Thread</a>

                </li>

                <li  style="list-style: none; padding: 10px" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Catergories <span class="caret"></span></a>


                    <ul class="dropdown-menu">
                        @foreach (App\Catergories::all() as $catergories)
                            <li><a href="/threads/{{ $catergories->slug }}">{{ $catergories->name }}</a></li>
                        @endforeach
                    </ul>
                </li>


            </ul>

        

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href ="{{ route('profile', Auth::user()) }}">My Profile
                            </a>

                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

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