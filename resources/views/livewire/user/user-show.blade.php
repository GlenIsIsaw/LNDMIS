
<div>
    @include('livewire.menu')
    <div class="container py-2">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card">
                    @if ($state)
                        <div class="card">
                            @if($state == 'create')
                                @include('users.create')
                            @endif

                            @if($state == 'edit')
                                @include('users.edit')
                            @endif

                            @if($state == 'college')
                                @include('college.show')
                            @endif
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <div class="fw-bold fs-5 text-uppercase"> Employees of @if (auth()->user()->role_as == 1) {{$info['college_name']}} @endif
                                    @if (auth()->user()->role_as == 3)
                                        <select wire:model='filter_college' class="border border-3 border-dark rounded-3">
                                            <option value=""></option>
                                            @foreach ($dept_name as $item)
                                                <option value="{{ $item }}">{{ $item }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                    <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 265px" />
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive rounded-3  text-center">
                                    <table class="table  border border-secondary border-5 table-striped table-hover">
                                        <thead class="text-dark align-bottom" style="background-color:#FEFCFF;">
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
                                                @else
                                                    <th scope="col">Supervisor</th>
                                                @endif
                                                
                                                <th scope="col">Status</th>
                                                <th class="scope="col style="Color: #800">Actions</th>
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
                                                        <td>{{ $user->college_name }}</td>
                                                    @else
                                                        <td>{{ $info['name'] }}</td>
                                                    @endif
                                                    
                                                    
                                                    <td>
                                                        @php
                                                            $array =  [1=>'Active', 0=>'Disabled'];
                                                        @endphp
                                                        
                                                        @if ($array[$user->user_status] == 'Active')
                                                        <p class="badge badge-pill fs-6 bg-success text-white">Active</p>
                                                            
                                                        @endif

                                                        @if ($array[$user->user_status] == 'Disabled')
                                                        <p class="badge badge-pill fs-6 bg-danger text-white">Disabled</p>
                                                        @endif

                                                       
                                                    </td>
                                                    <td>
                                                        <div class="d-grid gap-3">
                                                            <button type="button" wire:click="editUser({{$user->user_id}})" class="btn-info text-white text-uppercase rounded-3 shadow-lg fw-bold px-3 py-2" style="background-image: linear-gradient(
                                                                to bottom, #000046, 
                                                                #1CB5E0);"><i class="fas fa-pen me-1"></i>
                                                                Edit
                                                            </button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#resetPassModal" wire:click="deleteUser({{$user->user_id}})" class="btn-info text-white text-uppercase rounded-3 shadow-lg fw-bold" style="background-image: linear-gradient(
                                                                to bottom, #000046, 
                                                                #1CB5E0);font-size:13px; padding:11px 11px 11px 11px;"><i class="fas fa-redo-alt me-1"></i>
                                                                Reset Password
                                                            </button>
                                                            @if ($user->user_status)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteuserModal" wire:click="deleteUser({{$user->user_id}})" class="btn-danger text-white text-uppercase rounded-3 shadow-lg fw-bold" style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05); font-size:14px; padding:11px 11px 11px 11px;"><i class="fas fa-user-times me-1"></i>Disable</button>
                                                            @else
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteuserModal" wire:click="deleteUser({{$user->user_id}})" class="btn-success text-white text-uppercase rounded-3 shadow-lg fw-bold px-3 py-2" style="background-image: linear-gradient(
                                                                    to bottom, #008000,
                                                                    #190A05);font-size:14px; padding:11px 11px 11px 11px;"><i class="fas fa-user-check me-1"></i>Enable</button>
                                                            @endif
                                                            @if (auth()->user()->role_as == 1)
                                                                @if ($info['name'] == 'No Supervisor')
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#supervisorModal" wire:click="getIds({{$user->user_id}},{{$user->college_id}})" class="btn-success text-white text-uppercase rounded-3 shadow-sm fw-bold" style="background-image: linear-gradient(
                                                                    to bottom, #008000,
                                                                    #190A05);font-size:13px; padding:11px 20px 11px 20px;"><i class="fas fa-check me-1"></i>Enable as Supervisor</button>
                                                                @endif
                                                                @if ($user->user_id == $info['supId'])
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#supervisorNotModal" wire:click="getIds({{$user->user_id}},{{$user->college_id}})" class="btn-danger text-white text-uppercase rounded-3 shadow-sm fw-bold px-3 py-2"  style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05); font-size:13px; padding:11px 20px 11px 20px;"><i class="fas fa-times me-1"></i>Remove as Supervisor</button>
                                                                @endif
                                                            @endif
                                                            @if (auth()->user()->role_as == 3)
                                                                @if ($user->role_as == 1)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#coordinatorNotModal" wire:click="getIds({{$user->user_id}},{{$user->college_id}})" class="btn-danger text-white text-uppercase rounded-3 shadow-sm fw-bold px-3 py-2"  style="background-image: linear-gradient(
                                                                    to bottom, #870000,
                                                                    #190A05); font-size:13px; padding:11px 20px 11px 20px;"><i class="fas fa-times me-1"></i>Remove as Coordinator</button>
                       
                                                                @endif
                                                                @if ($this->coorCheck($user->college_id))
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#coordinatorModal" wire:click="getIds({{$user->user_id}},{{$user->college_id}})" class="btn-success text-white text-uppercase rounded-3 shadow-sm fw-bold" style="background-image: linear-gradient(
                                                                    to bottom, #008000,
                                                                    #190A05);font-size:13px; padding:11px 20px 11px 20px;"><i class="fas fa-check me-1"></i>Enable as Coordinator</button>
                                                                @endif
                                                                

                                                            @endif

                                                        </div>

                                                        
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="11">No Record Found</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div> 
                                <div>
                                    <div class="d-flex justify-content-center">
                                    {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endif    
                </div>
            </div>
        </div>
    </div>
     
    @include('livewire.user.usermodal')
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

            $('#userModal').modal('hide');
            $('#updateuserModal').modal('hide');
            $('#deleteuserModal').modal('hide');
            $('#createConfirmationUserModal').modal('hide');
            $('#editConfirmationUserModal').modal('hide');
            $('#changePassUserModal').modal('hide');
            $('#supervisorModal').modal('hide');
            $('#supervisorNotModal').modal('hide');
            $('#coordinatorModal').modal('hide');
            $('#coordinatorNotModal').modal('hide');
            $('#resetPassModal').modal('hide');

             
            

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



