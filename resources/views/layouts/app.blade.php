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
        <nav class="navbar blue-text navbar-expand-md shadow-sm py-3 px-2 shadow-4" style="background-color:#FFFFFF;">
           
            <div class="container-fluid">
                
                <button class="btn btn-link rounded-circle text-light py-3 fw-bold text-uppercase" type="button" id="menu-toggle"><i class="fas fa-bars fa-lg" style="Color: #800000;"></i></button>
               <a href="/">
                <img src="/images/cnsc.png" alt="CNSC" width="62" height="64" class="d-inline-block align-text-top mx-2">
               
               </a>
               
                
                
                
                <button class="navbar-toggler py-3 border-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fas fa-bars fa-lg" style="Color: #800000;"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav my-auto">

                        <div class="d-flex text-center flex-column bd-highlight my-2">
                            <div class="bd-highlight fw-bold fs-6 text-uppercase">Camarines Norte State College </div>
                            <div class="bd-highlight fw-light fs-6 text-uppercase pe-5" style="color:#800000">Learning and Development</div>
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

                                
                                
                                <a id="navbarDropdown" class="nav-link rounded-pill px-4 dropdown-toggle text-light fw-bold text-center" style="background-color: #926F34" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                     
                                </a>

                                
                                <div class="dropdown-menu dropdown-menu-end rounded-3 border-none border-3 shadow-4" style="background-image: linear-gradient(to right, #ADA996, #F2F2F2, #DBDBDB, #EAEAEA);" aria-labelledby="navbarDropdown">
                                    
                                    <a role="button" class="dropdown-item fw-bolder" href="/profile">
                                        Profile
                                    </a>
                                    <button class="dropdown-item fw-bolder" href="{{ route('logout') }}"
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

    

        <main class="py-none">
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
            window.livewire.emit('toggle');
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
    

    if (dropdownContent.style.display === "none") {
      dropdownContent.style.display = "block";
      
    } else {
      dropdownContent.style.display = "none";  
    }
  });
}



    </script>


   


    @livewireScripts
     @yield('script')
  


<footer class="text-white pt-5 pb-4 shadow-sm" style="background-color:#800000;">

    <div class="container text-left text-md-left">

        <div class="row text-left text-md-left">
            <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">

              
                <h5 class="text-uppercase mb-4 fw-bold text-warning">Learning and Development Office</h5>
                <p class="lh-base fs-6">The Camarines Norte State College shall provide higher and advance studies in the field of education, arts and science, economics, health, engineering, management, finace, accounting, business and public administration, fisheries, agriculture, natural resources development and management and ladderized courses. 
                    It shall also respond to research, extension and production services adherent to progressive leadership towards sustainable development. </p>
                

            </div>

            <div class="col-md-12 col-lg-2 col-xl-2 mx-auto mt-3">
                <h5 class="text-uppercase mb-5 fw-bold text-warning">Main College</h5>
                <p> 
                    <a href="#" class="text-white lh-base" style="text-decoration: none;"> Institute of Computer Studies </a>
                </p>

                <p> 
                    <a href="#" class="text-white lh-base" style="text-decoration: none;"> College of Arts and Sciences </a>
                </p>

                <p> 
                    <a href="#" class="text-white lh-base" style="text-decoration: none;"> College of Business and Public Administration</a>
                </p>

                <p> 
                    <a href="#" class="text-white lh-base" style="text-decoration: none;"> College of Engineering</a>
                </p>

              
        </div>

            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3 ">

                <h5 class="text-uppercase mb-4 fw-bold text-warning"> Satellite Campuses </h5>

                <p> 
                    <a href="#" class="text-white" style="text-decoration: none;"> College of Natural Resources</a>
                </p>

                <p> 
                    <a href="#" class="text-white" style="text-decoration: none;"> College of Trades and Technology </a>
                </p>

                <p> 
                    <a href="#" class="text-white" style="text-decoration: none;"> College of Education </a>
                </p>

                <p> 
                    <a href="#" class="text-white" style="text-decoration: none;"> Institute of Fisheries and Marine Sciences </a>
                </p>

                <p> 
                    <a href="#" class="text-white" style="text-decoration: none;"> Entienza Campus </a>
                </p>



            </div>

            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3 ">

                <h5 class="text-uppercase mb-5 fw-bold text-warning"> Information </h5>

                <p class="fs-6"> <i class="fas fa-university me-3"></i> F. Pimentel Avenue, Daet, 4600 Camarines Norte, Philippines </p>
                <p class="fs-6"> <i class="fas fa-tty me-2"></i> (054) 721-2672  or 440-1199 </p>
                <p class="fs-6"> <i class="fas fa-mobile-alt me-3"></i> 09190042141 </p>
                <p class="fs-6"> <i class="fas fa-envelope me-2"></i> icstrifecta@gmail.com </p>

            </div>


    </div>

    <hr class="mb-4">

    <div class="row align-items-center">
        <div class="col-md-7 col-lg-8">
            <p> Copyright 2022 All Rights Reserved By: <a href="#" style="text-decoration: none;"><strong class="text-warning"> Trifecta Prog </strong> </p>

        </div>

        <div class="col-md-5 col-lg-4">
            <div class="text-right text-md-right">

                <ul class="list-unstyled list-inline"> 

                <li class="list-inline-item"> <a href="#" class="text-white btn-floating btn-sm" style="font:23px;"><i class="fab fa-facebook-square"></i> </a> </li>

                <li class="list-inline-item"> <a href="#" class="text-white btn-floating btn-sm" style="font:23px;"><i class="fab fa-google"></i></i> </a> </li>

                <li class="list-inline-item"> <a href="#" class="text-white btn-floating btn-sm" style="font:23px;"><i class="fab fa-twitter-square"></i> </a> </li>

                <li class="list-inline-item"> <a href="#" class="text-white btn-floating btn-sm" style="font:23px;"><i class="fab fa-linkedin"></i> </a> </li>

            </ul>
            </div>


        </div>

    </div>

    </div>
    
</footer>

</body>
</html>
