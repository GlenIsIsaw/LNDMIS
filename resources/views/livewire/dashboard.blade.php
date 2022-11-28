<div>
  @include('livewire.menu')
  <div class="container py-2">
   
      <div class="row">
          <div class="col-md-12">
              <div id="main-card">
                <div class="card my-2">
                   
                   
                    <div class="card-body">
                        <div class="row">
                        <div class="col-8">
                            
                        <h6 class="fs-4 fw-bolder" style="color: #926F34"> Hello & Welcome,  {{ Auth::user()->name }}! </h6>
                        <p class="fs-6 fw-light text-capitalize my-3">You've Achieved almost of your progress in IDP Completion Rate of Year {{ date('Y') }}! <br>Keep it up and Improve yourself. </p>
                                </div>
                                <div class="col-2">
                            
                                    <img src="/images/man.jpg" alt="LND" width="116" height="123" class="d-inline-block align-text-left mx-2">
                                            </div>
                        </div>
                            </div>
                        </div>
                  

                    
          
                <div class="card">
                  <div class="card-header">
                    
                      <div class="fw-bolder fs-3 float-start text-uppercase"> IDP Completion Rate of Year {{ date('Y') }}</div>

                 
                  </div>
                        
                  <div class="card-body">
                      <div class="table-responsive border-secondary border-3">
                          <table class="table align-middle">
                              <thead class="shadow text-center" style="background-color:#FEFCFF;">
                                  <tr>
                                      
                                      
                                      <th scope="col" class="mt-2 text-uppercase" style="color: #800">Competencies</th>
                                      <th scope="col" class="mt-2 text-uppercase" style="color: #800">Number of Trainings</th>
                                      
                                  </tr>
                              </thead>
                              <tbody class="text-center">
                                  @forelse ($competencies as $idp)
                                      
                                        <div class="container-fluid px-5">
                                           
                                                <div class="col-md-5 offset-md-3">
                                                    <div class="text-center mt-2 py-1 bg-white shadow d-flex justify-content-around align-items-center rounded-3 mb-3" style="background-color: #FEFCFF">
                                                        <div>
                                                            <p class="fs-1 fw-bold" style="color: #926F34">{{$progress[$idp['progress']]}}</p>
                                                <p class="fs-6 fw-bold">Progress </p>
                                                        </div>
                                                        <i class="fas fa-arrow-circle-up fa-3x" style="color: #800"></i>
                                                    </div>
                                                </div>
                                               
                                              
                                          
                                          @foreach ($idp['competency'] as $comp => $count)
                                      
                                      <tr>
                                        <div class="col-md-3">
                                          <td class="py-2 me-3 my-2 fw-bold text-capitalize shadow justify-content-around align-items-center rounded-3 text-xl-center">{{$comp}}</td>
                                          <td class="py-2 me-3 my-2 fs-4 fw-bolder shadow justify-content-around align-items-center rounded-3" style="color: #926F34" style="width: 30%;">{{$count}}</td>
                                          @endforeach
                                        </div>
                                      </tr>
                                            </div>
                                        </div>
                                  @empty    
                                      <tr>
                                          <td colspan="20">No Record/s Found</td>
                                      </tr>
                                  @endforelse
                              </tbody>
                          </table>
                      </div>
                  </div>
                  <div class="card-footer">
                  </div>
                  </div>
              </div>
                  <div class="card my-3">
                      <div class="card-header">
                              <div class="fw-bolder fs-3 float-start text-uppercase">Incoming Invitations for Trainings</div>
                        
                      </div>
                      <div class="card-body">
                              
                


                      </div>
                      <div class="card-body text-center">
                          <div class="table-responsive rounded-3 text-center">
                              @php
                                  $array = [0 => 'Yes', 1 => 'No'];
                              @endphp
                              <table class="table border border-secondary border-5 table-hover">
                                  <thead class="text-dark shadow" style="background-color:#FEFCFF;">
                                      <tr>
                                          <th scope="col">Seminar Title</th>
                                          <th scope="col">Level</th>
                                            <th scope="col">Sponsors</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Free</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Date Covered</th>
                                            <th scope="col">Attachments</th>

                                          
                                      </tr>
                                  </thead>
                                  <tbody class="table align-middle">

                                      @forelse ($trainings as $training)
                                          <tr>
                                              <td class="fw-bold">{{$training->name}}</td>
                                              <td>{{$training->level}}</td>
                                              <td>{{$training->sponsor}}</td>
                                              <td>{{$training->venue}}</td>
                                              <td>{{$array[$training->free]}}</td>
                                              <td>{{$training->amount}}</td>
                                              <td>{{$training->date_covered}}</td>
                                              <td>
                                                  <button type="button" class="btn btn-link" wire:click="show({{$training->id}})" style="color: #800">
                                                      View File Attachment Here
                                                 </button>
                                              </td>
                                          </tr>
                                       

                                      @empty    
                                          <tr>
                                              <td colspan="20">No Record/s Found</td>
                                          </tr>
                                      @endforelse
                                  </tbody>
                              </table>
                          </div>
                      </div>
                      <div class="card-footer">
                        <div class="d-flex justify-content-center">
                            {{ $trainings->links() }}
                        </div>
                          <p class="fst-italic fw-lighter text-capitalize text-muted text-sm-left"> Disregard If You already read the attachments </p>
                         
                      </div>
                  </div>
              </div>
  </div>
            </div> 
          </div>
      </div>
  </div>


  @include('livewire.dashboard-modal')
  @include('livewire.main-modal')
  @section('script')
  <script>
      window.addEventListener('toggle', event => {
          if(document.getElementById("wrapper").classList.contains('toggled')){
              document.getElementById('main-card').className = 'vw-100';
              document.getElementById('main-card').style.paddingRight = '10%';
          }else{
              document.getElementById('main-card').className = 'w-100';
              document.getElementById('main-card').style.paddingRight = '0%';
          }
      })
      window.addEventListener('close-modal', event => {
          
          
          $('#notificationModal').modal('hide');
          
          
      })
      window.addEventListener('show-notification', event => {
          $('#notificationModal').modal('show');
      })
      window.addEventListener('confirmation-create-training', event => {
          $('#createConfirmationTrainingModal').modal('show');
      })
  </script>

  @endsection
</div>




        