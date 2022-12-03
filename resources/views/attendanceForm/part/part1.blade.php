<div class="justify-content-center">
   
</div>


<div class="mb-3">
    <label class="fw-bold">Title of Intervention Attended</label>
    <div class="text-lg" style="font-size: 18px"><p>{{$certificate_title}}</p></div>
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
            <optgroup label="IDP of Year {{date('Y')}}">
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
<button type="button" wire:click="part1_att" class="btn btn-primary" wire:loading.attr="disabled" id="part1">Next</button>
</div>