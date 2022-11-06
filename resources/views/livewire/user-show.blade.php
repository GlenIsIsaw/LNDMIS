
<div>
    @include('livewire.menu')
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12 mr-3">
                <div id="main-card">
                    @if ($state)
                        <div class="card">
                            @if($state == 'create')
                                @include('users.create')
                            @endif

                            @if($state == 'edit')
                                @include('users.edit')
                            @endif

                            @if($state == 'show')
                                @include('users.show')
                            @endif
                        </div>
                    @else
                        @if (auth()->user()->role_as == 1)
                        <div class="card">
                            <div class="card-header">
                                <div class="fw-bold fs-5 text-uppercase"> Employees of {{$info['college_name']}}
                                    <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-bordered text-center">
                                    <table class="table table-bordered border-dark table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Teaching</th>
                                                <th scope="col">Position</th>
                                                <th scope="col">Year In Position</th>
                                                <th scope="col">Year Joined</th>
                                                @if (auth()->user()->role_as == 3)
                                                    <th scope="col">College</th>
                                                @endif
                                                <th scope="col">Supervisor</th>
                                                <th class="text-danger"scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $user->user_id }}</td>
                                                    <td class=" fw-bold text-uppercase">{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->teacher }}</td>
                                                    <td>{{ $user->position }}</td>
                                                    <td>{{ $user->yearinPosition }}</td>
                                                    <td>{{ $user->yearJoined }}</td>
                                                    @if (auth()->user()->role_as == 3)
                                                        <td>{{ $college_name }}</td>
                                                    @endif
                                                    
                                                    <td>{{ $info['name'] }}</td>
                                                    <td>
                                                        <div class="d-grid gap-3">
                                                            <button type="button" wire:click="editUser({{$user->user_id}})" class="btn-primary text-uppercase rounded-3 shadow-sm fw-bold px-3 py-2"><i class="fas fa-pen"></i><br>
                                                                Edit
                                                            </button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteuserModal" wire:click="deleteUser({{$user->user_id}})" class="btn-danger text-uppercase rounded-3 shadow-sm fw-bold px-3 py-2"><i class="fas fa-trash"></i><br>Delete</button>
                                                            @if ($info['name'] == 'No Supervisor')
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#supervisorModal" wire:click="getIds({{$user->user_id}},{{$user->college_id}})" class="btn-primary text-uppercase rounded-3 shadow-sm fw-bold px-3 py-2">Make a Supervisor</button>
                                                            @endif
                                                            @if ($user->user_id == $info['supId'])
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#supervisorNotModal" wire:click="getIds({{$user->user_id}},{{$user->college_id}})" class="btn-danger text-uppercase rounded-3 shadow-sm fw-bold px-3 py-2">Make not a Supervisor</button>
                                                            @endif
                                                        </div>

                                                        
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">No Record Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div>
                                    {{ $users->links() }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endif    
                </div>
            </div>
        </div>
    </div>
     
    @include('livewire.usermodal')
    @include('livewire.main-modal')

    @section('script')
    <script>

        window.addEventListener('toggle', event => {
            if(document.getElementById("wrapper").classList.contains('toggled')){

                document.getElementById('main-card').className = 'vw-100';
                document.getElementById('main-card').style.paddingRight = '15%';
            }else{
                document.getElementById('main-card').className = 'w-100';
                document.getElementById('main-card').style.paddingRight = '0%';
            }
        })
        window.addEventListener('close-modal', event => {

            $('#userModal').modal('hide');
            $('#updateuserModal').modal('hide');
            $('#deleteuserModal').modal('hide');
            $('#createConfirmationUserModal').modal('hide');
            $('#editConfirmationUserModal').modal('hide');
            $('#changePassUserModal').modal('hide');
            $('#supervisorModal').modal('hide');
            $('#supervisorNotModal').modal('hide');

            
            

            $('#notificationModal').modal('hide');
            
            
        })
        window.addEventListener('show-notification', event => {

            $('#notificationModal').modal('show');
        })
        window.addEventListener('confirmation-create-training', event => {

            $('#createConfirmationTrainingModal').modal('show');
        })


    </script>

    @endsection
</div>



