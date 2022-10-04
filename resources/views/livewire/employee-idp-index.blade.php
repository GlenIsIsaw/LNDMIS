<div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h4>Individual Development Plan
                            <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#createIdpModal">
                                Add New idp
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <label>Start Date</label>
                                <input type="date" wire:model="start_date">
                                <label>End Date</label>
                                <input type="date" wire:model="end_date">
                                
                            </div>
                            <div class="col"></div>
                            <div class="col"></div>
                            <div class="col">
                                <label>Filter By Status</label>
                                <select wire:model="filterStatus">
                                    <option value=""></option>
                                    <option value="Approved">Approved</option>
                                    <option value="Not Submitted">Not Submitted</option>
                                    <option value="Rejected">Rejected</option>
                                    <option value="Pending">Pending</option>
                                  </select>
                            </div>
                          </div>
                        <div class="table-responsive">
                            <table class="table table-borderd table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Competency</th>
                                        <th scope="col">Completion Status</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Comment</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($idps as $idp)
                                        <tr>
                                            <td><button type="button" data-bs-toggle="modal" data-bs-target="#showIdpModal" wire:click="show({{$idp->idp_id}})" class="btn btn-link">{{$idp->name}}</button></td>
                                            <td>
                                                <ol class="list-group list-group-numbered">
                                                    @foreach ($idp->competency as $item)
                                                        <li class="list-group-item">{{$item}}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td>
                                                <ol class="list-group list-group-numbered">
                                                    @foreach ($idp->status as $item)
                                                        <li class="list-group-item">{{$item}}</li>
                                                    @endforeach
                                                </ol>
                                            </td>
                                            <td>{{ $idp->created_at }}</td>
                                            <td>{{ $idp->updated_at }}</td>
                                            <td>{{ $idp->comment }}</td>
                                            <td>{{ $idp->submit_status }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#updateIdpModal" wire:click="edit({{$idp->idp_id}})" class="btn btn-primary">Edit</button>
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#deleteIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn btn-danger">Delete</button>
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
                            {{ $idps->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.idp.idp-modal')
</div>
