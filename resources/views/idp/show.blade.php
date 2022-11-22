<div class="card-header">
    <div class="float-start fs-5 fw-bold text-uppercase ">
    
        {{$name}}'s Individual Development Plan of Year {{$year}}
    
    </div>
    <div class="float-end ">
        <button type="button" class="btn btn-danger" wire:click="backButton"><i class="fas fa-times px-2 py-1"></i></button>
    </div>
</div>
<div class="card-body">
    
    <div class="col">
        <table class="table table-striped table-hover rounded-3">
            <tr class="me-3">
                <th style="width:20%">Employee Name:</th>
                <td class="text-left text-capitalize">{{$name}}</td>
                
            </tr>
            <tr>
                <th>Position:</th>
                <td class="text-left text-capitalize">{{$position}} </td>
            </tr>
            <tr>
                <th>Years in Position:</th>
                <td class="text-left text-capitalize">{{$yearinPosition}}</td>
            </tr>
            <tr>
                <th>Supervisor's Name:</th>
                <td class="text-left text-capitalize">{{$supervisor}}</td>
            </tr>
            <tr>
                <th>Years in Agency:</th>
                <td class="text-left text-capitalize">{{$yearJoined}}</td>
            </tr>

        </table>
    </div>
    <hr class="h-color mx-2"> 
    <p class="fw-bolder text-uppercase mt-2 fs-6">PURPOSE</p>
    <div class="col">
        <table class="table table-hover rounded-3">
            <tr>
                <th>({{$purpose_meet}})</th>
                <td class="text-left text-capitalize fs-6">To meet the competencies of current position</td>
            </tr>
            <tr>
                <th>({{$purpose_improve}})</th>
                <td class="text-left text-capitalize fs-6">To improve the current level position’s level of competencies.</td>
            </tr>
            <tr>
                <th>({{$purpose_obtain}})</th>
                <td class="text-left text-capitalize fs-6">To obtain new level of competencies from position and different functions.</td>
            </tr>
            <tr>
                <th>({{$purpose_others}})</th>
                <td class="text-left text-capitalize fs-6">Others, please specify: {{$purpose_explain}}</td>
            </tr>
        </table>
    </div>


    <div class="table-responsive table-bordered text-center">
    
    <table class="table table-bordered table-hover">
        
        <th>Target Competency</th>
        <th>S/U/G Priorities</th>
        <th>Development Activity</th>
        <th>Target Completion Date</th>
        <th>Person Responsible</th>
        <th>Support Needed </th>
        <th>Completion Status</th>

            @for ($i = 0; $i < 3; $i++)
                <tr>
                    <td>
                        <p><button type="button" class="btn btn-link text-decoration-none text-dark" data-bs-toggle="modal" data-bs-target="#getTrainingsModal" wire:click="getId({{$idp_id}})">{{$competency[$i]}}</button></p>
                    </td>
                    <td>
                        <p>{{$sug[$i]}}</p>
                    </td>
                    <td>
                        <p>{{$dev_act[$i]}}</p>
                    </td>
                    <td>
                        <p>{{$target_date[$i]}}</p>
                    </td>
                    <td>
                        <p>{{$responsible[$i]}}</p>
                    </td>
                    <td>
                        <p>{{$support[$i]}}</p>
                    </td>
                    <td>
                        @if (auth()->user()->role_as == 1)
                            <select wire:model="status.{{$i}}" class="border border-3 rounded-3 border-secondary">
                                <option value="Ongoing">Ongoing</option>
                                <option value="Completed">Completed</option>
                            </select>
                        @else
                            <p>{{$status[$i]}}</p>
                        @endif
                        
                    </td>
                </tr>
            @endfor
    </table>
</div>
    <div class="fw-bold text-start fs-5">
        What function do you feel competent to perform?<br>
        (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
    </div>
    <hr class="h-color mx-2"> 
        <p class="me-2 lh-base text-start mt-2">1. {{$compfunction0}} - {{$compfunctiondesc0}}</p>
        <p class="me-2 lh-base text-start mt-2">2. {{$compfunction1}} - {{$compfunctiondesc1}}</p>
    <div class="fw-bold text-start fs-5">
        What function do you have a difficulty to perform?<br>
        (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
    </div>
    <hr class="h-color mx-2"> 
        <p class="me-2 lh-base text-start mt-2">1. {{$diffunction0}} - {{$diffunctiondesc0}}</p>
        <p class="me-2 lh-base text-start mt-2">2. {{$diffunction1}} - {{$diffunctiondesc1}}</p>
    
    <div class="fw-bold text-start fs-5">
        Where do you see your career progressing in? the next two years?
    </div>
    <hr class="h-color mx-2"> 
    <p class="me-2 lh-base text-start mt-2">{{$career}}</p>


    