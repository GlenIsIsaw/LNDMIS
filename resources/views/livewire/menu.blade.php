
<style>

:root {
    --main-bg-color: #23b1b1;
    --main-text-color: hsl(0, 0%, 96%);
    --second-text-color: #267a7a;
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
      #2C5364,
      #203A43,
      #0F2027
      
      
      
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
    padding: 0.775rem 1.25rem;
    font-size: 1.5rem; 
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
    background-color: #eee;
    color: var(--main-text-color);
    font-weight: bold;
    border-radius: 8px;
  }

  .h-color{

    background: #eee;
  }

  .sidebar li.active{

    background: #eee;
    border-radius: 8px;
  }

  .sidebar li.active a, .sidebar li.active a.hover {

    color:#0F2027;

  }

  .sidebar li a{

    color:#fff;
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
    <div class="d-flex" id="wrapper">
   <!-- Sidebar -->
   
   <div class="shadow-sm navbar-expand-md" style="background-color:#06283D" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
    <a href="/"
                ><img class="d-inline-block align-text-top" src="images/cnsc.png" alt="" class="logo" width="97" height="94"
            /></a>
    </div>
    <div class="sidebar-heading text-center py-4 primary-text fs-7 fw-bold text-uppercase">learning and development</div>

    <hr class="h-color mx-2">
    <div class="sidebar my-3">

        <ul class="list-unstyled px-2">

        <li class=""><a href="/" class="text-decoration-none px-3 py-2 fw-bold second-text  d-block"><i
                class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>

                
                <li class=""><a href="{{route('training.empTraining')}}" class="text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
                 class="fas fa-project-diagram me-2"></i>Training</a></li>

                
                 <li class=""><a href="{{route('idp.empIDP')}}" class="text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
                class="fas fa-chart-line me-2"></i>IDP</a></li>

                <li class=""><a href="#" class="text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-gift me-2"></i>Archives</a></li>

                 </ul>
               
          <hr class="h-color mx-2">
          <ul class="list-unstyled px-2">
          <li class=""><a href="#" class="text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-paperclip me-2"></i>Core Competencies</a></li>
              
          <li class=""><a href="#" class="text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
            class="fas fa-cog me-2"></i>Settings</a></li>
          </ul>
            
      

          <!-- Log Out -->
          <hr class="h-color mx-2">
          <ul class="list-unstyled px-2">
          <li class=""><a href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"
             {{ __('Logout') }} class="text-decoration-none px-3 py-2 text-danger fw-bold d-block"><i class="fas fa-power-off me-2"></i>Log Out</a></li>
                
    </div>
</div>

<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
      <div class="d-flex align-items-center">
        <button class="btn btn-outline-info border-3 mx-2 fas fa-align-left text-light fs-5 me-2 mx-2" type="button" id="menu-toggle"></button>
          <h2 class="fs-4 me-3 mx-2 text-white text-uppercase">Menu</h2>

          
         
      </div>

  </nav>


</body>
