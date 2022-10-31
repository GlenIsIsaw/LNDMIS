
<div>

    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card" style="padding-right: 5%">
                    <div class="card" >
                        <div class="card-header">
                            <h4>
                                IDP Summary of Year
                                <select wire:model='year'>
                                    <option value=""></option>
                                    @for ($i = 2015; $i <= date('Y') + 1; $i++)
                                    <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                    
        
                                </select>
                                <button type="button" style="background-color:#800;" class="btn-secondary float-end border-3 rounded-circle" wire:click="resetFilter"><i class='fas fa-redo'></i></button>
                                <button data-bs-toggle="modal" data-bs-target="#filterSummaryIdpModal" class="float-end mx-2">Filter</button>     
                                <button data-bs-toggle="modal" data-bs-target="#printSummaryIdpModal" class="float-end mx-2">Print</button>
                                <button data-bs-toggle="modal" data-bs-target="#compSummaryIdpModal" wire:click="countCompetency" class="float-end mx-2">Competency Count</button>                       
                            </h4>
                            
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table table-bordered table-hover">
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
</div>




