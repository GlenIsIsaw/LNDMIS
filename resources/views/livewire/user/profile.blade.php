<div>
    @include('livewire.menu')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card">
                    @if ($state)
                        <div class="card">


                            @if($state == 'edit')
                                @include('users.edit')
                            @endif
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <div class="fw-bold fs-4 text-uppercase">
                                    {{$name}}'s Profile
                                    
                                </div>
                            </div>
                            <div class="card-title d-grid gap-2 d-md-flex justify-content-center my-5 mx-5">
                            
                                <button type="button" wire:click="editUser({{$User_id}})" class="btn-secondary text-white rounded-3 shadow text-sm text-uppercase fw-bold px-5 py-10" style="background-color: #800"><i class="fas fa-user-edit me-2"></i>Edit your profile</button>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#changePassUserModal" class="btn-secondary  text-white rounded-3 shadow-lg text-sm text-uppercase fw-bold px-5 py-10" style="background-color: #800"><i class="fas fa-edit me-2"></i></i>Change Password</button>
                            
                            
                            </div>
                            <div class="card-body">
                                
                                <h5 class ="my-3"> General Profile Section </h5>
                                <hr class="hr-color mx-3">
                                <div class="row table-responsive-sm">
                                    <div class="col">
                                        <table class="table table-sm table-borderless table-hover rounded-3">
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
                                    <div class="col my-2">
                                    <h6 class="fw-bold">Signature</h6>
                                    
                                        @if ($signature)
                                            <button type="button" wire:click="editSignature" class="text-center btn-danger rounded-3 shadow-sm px-3 py-2 mx-4 float-end"><i class="fas fa-trash-alt"></i></button>
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
                                                
                                            <button type="submit" class="btn btn-primary my-3"><i class="fas fa-upload me-2"></i>Upload</button>
                                        </form>
                                        @endif
                                        <hr class="hr-color mx-3">
                                    </div>
                                    
                                </div>
                                <hr class="hr-color mx-3">
                            </div>
                            
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('livewire.user.profile-modal')
    @include('livewire.main-modal')

    @section('script')
    <script>

        window.addEventListener('toggle', event => {
            if(document.getElementById("wrapper").classList.contains('toggled')){

                document.getElementById('main-card').className = 'vw-100';
                document.getElementById('main-card').style.paddingRight = '10%';
            }else{
                document.getElementById('main-card').className = 'w-100';
                document.getElementById('main-card').style.paddingRight = '0%';
            }
        })
        window.addEventListener('close-modal', event => {

            $('#editConfirmationUserModal').modal('hide');
            $('#changePassUserModal').modal('hide');

            
            

            $('#notificationModal').modal('hide');
            
            
        })
        window.addEventListener('show-notification', event => {

            $('#notificationModal').modal('show');
        })


    </script>

    @endsection
</div>
