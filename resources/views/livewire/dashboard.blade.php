
<div>
    @include('livewire.menu')
    
    <div class="row mx-5 mb-3 mt-2">
        <div class="col-sm-6">
          <div class="card h-100 border border-5 border-light shadow-lg">
            <img src="/images/training.png" class="card-img-top" alt="Training">
            <div class="card-body">
              <h5 class="card-title">Training</h5>
              <p class="card-text lh-base">Good Day! Start to upload your Training/s by clicking the button below. Training is a part of being the best version of yourself and you need to be the best version of yourself to be successful.  </p>
              
              <button class="btn-secondary text-uppercase fw-bold fs-6 border-3 rounded-pill border-white px-4 py-2 text-white dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-image: linear-gradient(to right, #c31432, #240b36); ">
               Trainings
              </button>
    
              <ul class="dropdown-menu rounded-3 border-light border-3" style="background-image: linear-gradient(to right, #ADA996, #F2F2F2, #DBDBDB, #EAEAEA);">
                <li><a href="/training" role="button" class="dropdown-item fw-bolder text-dark">My Training/s</a></li>
                
              </ul>
           
            </div>
            <div class="card-footer">
              <small class="text-muted fst-italic">“Pain is temporary, Victory is eternal”</small>
            </div>
          </div>
        </div>
    
    
        <div class="col-sm-6">
          <div class="card h-100 border border-5 border-light shadow-lg">
            <img src="/images/idp.png" class="card-img-top" alt="IDP">
            <div class="card-body">
              <h5 class="card-title">Individual Development Plan</h5>
              <p class="card-text">Good Day! Start to upload your Training/s by clicking the button below. Plan your work and work your plan. “If you don't know where you are going, you'll end up someplace else.” </p>
              <button class="btn-secondary text-uppercase fw-bold fs-6 border-3 rounded-pill border-white px-4 py-2 text-white dropdown-toggle mt-3" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-image: linear-gradient(to right, #c31432, #240b36); ">
                IDP
               </button>
     
               <ul class="dropdown-menu rounded-3 border-light border-3" style="background-image: linear-gradient(to right, #ADA996, #F2F2F2, #DBDBDB, #EAEAEA);">
                <li><a href="/idp" role="button" class="dropdown-item fw-bolder text-dark" wire:click="myIDP">My IDP</a></li>
                
              </ul>
    
    
            </div>
            <div class="card-footer">
              <small class="text-muted fst-italic">"Justice, will be served."</small>
            </div>
          </div>
        </div>
        
      </div>
    @include('livewire.main-modal')
</div>


        