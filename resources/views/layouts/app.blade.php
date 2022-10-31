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


<body>
    

    <div id="app">
        <nav class="navbar blue-text navbar-expand-md shadow-sm" style="background-color:#800000;">
            <div class="container-fluid px-5">
                
                 
                <img src="/images/cnsc.png" alt="CNSC" width="72" height="74" class="d-inline-block align-text-top mx-3">
                
               
                
                
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fas fa-bars text-light"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav my-auto">

                        <div class="d-flex justify-content-center text-uppercase font-helvetica fw-bold text-light fs-6 mx-2">
                            Camarines Norte State College<br>  Learning And Development Management Information System <br>
                        </div>
                       
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has(''))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has(''))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                       
                        
                                
                            <li class="nav-item dropdown mx-5">
                                
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-light fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end text-light" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" onclick="window.livewire.emit('MyProfile')">
                                        Profile
                                    </a>
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
            {{$slot}}
           
            
        </main>
      
    </div>
    
   
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
            
            var el = document.getElementById("wrapper");
            var toggleButton = document.getElementById("menu-toggle");
            toggleButton.onclick = function () {
            el.classList.toggle("toggled"); 
            if(el.classList.contains("toggled")){

                document.getElementById('main-card').className = 'vw-100';
                document.getElementById('main-card').style.paddingRight = '15%';
            }else{

                document.getElementById('main-card').className = 'w-100';
                document.getElementById('main-card').style.paddingRight = '5%';
            }
            
        };



    </script>
    <script> 
            $(".sidebar ul li").on('click' , function(){
            $(".sidebar ul li.active").removeClass('active');
            $(this).addClass('active');

            

    }) 
    </script>

   
    
    <script>
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");

    var dropdownContent = this.nextElementSibling;
    

    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
      
    } else {
      dropdownContent.style.display = "block";  
    }
  });
}

    </script>

   


    @livewireScripts
    @yield('script')
</body>

<footer>
    <div class="card text-center text-light" style="background-color:#800000;">
        <div class="card-header">
         
        </div>
       
            <table class="table table-borderless text-light">
                
        <th scope="col" class="btn btn-link text-decoration-none text-light  px-3 py-2 "><i class="fab fa-facebook-square me-2"></i> CNSC Learning And Development Office</p>
        <th scope="col" class="btn btn-link text-decoration-none text-light  px-3 py-2  "><i class="fas fa-globe me-2"></i>www.cnsclnd.com</p>
        
           
        </tr>
   

    <div class="card-body text-center">
        <p><i class="far fa-copyright"></i> Camarines Norte State College. All Rights Reserved. </p>
    </div>
        <div class="card-footer text-muted text-light">
          
                <table class="table table-borderless table-hover text-light">
                    <thead>
                            <th scope="col" class="btn btn-link text-light">Terms of Services</th>
                            <th scope="col" class="btn btn-link text-light">Privacy Notice</th>
                            <th scope="col" class="btn btn-link text-light">Accessibility</th>
                            <th scope="col" class="btn btn-link text-light">Cookie Preference</th>
                            
                        </tr>
                    </thead>
        </div>
      </div>
</footer>
</html>
