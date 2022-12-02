<div class="justify-content-center mt-4">

    
    <div class="progress" style="height:25px; mx-4">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
        aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%">
          
        </div>
      </div>
</div>



<hr class="h-color mx-2 mt-3">
        @if (auth()->user()->role_as == 3)
            <div class="mb-3">
                <label class="fw-bold">College</label>
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
            <label class="fw-bold">Name</label>
            <input type="text" wire:model.lazy="name" class="form-control border border-3 border-dark rounded-3">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label  class="fw-bold">Email</label>
            <input type="text" wire:model.lazy="email" class="form-control border border-3 border-dark rounded-3">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        @if (auth()->user()->role_as == 1 || auth()->user()->role_as == 3)
            <div class="mb-3">
                <label  class="fw-bold">Teacher</label>
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

