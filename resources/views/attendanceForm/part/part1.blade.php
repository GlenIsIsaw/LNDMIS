<div class="d-flex justify-content-between">
    <button type="button" wire:click="back">Back</button>
    <h6><b>Part1</b>->Part2</h6>
    <p>&nbsp; </p>
</div>
<div class="mb-3">
    <label>Name</label>
    <select wire:model="ListOfTraining_id" class="form-control">
        <option value="">Pick One</option>
        <option value="{{$ListOfTraining_id}}">{{$name}}</option>
    </select>
    @error('ListOfTraining_id') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Specific Competency Target to Enhance</label>
    <select wire:model="competency" class="form-control">
        <option value="">...</option>
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
    <label>Knowledge Acquired (What skills, knowledge and attitudes acquired?)</label>
    <textarea wire:model="knowledge_acquired" rows="4" cols="50" class="form-control"></textarea>
    @error('knowledge_acquired') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<button type="button" class="btn btn-secondary" wire:click="backButton">Close</button>
<button type="button" wire:click="next" class="btn btn-primary">Next</button>