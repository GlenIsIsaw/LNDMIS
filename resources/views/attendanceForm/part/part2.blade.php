<div class="justify-content-center">
   
    
</div>


<div class="mb-3">
    <label class="fw-bold">Outcome</label>
    <textarea wire:model.lazy="outcome" rows="4" cols="50" class="form-control border border-3 border-secondary"></textarea>
    @error('outcome') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Personal Action</label>
    <textarea wire:model.lazy="personal_action" rows="4" cols="50" class="form-control border border-3 border-secondary"></textarea>
    @error('personal_action') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="float-start">

</div>


