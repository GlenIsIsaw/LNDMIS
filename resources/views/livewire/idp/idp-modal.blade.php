<!-- Create IDP Modal -->
<div wire:ignore.self class="modal fade" id="createIdpModal" tabindex="-1" aria-labelledby="createIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createIdpModalLabel">Create Individual Development Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="keep">
                <div class="modal-body">
                    <div class="mb-3">
                        <label><h6>Name</h6></label>
                        <select wire:model="user_id">
                            <option value=""></option>
                            <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label><h6>Purpose:</h6></label><br>
                        <label>
                            <input type="checkbox" id="purpose_meet" wire:model="purpose_meet" value="/">
                            To meet the competencies of current position.
                        </label><br>
                        <label>
                            <input type="checkbox" id="purpose_improve" wire:model="purpose_improve" value="/">
                            To improve the current level position’s level of competencies.
                        </label><br>
                        <label>
                            <input type="checkbox" id="purpose_obtain" wire:model="purpose_obtain" value="/">
                            To obtain new level of competencies from position and different functions.
                        </label><br>
                        <label>
                            <input type="checkbox" id="purpose_others" wire:model="purpose_others" value="/">
                                Others, please specify:
                            <input type="text" wire:model="purpose_explain"/>
                        </label>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>Target Competency</th>
                                <th>S/U/G Priorities</th>
                                <th>Development Activity</th>
                                <th>Target Completion Date</th>
                                <th>Person Responsible</th>
                                <th>Support Needed </th>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 3; $i++)
                                    <tr>
                                        <td>
                                            <select wire:model='competency.{{$i}}'>
                                                <option value=""></option>
                                                @foreach ($comps as $key => $comp)
                                                <optgroup label={{$key}}>
                                                    @foreach ($comp as $item)
                                                    <option value="{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                           
                                            @error('competency.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('competency') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        <td>
                                            <select wire:model="sug.{{$i}}" id="sug">
                                                <option value=""></option>
                                                <option value="S">S</option>
                                                <option value="U">U</option>
                                                <option value="G">G</option>
                                            </select>
                                            @error('sug.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('sug') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        <td>
                                            <input type="text" wire:model="dev_act.{{$i}}">
                                            @error('dev_act.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('dev_act') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        
                                        <td>
                                            <input type="date" wire:model="target_date.{{$i}}">
                                            @error('target_date.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('target_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        <td>
                                            <input type="text" wire:model="responsible.{{$i}}">
                                            @error('responsible.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('responsible') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        <td>
                                            <input type="support" wire:model="support.{{$i}}">
                                            @error('support.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('support') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create 2 IDP Modal -->
<div wire:ignore.self class="modal fade" id="create2IdpModal" tabindex="-1" aria-labelledby="create2IdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create2IdpModalLabel">Create Individual Development Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <div>
                        <label for="compfunctiondesc" class="inline-block text-lg mb-2" >
                            What function do you feel competent to perform?<br>
                            (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
                        </label><br>
                        <table>
                            <tr>
                                <td>
                                    <select wire:model="compfunction0" id="compfunctiondesc">
                                        <option value=""></option>
                                        @foreach ($comps as $key => $comp)
                                        <optgroup label={{$key}}>
                                            @foreach ($comp as $item)
                                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('compfunction0') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <select wire:model="compfunction1" id="compfunctiondesc">
                                        <option value=""></option>
                                        @foreach ($comps as $key => $comp)
                                        <optgroup label={{$key}}>
                                            @foreach ($comp as $item)
                                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                    @error('compfunction1') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="compfunctiondesc0" id="compfunctiondesc">{{old('compfunctiondesc0')}}</textarea>
        
                                    @error('compfunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="compfunctiondesc1" id="compfunctiondesc">{{old('compfunctiondesc1')}}</textarea>
        
                                    @error('compfunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <label for="diffunctiondesc" class="inline-block text-lg mb-2">
                            What function do you have a difficulty to perform?<br>
                            (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)                                
                        </label><br>
                        <table>
                            <tr>
                                <td>
                                    <select wire:model="diffunction0" id="diffunctiondesc">
                                        <option value=""></option>
                                        @foreach ($comps as $key => $comp)
                                        <optgroup label={{$key}}>
                                            @foreach ($comp as $item)
                                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                    @error('diffunction0') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <select wire:model="diffunction1" id="diffunctiondesc">
                                        <option value=""></option>
                                        @foreach ($comps as $key => $comp)
                                        <optgroup label={{$key}}>
                                            @foreach ($comp as $item)
                                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                    @error('diffunction1') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="diffunctiondesc0" id="diffunctiondesc"></textarea>
        
                                    @error('diffunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="diffunctiondesc1" id="diffunctiondesc"></textarea>
        
                                    @error('diffunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <p class="inline-block text-lg mb-2">
                            Where do you see your career progressing in? the next two years?
                        </p>
                        <table>
                            <tr>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="career">{{old('career')}}</textarea>
        
                                    @error('career') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Show Modal -->
<div wire:ignore.self class="modal fade" id="showIdpModal" tabindex="-1" aria-labelledby="showIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showIdpModalLabel">{{$name}}'s Individual Development Plan of Year {{$created_at}}<br>
                    Status: {{$submit_status}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <div class="modal-body">

                <table class="table">
                    <tr>
                        <td><p >Employee Name: {{$name}}</p></td>
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

                <table class="table">
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
                                    <p>{{$competency[$i]}}</p>
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
                                    <p>{{$status[$i]}}</p>
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
            </div>
            <div class="modal-footer">
                @if ($submit_status == 'Not Submitted' || $submit_status == 'Rejected')
                    <button type="button" data-bs-toggle="modal" data-bs-target="#submitIdpModal" wire:click="getId({{$idp_id}})" class="btn btn-success">Submit</button>
                @endif
                @if ($submit_status == 'Pending')
                <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionIdpModal" wire:click="getId({{$idp_id}})" class="btn btn-success">Remove Submission</button>
                @endif
                @if ($submit_status != 'Approved')
                    @if ($submit_status == 'Pending')
                        @if (auth()->user()->role_as == 1)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#approveIdpModal" wire:click="getId({{$idp_id}})" class="btn btn-success">Approve</button>
                            <button type="button" data-bs-toggle="modal" data-bs-target="#rejectIdpModal" wire:click="getId({{$idp_id}})" class="btn btn-danger">Reject</button>
                        @endif    
                    @endif

                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateIdpModal" wire:click="edit({{$idp_id}})" class="btn btn-primary">Edit</button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteIdpModal" wire:click="getId({{$idp_id}})" class="btn btn-danger">Delete</button>
                    <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                
                @else
                    @if (auth()->user()->role_as == 1)
                        <button type="button" data-bs-toggle="modal" data-bs-target="#updateIdpModal" wire:click="edit({{$idp_id}})" class="btn btn-primary">Edit</button>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#deleteIdpModal" wire:click="getId({{$idp_id}})" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                    @endif
                @endif
 
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteIdpModal" tabindex="-1" aria-labelledby="deleteIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteIdpModalLabel">Delete the IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this IDP ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Delete IDP</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit IDP Modal -->
<div wire:ignore.self class="modal fade" id="updateIdpModal" tabindex="-1" aria-labelledby="updateIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateIdpModalLabel">Update Individual Development Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="next">
                <div class="modal-body">
                    @if($errors->any())
                        {{ implode('', $errors->all('<div>:message</div>')) }}
                    @endif
                    <div class="mb-3">
                        <label><h6>Name</h6></label>
                        <select wire:model="user_id">
                            <option value=""></option>
                            <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                        </select>
                        @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3">
                        <label><h6>Purpose:</h6></label><br>
                        <label>
                            <input type="checkbox" id="purpose_meet" wire:model="purpose_meet" value="/">
                            To meet the competencies of current position.
                        </label><br>
                        <label>
                            <input type="checkbox" id="purpose_improve" wire:model="purpose_improve" value="/">
                            To improve the current level position's level of competencies.
                        </label><br>
                        <label>
                            <input type="checkbox" id="purpose_obtain" wire:model="purpose_obtain" value="/">
                            To obtain new level of competencies from position and different functions.
                        </label><br>
                        <label>
                            <input type="checkbox" id="purpose_others" wire:model="purpose_others" value="/">
                                Others, please specify:
                            <input type="text" wire:model="purpose_explain"/>
                        </label>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <th>Target Competency</th>
                                <th>S/U/G Priorities</th>
                                <th>Development Activity</th>
                                <th>Target Completion Date</th>
                                <th>Person Responsible</th>
                                <th>Support Needed </th>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < 3; $i++)
                                    <tr>
                                        <td>
                                            <select wire:model='competency.{{$i}}'>
                                                <option value=""></option>
                                                @foreach ($comps as $key => $comp)
                                                <optgroup label={{$key}}>
                                                    @foreach ($comp as $item)
                                                    <option value="{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                           
                                            @error('competency.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('competency') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        <td>
                                            <select wire:model="sug.{{$i}}" id="sug">
                                                <option value=""></option>
                                                <option value="S">S</option>
                                                <option value="U">U</option>
                                                <option value="G">G</option>
                                            </select>
                                            @error('sug.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('sug') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        <td>
                                            <input type="text" wire:model="dev_act.{{$i}}">
                                            @error('dev_act.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('dev_act') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        
                                        <td>
                                            <input type="date" wire:model="target_date.{{$i}}">
                                            @error('target_date.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('target_date') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        <td>
                                            <input type="text" wire:model="responsible.{{$i}}">
                                            @error('responsible.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('responsible') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                        <td>
                                            <input type="support" wire:model="support.{{$i}}">
                                            @error('support.*') <span class="text-danger">{{ $message }}</span> @enderror
                                            @error('support') <span class="text-danger">{{ $message }}</span> @enderror
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Next</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Edit 2 IDP Modal -->
<div wire:ignore.self class="modal fade" id="update2IdpModal" tabindex="-1" aria-labelledby="update2IdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update2IdpModalLabel">Create Individual Development Plan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="closeModal"></button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                    <div>
                        <label for="compfunctiondesc" class="inline-block text-lg mb-2" >
                            What function do you feel competent to perform?<br>
                            (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
                        </label><br>
                        <table>
                            <tr>
                                <td>
                                    <select wire:model="compfunction0" id="compfunctiondesc">
                                        <option value=""></option>
                                        @foreach ($comps as $key => $comp)
                                        <optgroup label={{$key}}>
                                            @foreach ($comp as $item)
                                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @error('compfunction0') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <select wire:model="compfunction1" id="compfunctiondesc">
                                        <option value=""></option>
                                        @foreach ($comps as $key => $comp)
                                        <optgroup label={{$key}}>
                                            @foreach ($comp as $item)
                                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                    @error('compfunction1') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="compfunctiondesc0" id="compfunctiondesc">{{old('compfunctiondesc0')}}</textarea>
        
                                    @error('compfunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="compfunctiondesc1" id="compfunctiondesc">{{old('compfunctiondesc1')}}</textarea>
        
                                    @error('compfunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <label for="diffunctiondesc" class="inline-block text-lg mb-2">
                            What function do you have a difficulty to perform?<br>
                            (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)                                
                        </label><br>
                        <table>
                            <tr>
                                <td>
                                    <select wire:model="diffunction0" id="diffunctiondesc">
                                        <option value=""></option>
                                        @foreach ($comps as $key => $comp)
                                        <optgroup label={{$key}}>
                                            @foreach ($comp as $item)
                                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                    @error('diffunction0') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <select wire:model="diffunction1" id="diffunctiondesc">
                                        <option value=""></option>
                                        @foreach ($comps as $key => $comp)
                                        <optgroup label={{$key}}>
                                            @foreach ($comp as $item)
                                            <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                            @endforeach
                                        @endforeach

                                    </select>
                                    @error('diffunction1') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="diffunctiondesc0" id="diffunctiondesc"></textarea>
        
                                    @error('diffunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="diffunctiondesc1" id="diffunctiondesc"></textarea>
        
                                    @error('diffunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div>
                        <p class="inline-block text-lg mb-2">
                            Where do you see your career progressing in? the next two years?
                        </p>
                        <table>
                            <tr>
                                <td>
                                    <textarea rows="4" cols="50" wire:model="career">{{old('career')}}</textarea>
        
                                    @error('career') <span class="text-danger">{{ $message }}</span> @enderror
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Submit IDP Modal -->
<div wire:ignore.self class="modal fade" id="submitIdpModal" tabindex="-1" aria-labelledby="submitIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitIdpModalLabel">Submit IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">
                    <h4>Are you sure you want to submit your input ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remove Submit Idp Modal -->
<div wire:ignore.self class="modal fade" id="removeSubmissionIdpModal" tabindex="-1" aria-labelledby="removeSubmissionIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeSubmissionIdpModalLabel">Remove Submission of IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="removeSubmit">
                <div class="modal-body">
                    <h4>Are you sure you want to remove your submission ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Remove Submission</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Print IDP Modal -->
<div wire:ignore.self class="modal fade" id="printIdpModal" tabindex="-1" aria-labelledby="printIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printIdpModalLabel">Print IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="print">
                <div class="modal-body">
                    <h4>Are you sure you want to print this Idp ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Print</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approve IDP Modal -->
<div wire:ignore.self class="modal fade" id="approveIdpModal" tabindex="-1" aria-labelledby="approveIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveIdpModalLabel">Approve the Submitted Idp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="approve">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Approve this Submission ?</h4>
                        <label>Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject IDP Modal -->
<div wire:ignore.self class="modal fade" id="rejectIdpModal" tabindex="-1" aria-labelledby="rejectIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectIdpModalLabel">Reject the Submitted Idp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="reject">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Reject this Submission ?</h4>
                        <label>Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>


