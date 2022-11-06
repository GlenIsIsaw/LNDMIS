<div>
    @include('livewire.menu')
    <div class="row row-cols-1 row-cols-md-3 g-4 mx-5 mb-3">
        <div class="col">
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
    
    
        <div class="col">
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
        <div class="col">
          <div class="card h-100  border border-5 border-light shadow-lg">
            <img src="/images/sample.png" class="card-img-top" alt="Rick Roll">
            <div class="card-body">
              <h5 class="card-title">Under Construction</h5>
              <p class="card-text">Never gonna give you up
                Never gonna let you down
                Never gonna run around and desert you
                Never gonna make you cry
                Never gonna say goodbye
                Never gonna tell a lie and hurt you</p>
            </div>
            <div class="card-footer">
              <small class="text-muted fst-italic">"You know the rules, and so do I."</small>
            </div>
          </div>
        </div>
      </div>
    @include('livewire.main-modal')
</div>


        