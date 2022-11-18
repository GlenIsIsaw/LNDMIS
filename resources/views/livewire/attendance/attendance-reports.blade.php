<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card">
                    <div class="card" >
                        <div class="card-header">
                            
                            <div class="fw-bolder fs-3 float-start text-uppercase">Attendance Summary</div>
                                <button type="button" style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle mt-2" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button data-bs-toggle="modal" data-bs-target="#filterSummaryAttendanceModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>     
                                <button data-bs-toggle="modal" data-bs-target="#printSummaryAttendanceModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download</button>                  
                           
                            
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive rounded-3 text-center">
                                <table class="table table-striped border border-secondary border-5 table-hover">
                                    <thead class="text-white" style="background-color:#800;">
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Intervention</th>
                                        <th>Date Conducted</th>
                                        <th>Venue</th>
                                        <th>Sponsors</th>
                                        <th>Competency</th>

                                    </thead>
                                    <tbody>
                                        @forelse ($trainings as $training)
                                            <tr>
                                                <td>{{$count++}}</td>
                                                <td>{{$training->name}}</td>
                                                <td>{{$training->certificate_title}}</td>
                                                <td>{{$training->date_covered. ' : '. $training->specify_date}}</td>
                                                <td>{{$training->venue}}</td>
                                                <td>{{$training->sponsors}}</td>
                                                <td>{{$training->competency}}</td>
                                            </tr>
                                        @empty
                                        <tr>
                                            <td colspan="10">No Record Found</td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.attendance.attendance-modal')
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

            $('#printSummaryAttendanceModal').modal('hide');

            
            

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
