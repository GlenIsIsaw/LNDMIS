
<div>
    @include('livewire.menu')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                @if ($state)
                <div id="main-card">
                    <div class="card">
                        @if($state == 'tnm')
                            @include('idp.tnm')
                        @endif
                </div>

                @else
                <div id="main-card">
                    <div class="card" >
                        <div class="card-header">
                           
                            <div class="fw-bolder fs-4 float-start text-uppercase"> Local L&D Plan of Year
                                <select wire:model='year' class="border border-3 border-dark rounded-3">
                                    <option value=""></option>
                                    @for ($i = date('Y') + 1; $i >= 2015; $i--)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    
        
                                </select>
                            </div>
                            <button type="button" style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle mt-2" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                            <button wire:click="tnm" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-5 py-2 mx-2" style="background-color: #800;"><i class="fas fa-calculator me-2"></i>TNA</button>      
                        </div>
                        <div class="card-body">
                                
                                <button data-bs-toggle="modal" data-bs-target="#filterSummaryIdpModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-filter me-2"></i>Filter</button>     
                                <button data-bs-toggle="modal" data-bs-target="#printSummaryIdpModal" class="btn-secondary float-end text-white rounded-3 shadow text-uppercase fs-6 fw-bold px-4 py-2 mx-2" style="background-color: #800;"><i class="fas fa-download me-2"></i>Download</button>
                                                 
                        </div>
                            
                       
                        <div class="card-body text-center">
                            <div class="table-responsive rounded-3 text-center">
                                <table class="table table align-middle table-striped border border-secondary border-5 rounded-3 table-hover">
                                    <thead class="text-dark shadow" style="background-color:#FEFCFF;">
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
                                        <th>Submission Status</th>
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
                                                        <td class="fw-bold">

                                                            @if ($item['status'] == 'Completed')

                                                            <p class="badge badge-pill fs-6 bg-success text-white">Completed</p>
                                                                
                                                            @endif
                                                        
                                                            @if ($item['status'] == 'Ongoing')

                                                            <p class="badge badge-pill fs-6 text-white" style="background-color:#800">Ongoing</p>
                                                                
                                                            @endif
                                                        
                                                        
                                                        
                                                        </td>
                                                        <td class="fw-bold">
                                                            
                                                            @if ($item['submit_status'] == 'Approved')
                                                            <p class="badge badge-pill fs-6 bg-success text-white">Approved</p>
                                                                
                                                            @endif
                                                            
                                                            @if ($item['submit_status'] == 'Pending')
                                                            <p class="badge badge-pill fs-6 bg-warning text-dark">Pending</p>
                                                                
                                                            @endif
                                                        
                                                            @if ($item['submit_status'] == 'Reject')
                                                            <p class="badge badge-pill fs-6 bg-danger text-dark">Reject</p>
                                                                
                                                            @endif
                                                        
                                                            @if ($item['submit_status'] == 'Ongoing')
                                                            <p class="badge badge-pill fs-6 text-white" style="background-color:#800">Ongoing</p>
                                                                
                                                            @endif
                                                        
                                                        </td>
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
                @endif
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
        $('#printTnmModal').modal('hide');
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




