<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Camarines Norte State College Learning and Development</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    @livewireStyles

</head>
<style>
    
    :root {
        --main-bg-color: #030b0b;
        --main-text-color: hsl(0, 83%, 28%);
        --second-text-color: #030712;
        --second-bg-color: #c1eeef;
      }
      
      .primary-text {
        color: var(--main-text-color);
      }
      
      .second-text {
        color: var(--second-text-color);
      }
      
      .primary-bg {
        background-color: var(--main-bg-color);
      }
      
      .secondary-bg {
        background-color: var(--second-bg-color);
      }
      
      .rounded-full {
        border-radius: 100%;
      }
      
      #wrapper {
        overflow-x: hidden;
        background-image: linear-gradient(
          to right,
          #0F2027,
          #203A43,
          #2C5364
          
        );
      }
      
      #sidebar-wrapper {
        min-height: 100vh;
        margin-left: -15rem;
        -webkit-transition: margin 0.25s ease-out;
        -moz-transition: margin 0.25s ease-out;
        -o-transition: margin 0.25s ease-out;
        transition: margin 0.25s ease-out;
      }
      
      #sidebar-wrapper .sidebar-heading {
        padding: 0.875rem 1.25rem;
        font-size: 1.2rem;
      }
      
      #sidebar-wrapper .list-group {
        width: 20rem;
      }
      
      #page-content-wrapper {
        min-width: 100vw;
        
      }
      
      #wrapper.toggled #sidebar-wrapper {
        margin-left: 0;
      }
      
      #menu-toggle {
        cursor: pointer;
      }
      
      .list-group-item {
        border: none;
        padding: 20px 30px;
      }
      
      .list-group-item.active {
        background-color: transparent;
        color: var(--main-text-color);
        font-weight: bold;
        border: none;
      }
      
      @media (min-width: 768px) {
        #sidebar-wrapper {
          margin-left: 0;
        }
      
        #page-content-wrapper {
          min-width: 0;
          width: 100%;
          
        }
      
        #wrapper.toggled #sidebar-wrapper {
          margin-left: -29rem;
        }
      }
      
      </style>
<body>
    

    <div id="app">
        <nav class="navbar blue-text navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container px-9">
                

                <a class="navbar-brand text-uppercase font-helvetica fw-bold" href="{{ url('/') }}">
                    Camarines Norte State College
                </a>
                
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
          
        </nav>
        
        

    </div>

        <main class="py-9">
            @yield('content')
           
            
        </main>
      
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <script> var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");
        toggleButton.onclick = function () {
            el.classList.toggle("toggled");
        };

    </script>
    @livewireScripts
    @yield('script')
</body>
</html>
