<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    
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
    <div class="d-flex" id="wrapper">
   <!-- Sidebar -->
   <div class="bg-white" id="sidebar-wrapper">
    <div class="sidebar-heading text-center">
    <a href="/"
                ><img class="d-inline-block align-text-top" src="images/cnsc.png" alt="" class="logo" width="167" height="164"
            /></a>
    </div>
    <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom border-5 border-info">Learning and Development</div>
    <div class="list-group list-group-flush my-3">
      
        <a href="#" class="list-group-item list-group-item-action py-4 fw-bold second-text border-bottom border-2 border-white-50"><i
                class="fas fa-tachometer-alt me-2"></i>Dashboard</a>

                @if (auth()->user()->role_as == 0)
        <a href="{{route('training.empindex')}}" class="list-group-item list-group-item-action py-4 second-text fw-bold border-bottom border-2 border-white-5" class="divide"><i
                class="fas fa-project-diagram me-2"></i>Training</a>
                @else
        <a href="{{route('training.menu')}}">List of Trainings</a>
        @endif


        <a href="#" class="list-group-item list-group-item-action py-4 second-text fw-bold border-bottom border-2 border-white-5"><i
                class="fas fa-chart-line me-3"></i>IDP</a>
       
                   
                    

                
    </div>
</div>

<div class="container">
  <nav class="navbar navbar-expand-lg navbar-light bg-transparent py-4 px-4">
      <div class="d-flex align-items-center">
        <button class="btn btn-outline-info border-3 mx-2 fas fa-align-left text-light fs-4 me-2 mx-2" type="submit" id="menu-toggle"></button>
          <h2 class="fs-2 me-5 text-white">Dashboard</h2>
         
      </div>

  </nav>

</body>
