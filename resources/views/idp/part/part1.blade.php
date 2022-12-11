
<button type="button" data-bs-toggle="modal" data-bs-target="#guideIdpModal" class="btn-success rounded-3 px-3 py-2 text-center float-end fw-bold shadow-4 me-2" style="background-image: linear-gradient(
    to top, #000000,
    #0f9b0f);"><i class="fas fa-scroll me-2"></i></i>Guide</button>
        <div class="mb-3">
            <label><h6>Year:</h6></label><span class="text-danger fw-bold">*</span>
            <div class="fw-bold">
            <select class="border-dark border-2 rounded-3 text-center fw-bold" style="width: 20%" wire:model="year">
                <option value="">-Select A Year-</option>
                @for ($i = date('Y') + 1; $i >= 2015; $i--)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
                
            </select>
            @error('year') <span class="text-danger">{{ $message }}</span> @enderror
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
            <table class="table table align-middle table-striped">
                <thead>
                    <th class="text-center">Target Competency<span class="text-danger fw-bold">*</span></th>
                    <th class="text-center">S/U/G Priority<span class="text-danger fw-bold">*</span></th>
                    <th class="text-center">Development Activity<span class="text-danger fw-bold">*</span></th>
                    <th class="text-center px-4 mx-4">Person Responsible<span class="text-danger fw-bold">*</span></th>
                    <th class="text-center">Support Needed<span class="text-danger fw-bold">*</span> </th>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 3; $i++)
                        <tr>
                            <td>
                                <select wire:model='competency.{{$i}}' class="border border-2 rounded-3 border-dark py-1">
                                    <option value="">-Select One Compentency-</option>
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
                                <select wire:model="sug.{{$i}}" id="sug" class="border border-2 rounded-3 border-dark py-1">
                                    <option value="">-Select One Priority-</option>
                                    <option value="S">Seriousness</option>
                                    <option value="U">Urgency</option>
                                    <option value="G">Growth</option>
                                </select>
                                @error('sug.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('sug') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <textarea type="text" wire:model.lazy="dev_act.{{$i}}" class="form-control border border-2 rounded-3 border-dark" style="height: 200px; width:200px;"></textarea>
                                @error('dev_act.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('dev_act') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                            <td>
                                <label>
                                    <input type="checkbox" wire:model="input.{{$i}}.{{'Immediate Supervisor'}}" value="Immediate Supervisor" class="border border-dark border-3">
                                    Immediate Supervisor
                                </label><br>
                                <label>
                                    <input type="checkbox" wire:model="input.{{$i}}.{{'VPAA'}}" value="VPAA">
                                    VPAA
                                </label><br>
                                <label>
                                    <input type="checkbox" wire:model="input.{{$i}}.{{'VPAF'}}" value="VPAF">
                                    VPAF
                                </label><br>
                                <label>
                                    <input type="checkbox" wire:model="input.{{$i}}.{{'VPRE'}}" value="VPRE">
                                    VPRE
                                </label><br>
                                <label class="px-2 my-2">
                                    Others:
                                    <textarea type="support" wire:model.lazy="input.{{$i}}.{{'Others'}}" class="form-control border border-2 rounded-3 border-dark" style="height: 5px; width:120px;"></textarea>
                                    
                                </label><br>
                                @error('input') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('input.*') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>

                            <td>
                                <textarea type="support" wire:model.lazy="support.{{$i}}" class="form-control border border-2 rounded-3 border-dark" style="height: 200px; width:200px;"></textarea>
                                @error('support.*') <span class="text-danger">{{ $message }}</span> @enderror
                                @error('support') <span class="text-danger">{{ $message }}</span> @enderror
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            
            
            @php
            $i = 0;
            foreach ($input as $item) { 
                foreach ($item as $key => $value) {
                    if(!$value){
                        unset($input[$i][$key]);
                    }
                    if (empty($input[$i])) {
                        unset($input[$i]);
                    }
                    
                }
                $i++;
            }

            @endphp
        </div>
        <hr class="h-color mx-2 mt-3">
        <div class="float-end mx-2 my-2">
    <button type="button" class="btn btn-danger" wire:click="backButton"
        data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" wire:loading.attr="disabled" id="part1">Next</button>
        </div>