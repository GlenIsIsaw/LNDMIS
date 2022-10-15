
<style>

:root {
    --main-bg-color: #23b1b1;
    --main-text-color: hsl(0, 0%, 96%);
    --second-text-color: #f6f6f6;
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
    min-width: 40vh;
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
    width: 25rem;

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
    background-color: rgb(238, 238, 238);
    color: var(--main-text-color);
    font-weight: bold;
    border-radius: 8px;
  }

  .h-color{

    background: #eee;
  }

  .sidebar li.active{

    background: rgb(17, 188, 194);
    border-radius: 8px;
    
  }

  .sidebar li.active a, .sidebar li.active a.hover {

    background:#f6f6f6;
    color:#0F2027;

  }

  .sidebar li a{

    color:#fff;
  }
  
  #openPopup {
  padding: 20px 30px;
  display:block;
  background-color: #4cd2de00;
  border-color: #fcfcfc00;
  box-shadow: 1px 1px 1px rgba(255, 255, 255, 0);
  white-space: normal;
  font-size: 15px;
  letter-spacing: 0.2px;
}

#openPopup:hover, #openPopup:active, #openPopup:focus {
  background-color: #ffffff !important;
  border-color: #ffffff00 !important;
}

.sidenav a, .dropdown-btn {
  
  text-decoration: none;
  font-size: 20px;
  color: #ffffff;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  transition: 0.3s ease;
}
  


.dropdown-container {
  display: none;
  background-color: none;
  padding-left: 20px;
  transition: 0.3s ease;
}


.fa-caret-down {
  float: right;
  padding-right: 8px;
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
    </div>
    
    

    <hr class="h-color mx-2">
    <div class="sidebar mx-auto">

       
        <ul class="list-unstyled px-2">

        <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 fw-bold second-text d-block"><i
                class="fas fa-tachometer-alt me-2"></i>Dashboard</a></li>

                
                <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
                 class="fas fa-project-diagram me-2"></i>My Training<i class="fa fa-caret-down"></i></button>

                 
                  <li class=""><button wire:click="createTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block ml-4">
                    <i class="fas fa-arrow-right me-2"></i>
                     Create Training </button></li>
                 
            

                 @if (auth()->user()->role_as == 1)
                  <button wire:click="approvedTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                    <i class="fas fa-arrow-right me-2"></i>
                    Approved Trainings </button></li>
                  <button wire:click="myTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                    <i class="fas fa-arrow-right me-2"></i>
                    My Trainings </button></li>
                  <button wire:click="submittedTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                    <i class="fas fa-arrow-right me-2"></i>
                    Submitted Trainings </button></li>
               @endif
                 


                
                 <button wire:click="idpsIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
                class="fas fa-chart-line me-2"></i>IDP<i class="fa fa-caret-down"></i></button></li>
                
                <button wire:click="createIdp" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                  <i class="fas fa-arrow-right me-2"></i>
                   Create IDP </button></li>

                @if (auth()->user()->role_as == 1)
                     <button wire:click="approvedIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                       <i class="fas fa-arrow-right me-2"></i>
                       Approved IDP's </button></li>
                     <button wire:click="myIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                       <i class="fas fa-arrow-right me-2"></i>
                       My IDP's </button></li>
                      <button wire:click="submittedIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                       <i class="fas fa-arrow-right me-2"></i>
                       Submitted IDP's </button></li>
                 @endif
                 
                <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-gift me-2"></i>Archives</a></li>
                
                 </ul>
               
          <hr class="h-color mx-2">
          <ul class="list-unstyled px-2">
          <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-trash me-2"></i>Trash</a></li>
              
          <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
            class="fas fa-cog me-2"></i>Settings</a></li>
          </ul>
            
      

          <!-- Log Out -->
          <hr class="h-color mx-2">
          <ul class="list-unstyled px-2">
          <li class=""><a href ="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"
             {{ __('Logout') }} id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 text-danger fw-bold d-block"><i class="fas fa-power-off me-2"></i>Log Out</a></li>
                
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
