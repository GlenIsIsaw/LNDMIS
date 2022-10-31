<div class="card-header">
    <h4>
        {{$name}}'s Individual Development Plan of Year {{$year}}
    </h4>
</div>
<div class="card-body">
    <table class="table">
        <tr>
            <td><p>Employee Name: {{$name}}</p></td>
            <td><p>Position: {{$position}}</p></td>
            <td><p>Years in the Position: {{$yearinPosition}}</p></td>
        </tr>
        <tr>
            <td><p>Supervisor's Name: {{$supervisor}}</p></td>
            <td colspan="2"><p>Years in the Agency: {{$yearJoined}}</p></td>
        </tr>
    </table>
    <h4 class="font-bold">PURPOSE</h4>
    <p>({{$purpose_meet}}) To meet the competencies of current position</p>
    <p>({{$purpose_improve}}) To improve the current level position’s level of competencies.</p>
    <p>({{$purpose_obtain}}) To obtain new level of competencies from position and different functions.</p>
    <p>({{$purpose_others}}) Others, please specify: {{$purpose_explain}}</p>

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
    <h4 class="font-bold">
        What function do you feel competent to perform?<br>
        (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
    </h4>
        <p>1.{{$compfunction0}} - {{$compfunctiondesc0}}</p>
        <p>2.{{$compfunction1}} - {{$compfunctiondesc1}}</p>
    <h4 class="font-bold">
        What function do you have a difficulty to perform?<br>
        (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
    </h4>
        <p>1.{{$diffunction0}} - {{$diffunctiondesc0}}</p>
        <p>2.{{$diffunction1}} - {{$diffunctiondesc1}}</p>
    
    <h4 class="font-bold">
        Where do you see your career progressing in? the next two years?
    </h4>
    <p>{{$career}}</p>

<button type="button" class="btn btn-secondary" wire:click="backButton" >Close</button>
    </div>