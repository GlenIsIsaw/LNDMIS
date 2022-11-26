<div>
  @include('livewire.menu')
  <div class="container py-3 px-5">
   
      <div class="row">
          <div class="col-md-12">
              <div id="main-card">
                <div class="card my-2">
                   
                    <div class="card-body mx-5">
                        <div class="row">
                        <div class="col-8">
                            
                        <h6 class="fs-4 fw-bolder" style="color: #926F34"> Hello & Welcome,  {{ Auth::user()->name }}! </h6>
                        <p class="fs-6 fw-light text-capitalize my-3">You've Achieved of your progress in IDP Completion Rate of Year {{ date('Y') }}! <br>Keep it up and Improve yourself. </p>
                                </div>
                                <div class="col-4">
                            
                                    <img src="/images/man.jpg" alt="LND" width="116" height="123" class="d-inline-block align-text-left mx-2">
                                            </div>
                        </div>
                            </div>
                        </div>
                    </div>

                    
                </div>
                <div class="card" >
                  <div class="card-header">
                    
                      <div class="fw-bolder fs-3 float-start text-uppercase"> IDP Completion Rate of Year {{ date('Y') }}</div>

                 
                  </div>
                        
                  <div class="card-body text-center">
                      <div class="table-responsive border-secondary border-3 text-center">
                          <table class=" table align-middle">
                              <thead class="shadow" style="background-color:#FEFCFF;">
                                  <tr>
                                      <th scope="col">Name</span></th>
                                      <th scope="col">Progress</th>
                                      <th scope="col">Competency</th>
                                      <th scope="col">Number of Trainings</th>
                                      
                                  </tr>
                              </thead>
                              <tbody>
                                  @forelse ($competencies as $idp)
                                      <tr>
                                          <td rowspan="4" class="fw-bold fs-5">{{$idp['name']}}</td>
                                          <td rowspan="4"><span class="badge text-white fs-6 px-4 py-3" style="background-color: #800">{{$progress[$idp['progress']]}}</span></td>
                                          @foreach ($idp['competency'] as $comp => $count)
                                      </tr>
                                      <tr>
                                          <td class="text-uppercase fw-bold fs-5"><span class="badge text-white bg-success fw-bold fs-5 text-wrap">{{$comp}}</td>
                                          <td class="fw-bold fs-5">{{$count}}</td>
                                          @endforeach
                                          
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
                                          <th scope="col">Date Covered</th>
                                          <th scope="col">Action</th>

                                          
                                      </tr>
                                  </thead>
                                  <tbody class="table align-middle">

                                      @forelse ($trainings as $training)
                                          <tr>
                                              <td class="fw-bold">{{$training->name}}</td>
                                              <td>{{$training->date_covered}}</td>
                                              
                                              <td>
                                                <button type="button" class="btn btn-outline-success border-3 rounded-3 shadow-lg fs-6 fw-bold text-uppercase px-3 py-2"> See the Full Details Here </button>
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
                          <p class="fst-italic fw-lighter text-capitalize text-muted text-sm-left"> Disregard If You already read the attachments </p>
                          <div class="d-flex justify-content-center">
                              {{ $trainings->links() }}
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>


  @include('livewire.invitation-modal')
  @include('livewire.main-modal')
  @section('script')
  <script>
      window.addEventListener('toggle', event => {
          if(document.getElementById("wrapper").classList.contains('toggled')){
              document.getElementById('main-card').className = 'vw-100';
              document.getElementById('main-card').style.paddingRight = '15%';
          }else{
              document.getElementById('main-card').className = 'w-100';
              document.getElementById('main-card').style.paddingRight = '0%';
          }
      })
      window.addEventListener('close-modal', event => {

          $('#createConfirmationInvitationModal').modal('hide');
          $('#editConfirmationInvitationModal').modal('hide');
          $('#deleteConfirmationInvitationModal').modal('hide');
          $('#createConfirmationInvitationModal').modal('hide');
          
          
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




        