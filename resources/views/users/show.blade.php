<div class="card-header">
    <h4>
        {{$name}}'s Profile
        <button type="button" wire:click="editUser({{$User_id}})" class="btn-secondary text-white rounded-3 shadow text-sm text-uppercase fw-bold px-5 py-10 float-end" style="background-color: #800">Edit</button>
        <button type="button" data-bs-toggle="modal" data-bs-target="#changePassUserModal" class="btn btn-danger">Change Password</button>
    </h4>
</div>
<div class="card-body">
    <div class="row">
        <div class="col">
            <table class="table table-sm table-bordered border border-2 border-dark">
                <tr>
                    <th>Name</th>
                    <td class="text-center">{{$name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td class="text-center">{{$email}}</td>
                </tr>
                <tr>
                    <th>College</th>
                    <td class="text-center">{{$info['college_name']}}</td>
                </tr>
                <tr>
                    <th>Supervisor</th>
                    <td class="text-center">{{$info['name']}}</td>
                </tr>
                <tr>
                    <th>Teacher</th>
                    <td class="text-center">{{$teacher}}</td>
                </tr>
                <tr>
                    <th>Date Joined</th>
                    <td class="text-center">{{$yearJoined}}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td class="text-center">{{$position}}</td>
                </tr>
                <tr>
                    <th>Date In Position</th>
                    <td class="text-center">{{$yearinPosition}}</td>
                </tr>
            </table>
        </div>
        <div class="col">
          <h6>Signature</h6>
          
            @if ($signature)
                <button type="button" wire:click="editSignature" class="float-end">Delete Signature</button>
                <img class="img-fluid" src="{{ url('storage/users/'.$User_id.'/'.$signature) }}?{{ rand() }}" alt="No Signature">
            @else
            <form wire:submit.prevent="addSignature">
                <div
                x-data="{ isUploading: false, progress: 0 }"
                x-on:livewire-upload-start="isUploading = true"
                x-on:livewire-upload-finish="isUploading = false"
                x-on:livewire-upload-error="isUploading = false"
                x-on:livewire-upload-progress="progress = $event.detail.progress"
                >
                    <input type="file" wire:model="photo" accept="image/*" class="form-control border border-3 border-secondary">
                    <div wire:loading wire:target="photo">
                        <div x-show="isUploading">
                            <progress max="100" x-bind:value="progress"></progress>
                        </div>
                    </div>
                    
                </div>
                @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                    
                <button type="submit" class="btn btn-primary">Upload Signature</button>
            </form>
            @endif
          
        </div>

      </div>
</div>
