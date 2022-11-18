<div class="justify-content-center">
    <div class="progress" style="height:25px; mx-4">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
        aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:50%">
          
        </div>
      </div>
</div>

<hr class="h-color mx-2 mt-3">
<div class="mb-3">
    <label class="fw-bold">Name</label>
    <select wire:model="ListOfTraining_id" class="form-control border border-3 border-secondary">
        <option value="">...</option>
        <option value="{{$ListOfTraining_id}}">{{$name}}</option>
    </select>
    @error('ListOfTraining_id') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="mb-3">
    <label class="fw-bold">Specific Competency Target to Enhance</label>
    <select wire:model="competency" class="form-control border border-3 border-secondary">
        <option value="">...</option>
        @if ($idp_competency)
        
        @php

        foreach ($comps as $key => $comp){
                        foreach ($comp as $num => $item){
                            foreach ($idp_competency as $samp) {
                                if($item->competency_name == $samp){
                                    unset($comps[$key][$num]);
                                }
                            }
                        }
                    }
        @endphp
            <optgroup label="Idp:{{date('Y')}}">
                @foreach ($idp_competency as $item)
                    <option value="{{$idp_id.'#'.$item}}">{{$item}}</option>
                @endforeach
        @endif

        @foreach ($comps as $key => $comp)
        <optgroup label={{$key}}>
            @foreach ($comp as $item)
            <option value="{{$item->competency_name}}">{{$item->competency_name}}</option>
            @endforeach
        @endforeach
    </select>
    @error('competency') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Knowledge Acquired (What skills, knowledge and attitudes acquired?)</label>
    <textarea wire:model.lazy="knowledge_acquired" rows="4" cols="50" class="form-control border border-3 border-secondary"></textarea>
    @error('knowledge_acquired') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="float-end">
<button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
<button type="button" wire:click="next" class="btn btn-primary">Next</button>
</div>