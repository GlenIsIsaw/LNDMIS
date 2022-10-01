<div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Users
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#userModal">
                                Add New user
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
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
                                    <th scope="col">College</th>
                                    <th scope="col">Supervisor</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->teacher }}</td>
                                        <td>{{ $user->position }}</td>
                                        <td>{{ $user->yearinPosition }}</td>
                                        <td>{{ $user->yearJoined }}</td>
                                        <td>{{ $user->college }}</td>
                                        <td>{{ $user->supervisor }}</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#updateuserModal" wire:click="editUser({{$user->id}})" class="btn btn-primary">
                                                    Edit
                                                </button>
                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteuserModal" wire:click="deleteUser({{$user->id}})" class="btn btn-danger">Delete</button>
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
                        <div>
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>