
<style>

:root {
    --main-bg-color: #800000;
    --main-text-color: #800000;
    --second-text-color: #800000;
    --second-bg-color: #800000;
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
      #8E0E00,
      #1F1C18
      
      
      
    );
  }
  
  #sidebar-wrapper {
    min-height: 100vh;
    min-width: 47vh;
    margin-left: -20rem;
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
    background-color: rgb(199, 30, 30);
    color: var(--main-text-color);
    font-weight: bold;
    border-radius: 8px;
  }

  .h-color{

    background: #800000;
  }

  .sidebar li.active{

    background: rgb(194, 17, 17);
    border-radius: 8px;
    
  }

  .sidebar li.active a, .sidebar li.active a.hover {

    background:#a32323;
    color:#a41a1a;

  }

  .sidebar li a{

    color:rgb(192, 41, 41);
  }
  
  #openPopup {
  padding: 20px 30px;
  display:block;
  background-color: #f8f7f700;
  border-color: #fcfcfc00;
  box-shadow: 1px 1px 1px rgba(255, 255, 255, 0);
  white-space: normal;
  font-size: 15px;
  letter-spacing: 0.2px;
  
}

#openPopup:hover, #openPopup:active, #openPopup:focus {
  background-color: #FFD700 !important;
  border-color: #EAECEE  !important;
}

 .dropdown-btn {
  
  text-decoration: none;
  font-size: 20px;
  color: #800000;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
  transition:  0.5s ease;
}
  


.dropdown-container {
  
  display:none;
  background-color: none;
  padding-left: 20px;
  transition: 0.5s ease !important;
  
  
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
      margin-left: -26rem;
    }
  }

  
  
  </style>

<body>
    <div class="d-flex" id="wrapper">
   <!-- Sidebar -->
   
   <div class="shadow navbar-expand-md" style="background-color:#FCFBF4;" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
    </div>
    
    <div class="sidebar mx-auto">

    
    
       
       
        <ul class="list-unstyled px-2">
          <hr class="h-color mx-2"> 

        <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
                class="fas fa-tv me-2"></i>Dashboard</a></li>

               
        </ul>
        <ul class="list-unstyled px-2">
          
                
                <button id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
                 class="fas fa-project-diagram me-2"></i><i class="fas fa-caret-down"></i>Trainings</button>

                 
                 <div class="dropdown-container">
                  <li class=""><button wire:click="createTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 mt-2 second-text fw-bold d-block">
                    <i class="fas fa-pen me-2"></i>
                     Upload Trainings </button></li>

                     <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                      <i class="fas fa-file me-2"></i>
                       View Trainings</button></li>
                      
              
                      

                 @if (auth()->user()->role_as == 1)
                 <li class=""> <button wire:click="approvedTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                    <i class="fas fa-handshake me-2"></i>
                    Approved Trainings </button></li>
                    <li class=""><button wire:click="myTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                    <i class="fas fa-folder me-2"></i>
                    Coordinator Trainings </button></li>
                    <li class=""><button wire:click="submittedTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                    <i class="fas fa-paper-plane me-2"></i>
                    Submitted Trainings </button></li>
               @endif
                 </div>
                   

        </ul>
        <ul class="list-unstyled px-2">
          
               
                
                 <button id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
                class="fas fa-chart-line me-2"></i><i class="fas fa-caret-down"></i>IDP</button>
                

                <div class="dropdown-container">
                <button wire:click="createIdp" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 mt-2 second-text fw-bold d-block">
                  <i class="fas fa-pen-alt me-2"></i>
                   Create IDP </button></li>

                   <button wire:click="idpsIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                    <i class="fas fa-file-alt me-2"></i>
                     View IDP </button></li>

                @if (auth()->user()->role_as == 1)
                     <button wire:click="approvedIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                       <i class="fas fa-handshake me-2"></i>
                       Approved IDP's </button></li>
                     <button wire:click="myIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                       <i class="fas fa-clipboard-list me-2"></i>
                       Coordinator IDP's </button></li>
                      <button wire:click="submittedIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block">
                       <i class="fas fa-clipboard-check me-2"></i>
                       Submitted IDP's </button></li>
                 @endif
                </div>
                
        </ul>

        <ul class="list-unstyled px-2">
          

                <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-box me-2"></i>Archives</a></li>
                
                </ul>
               
                 
          <ul class="list-unstyled px-2">
          <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-trash me-2"></i>Trash</a></li>
          </ul>
          
          <ul class="list-unstyled px-2">
          <li class=""><button wire:click="trainIndex" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i
            class="fas fa-cog me-2"></i>Settings</a></li>
          </ul>
            
      

          <!-- Log Out -->
         
          <ul class="list-unstyled px-2">
          <li class=""><a href ="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"
             {{ __('Logout') }} id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 text-danger fw-bold d-block"><i class="fas fa-power-off me-2"></i>Log Out</a></li>
          
             <hr class="h-color mx-2"> 
    </div>
</div>

<div class="container">
  
  

  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
      <div class="d-flex align-items-center">
        <button class="btn btn-light mx-2 text-light fw-bold text-center text-uppercase my-2 mx-2" style="background-color: #800000 " type="button" id="menu-toggle">☰ Menu </button>
          <h2 class="fs-4 me-3 mx-2 text-white text-uppercase"></h2>
          

          
         
      </div>

  </nav>

 

</body>
