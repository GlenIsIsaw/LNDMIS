<div class="justify-content-center mt-4">

    
    
</div>




        @if (auth()->user()->role_as == 3)
            <div class="mb-3">
                <label class="fw-bold">College</label><span class="text-danger fw-bold">*</span>
                <select wire:model="college_id" class="form-control border border-3 border-dark rounded-3">
                    <option value=""></option>
                        @foreach ($colleges as $key => $item)
                            @for ($j = 1; $j < count($item); $j++)
                                <option value="{{$colleges[$key]['id']}}">{{$colleges[$key]['college_name']}}</option>
                            @endfor
                        @endforeach
                </select>

                @error('college_id') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        @endif

        <div class="mb-3">
            <label class="fw-bold">Name</label><span class="text-danger fw-bold">*</span>
            <input type="text" wire:model.lazy="name" class="form-control border border-3 border-dark rounded-3">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label  class="fw-bold">Email</label><span class="text-danger fw-bold">*</span>
            <input type="text" wire:model.lazy="email" class="form-control border border-3 border-dark rounded-3">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        @if (auth()->user()->role_as == 1 || auth()->user()->role_as == 3)
            <div class="mb-3">
                <label  class="fw-bold">Teacher</label><span class="text-danger fw-bold">*</span>
                <select wire:model.lazy="teacher" class="form-control border border-3 border-dark rounded-3">
                    <option value=""></option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                    <option value="Clerk">Clerk</option>
                </select>
                @error('teacher') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        @endif

        <div class="float-end">
            <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center" wire:click="backButton">Close</button>
            <button type="button" wire:click="next" class="btn btn-primary rounded-3 px-3 py-2 text-center" id="next" wire:loading.attr="disabled">Next</button>
        </div>

