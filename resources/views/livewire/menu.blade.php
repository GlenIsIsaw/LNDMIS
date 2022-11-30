
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
    
  
  #sidebar-wrapper {
    min-height: 100vh;
    min-width: 34vh;
    margin-left: -17rem;
    -webkit-transition: margin 0.25s ease-out;
    -moz-transition: margin 0.25s ease-out;
    -o-transition: margin 0.25s ease-out;
    transition: margin 0.25s ease-out;
    
    .primary-bg {
      background-color: var(--main-bg-color);
    }
    
    .secondary-bg {
      background-color: var(--second-bg-color);
    }
    
    .rounded-full {
      border-radius: 100%;
    }
    
  }
  
  #sidebar-wrapper .list-group {
    width: 15rem;

  }
  
  #page-content-wrapper {
    min-width: 100vw;
  }
    #sidebar-wrapper {
      margin-left: 0rem;
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
    
    display:block;
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
    <div class="d-flex {{$toggle}}" id="wrapper">
   <!-- Sidebar -->
   
   <div class="shadow navbar-expand-md shadow-4" style="background-color:#FEFCFF;" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
    </div>
    
    <div class="sidebar mx-auto">

    
    
       
       @if (auth()->user()->role_as == 1 || auth()->user()->role_as == 0 || auth()->user()->role_as == 2)
        <ul class="list-unstyled px-2">
          <hr class="h-color mx-2"> 

        <li class=""><a href="/" role="button" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block" style="color: #800000"><i
                class="fas fa-laptop-house me-2"></i>Home</a></li>

              
        </ul>
       @endif

        @if (auth()->user()->role_as == 1 || auth()->user()->role_as == 4)
          <ul class="list-unstyled px-2">
            @if ($currentUrl == 'http://127.0.0.1:8000/invitation')
                  <button id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block active"style="color: #800000"><i class="fas fa-envelope-open-text me-2"></i><i class="fas fa-caret-down"></i>Training Invitations</button>
    
                  
                    <div class="dropdown-container">
                      
                      <li class=""><button wire:click="createButton" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 mt-2 second-text fw-bold d-block"style="color: #800000">
                        <i class="fas fa-upload me-2"></i>
                        Upload Invitation/s </button></li>  
                  
                  <li class=""><button wire:click="backButton" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 mt-2 second-text fw-bold d-block"style="color: #800000">
                    <i class="fas fa-door-open me-2"></i></i>
                    Upcoming Invitation/s </button></li> 
                </div>
                  
                  
            @else
              <a href="/invitation" role="button" id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000"><i class="fas fa-envelope-open-text me-2"></i><i class="fas fa-caret-down"></i>Training Invitations</a>
            @endif
          
          </ul>
        @endif
        @if (auth()->user()->role_as == 1 || auth()->user()->role_as == 0 || auth()->user()->role_as == 2)
        
        <ul class="list-unstyled px-2">
          @if ($currentUrl == 'http://127.0.0.1:8000/training')
              
                
                      
                <button id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block active"style="color: #800000"><i class="fas fa-dumbbell me-2"></i><i class="fas fa-caret-down"></i>Trainings</button>
  
                
                <div class="dropdown-container">
                  <li class=""><button wire:click="createButton" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 mt-2 second-text fw-bold d-block"style="color: #800000">
                    <i class="fas fa-upload me-2"></i>
                    Upload Trainings </button></li>
  
  
                      
              
                      
  
                @if (auth()->user()->role_as == 1)
                <li class=""><button wire:click="myTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                  <i class="fas fa-folder me-2"></i>
                  My Trainings </button></li>
                <li class=""> <button wire:click="approvedTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                    <i class="fas fa-handshake me-2"></i>
                    Approved Trainings </button></li>
                    
                    <li class=""><button wire:click="submittedTraining" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                    <i class="fas fa-paper-plane me-2"></i>
                    Submitted Trainings </button></li>
                @else
                <li class=""><button wire:click="backButton" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                  <i class="fas fa-file me-2"></i>
                  View Trainings</button></li>
                @endif
                </div>
                  
  
              
          @else
          <a href="/training" role="button" id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000"><i class="fas fa-dumbbell me-2"></i><i class="fas fa-caret-down"></i>Trainings</a>
          @endif
          </ul>
  
          <ul class="list-unstyled px-2"> 
          @if ($currentUrl == 'http://127.0.0.1:8000/idp')
            
              
                  
                    
              <button id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000"><i
            class="fas fa-sitemap me-2"></i><i class="fas fa-caret-down"></i>IDP</button>
            
  
            <div class="dropdown-container" >
              <button wire:click="currentIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 mt-2 second-text fw-bold d-block"style="color: #800000">
                <i class="fas fa-clipboard-check me-2"></i>
                Current IDP </button></li>
            <button wire:click="createButton" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
              <i class="fas fa-pen-alt me-2"></i>
              Create IDP</button></li>
  
  
  
            @if (auth()->user()->role_as == 1)
  
                  <button wire:click="approvedIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                    <i class="fas fa-handshake me-2"></i>
                    Approved IDP's </button></li>
                
                  <button wire:click="submittedIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                    <i class="fas fa-clipboard-check me-2"></i>
                    Submitted IDP's </button></li>
                    <button wire:click="myIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                      <i class="fas fa-file-alt me-2"></i>
                      View IDP </button></li>
              @else
              <button wire:click="myIDP" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                <i class="fas fa-file-alt me-2"></i>
                View IDP </button></li>
            @endif
            </div>
            
            
          @else
          <a href="/idp" role="button" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000"><i
            class="fas fa-sitemap me-2"></i><i class="fas fa-caret-down"></i>IDP</a>
          @endif
        </ul>
        
        @endif

      @if (auth()->user()->role_as == 1 || auth()->user()->role_as == 2)
      <ul class="list-unstyled px-2">
      @if ($currentUrl == 'http://127.0.0.1:8000/qem/trainings')
        
          
          <button id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000"><i class="fas fa-vote-yea me-2"></i><i class="fas fa-caret-down"></i>QEM</button>
            <div class="dropdown-container">

              <button wire:click="trainingNeedQem" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 mt-2 second-text fw-bold d-block"style="color: #800000">
                <i class="fas fa-swatchbook me-2"></i></i>
               QEM For Training </button></li>
              @if (auth()->user()->role_as == 1)
                <button wire:click="SubmitQEM" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                  <i class="fas fa-times-circle me-2"></i></i>
                Unfinished QEM </button></li>
              @endif

              <button wire:click="ApprovedQem" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                <i class="fas fa-handshake me-2"></i>
                Rated QEM </button></li>
                @if (auth()->user()->role_as == 2)
                  <button wire:click="PendingQem" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                    <i class="fas fa-clock me-2"></i></i>
                    Pending QEM </button></li>
                @endif



        
      @else
        <a href="/qem/trainings" role="button" id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-vote-yea me-2"></i><i class="fas fa-caret-down"></i>QEM</a>
      @endif
    </ul>

      @endif
        @if (auth()->user()->role_as == 3)
        <ul class="list-unstyled px-2">
            <a href="/college" role="button" id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-university me-2"></i>College</a>
            
        </ul>

        @endif
        @if (auth()->user()->role_as == 1 || auth()->user()->role_as == 3)
        <ul class="list-unstyled px-2">
        @if ($currentUrl == 'http://127.0.0.1:8000/user')
          
            
            <button id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000"><i class="fas fa-user-friends me-2"></i><i class="fas fa-caret-down"></i>Users</button>
              <div class="dropdown-container">
            
            <li class=""><button wire:click="backButton" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block mt-2"style="color: #800000"><i class="fas fa-users me-2"></i>List of Users</a></li>
              
              <button wire:click="createButton" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"style="color: #800000">
                <i class="fas fa-user-plus me-2"></i>Add New Users </button></li>
              </div>
          
        @else
          <a href="/user" role="button" id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-user-friends me-2"></i><i class="fas fa-caret-down"></i>Users</a>
        @endif
      </ul>
      @endif
        
        
        
      @if (auth()->user()->role_as == 1)
        <ul class="list-unstyled px-2">
          
          @if ($currentUrl == 'http://127.0.0.1:8000/training/Reports' || $currentUrl == 'http://127.0.0.1:8000/local-lnd-plan' || $currentUrl == 'http://127.0.0.1:8000/lnd-monitoring' || $currentUrl == 'http://127.0.0.1:8000/certificate/Reports' || $currentUrl == 'http://127.0.0.1:8000/idp-completion')
          <button id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-folder-open me-2" style="color: #800000"></i><i class="fas fa-caret-down"></i>Reports</button>
          <div class="dropdown-container">
            <li class=""><a href="/training/Reports" role="button" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block mt-2" style="color: #800000" ><i class="fas fa-chalkboard-teacher me-2"></i>Training Summary</a></li>
            <li class=""><a href="/local-lnd-plan" role="button" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block mt-2"  style="color: #800000"><i class="fas fa-stamp me-2"></i>Local L&D Plan</a></li>
            <li class=""><a href="/lnd-monitoring" role="button" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block mt-2" style="color: #800000"><i class="fas fa-ticket-alt me-2"></i>L&D Monitoring</a></li>
            <li class=""><a href="/certificate/Reports" role="button" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block mt-2" style="color: #800000"><i class="fas fa-certificate me-2"></i>Certificate Summary</a></li>
            <li class=""><a href="/idp-completion" role="button" id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block mt-2" style="color: #800000"><i class="fas fa-percentage me-2"></i></i>IDP Completion Rate</a></li>
          </div>
          @else
          <a href="/training/Reports" role="button" id="openPopup" class="dropdown-btn btn btn-link-light text-decoration-none px-3 py-2 second-text fw-bold d-block"><i class="fas fa-folder-open me-2"></i><i class="fas fa-caret-down"></i>Reports</a>
          @endif

        </ul>

        @endif

       
            
        <hr class="h-color mx-2"> 

          <!-- Log Out -->
         
          <ul class="list-unstyled px-2">
          <li class=""><a href ="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"
             {{ __('Logout') }} id="openPopup" class="btn dropdown-btn btn-link-light text-decoration-none px-3 py-2 fw-bold d-block" style="color: #800000"><i class="fas fa-power-off me-2"></i>Log Out</a></li>
          
            
          </ul>
    </div>
    
</div>


<div class="container">
  
  

  
      <div class="d-flex align-items-center">
          
          

          
         
      </div>

  </nav>

 

</body>
