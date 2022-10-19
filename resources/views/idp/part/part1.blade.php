
        <div class="mb-3">
            <label><h6>Name:</h6></label>
            <div class="fw-bold">
            <p>{{auth()->user()->name}}</p>
            </div>
        </div>
        <hr class="h-color mx-2 mt-3">
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
                <input type="text" class="border border-2 rounded-3 border-dark" wire:model="purpose_explain"/>
            </label>
        </div>
        <hr class="h-color mx-2 mt-3">
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
                                <select wire:model='competency.{{$i}}' class="border border-2 rounded-3 border-dark">
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
                                <select wire:model="sug.{{$i}}" id="sug" class="border border-2 rounded-3 border-dark">
                                    <option value=""></option>
                                    <option value="S">S</option>
                                    <option value="U">U</option>
                                    <option value="G">G</option>
                                </select>
                                @error('sug.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('sug') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <input type="text" wire:model="dev_act.{{$i}}" class="border border-2 rounded-3 border-dark">
                                @error('dev_act.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('dev_act') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            
                            <td>
                                <input type="date" wire:model="target_date.{{$i}}" class="border border-2 rounded-3 border-dark">
                                @error('target_date.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('target_date') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <input type="text" wire:model="responsible.{{$i}}" class="border border-2 rounded-3 border-dark">
                                @error('responsible.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('responsible') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <input type="support" wire:model="support.{{$i}}" class="border border-2 rounded-3 border-dark">
                                @error('support.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('support') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
        <hr class="h-color mx-2 mt-3">
        <div class="float-start mx-2 my-2">
    <button type="button" class="btn btn-danger" wire:click="backButton"
        data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Next</button>
        </div>