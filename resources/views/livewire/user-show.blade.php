
<div>
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12 mr-3">
                <div id="main-card">
                    @if ($click)
                        <div class="card">
                            @if($create)
                                @include('users.create')
                            @endif

                            @if($update)
                                @include('users.edit')
                            @endif

                            @if($show)
                                @include('users.show')
                            @endif
                        </div>
                    @else
                        @if (auth()->user()->role_as == 1)
                        <div class="card">
                            <div class="card-header">
                                <h4> Employees of {{$info->college_name}}
                                    <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                                </h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-bordered text-center">
                                    <table class="table table-borderd table-striped">
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
                                                <th scope="col">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($users as $user)
                                                <tr>
                                                    <td>{{ $user->user_id }}</td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->teacher }}</td>
                                                    <td>{{ $user->position }}</td>
                                                    <td>{{ $user->yearinPosition }}</td>
                                                    <td>{{ $user->yearJoined }}</td>
                                                    @if (auth()->user()->role_as == 3)
                                                        <td>{{ $college_name }}</td>
                                                    @endif
                                                    
                                                    <td>{{ $info->name }}</td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <button type="button" wire:click="editUser({{$user->user_id}})" class="btn btn-primary">
                                                                Edit
                                                            </button>
                                                            <button type="button" data-bs-toggle="modal" data-bs-target="#deleteuserModal" wire:click="deleteUser({{$user->user_id}})" class="btn btn-danger">Delete</button>
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
</div>



