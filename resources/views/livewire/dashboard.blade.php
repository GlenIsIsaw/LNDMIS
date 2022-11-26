<div>
  @include('livewire.menu')
  <div class="container py-3 px-5">
      <div class="row">
          <div class="col-md-12">
              <div id="main-card">
                <div class="card" >
                  <div class="card-header">
                    
                      <div class="fw-bolder fs-3 float-start text-uppercase"> IDP Completion Rate of Year {{ date('Y') }}</div>

                 
                  </div>
                  <div class="card-body text-center">
                      <div class="table-responsive border-secondary border-3 text-center">
                          <table class="table table-hover table-bordered border border-5 border-secondary table align-middle">
                              <thead class="text-dark align-bottom shadow" style="background-color:#FEFCFF;">
                                  <tr>
                                      <th scope="col">Name</th>
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
                                          <td class="text-uppercase fw-bold fs-5">{{$comp}}</td>
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
                  <div class="card" >
                      <div class="card-header">
                              <div class="fw-bolder fs-3 float-start text-uppercase">Incoming Invitations for Trainings</div>
                              <button type="button"style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle mt-2" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                      </div>
                      <div class="card-body">
                              
                        <button type="button" data-bs-toggle="modal" data-bs-target="#filterInvitationModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>


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
                                                  <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#showInvitationModal" wire:click="show({{$training->id}})" style="color: #800">
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




        