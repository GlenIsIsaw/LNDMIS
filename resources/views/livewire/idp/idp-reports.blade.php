
<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card">
                    <div class="card" >
                        <div class="card-header">
                           
                            <div class="fw-bolder fs-4 float-start text-uppercase"> IDP Summary of Year
                                <select wire:model='year' class="border border-3 border-dark rounded-3">
                                    <option value=""></option>
                                    @for ($i = 2015; $i <= date('Y') + 1; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    
        
                                </select>
                            </div>
                                <button type="button" style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle mt-2" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button data-bs-toggle="modal" data-bs-target="#filterSummaryIdpModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>     
                                <button data-bs-toggle="modal" data-bs-target="#printSummaryIdpModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download</button>
                                <button data-bs-toggle="modal" data-bs-target="#compSummaryIdpModal" wire:click="countCompetency" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-5 py-2 mx-2" style="background-color: #800;"><i class="fas fa-calculator me-2"></i>Competency Count</button>                       
                           
                            
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive table-bordered border-dark text-center">
                                <table class="table table-striped table-bordered border-dark table-hover">
                                    <thead>
                                        <!--<th>#</th> -->
                                        <th>
                                            Competencies
                                        </th>
                                        <th>S/U/G Priorities</th>
                                        <th>Development Activity</th>
                                        <th>Target Completion Date</th>
                                        <th>Employee Name</th>
                                        <th>Person Responsible</th>
                                        <th>Support Needed</th>
                                        <th>Status</th>
                                        <th>Submit Status</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($arrays as $key => $array)
                                                @foreach ($array as $item)
                                                    <tr>
                                                        <td>{{$item['competency']}}</td>
                                                        <td>{{$item['sug']}}</td>
                                                        <td>{{$item['dev_act']}}</td>
                                                        <td>{{$item['target_date']}}</td>
                                                        <td>{{$key}}</td>
                                                        <td>{{$item['responsible']}}</td>
                                                        <td>{{$item['support']}}</td>
                                                        <td>{{$item['status']}}</td>
                                                        <td>{{$item['submit_status']}}</td>
                                                    </tr>
                                                @endforeach

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
                                {{ $idps->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@include('livewire.idp.idp-reports-modal')
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

        $('#printSummaryIdpModal').modal('hide');
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




