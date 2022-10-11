
<div>
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                @if (session()->has('message'))
                    <h5 class="alert alert-success">{{ session('message') }}</h5>
                @endif
                @if ($click)
                    <div class="card">
                        @if($create)
                            @include('idp.create')
                        @endif
                        @if($update)
                            @include('idp.edit')
                        @endif
                        @if($show)
                            @include('idp.show')
                        @endif
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            <h4>
                                {{$table}}
                                <input type="search" wire:model="search" class="form-control float-end mx-2" placeholder="Search..." style="width: 230px" />
                            </h4>
                        </div>

                        <div class="card-header bg-transparent border-0">
                                
                                
                                <div class="float-end mx-2">
                                    <label>Sort By</label>
                                    <select wire:model="filterStatus" class="text-center text-center border border-dark border-2 rounded">
                                        <option value="All">Default</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Not Submitted">Not Submitted</option>
                                        <option value="Rejected">Rejected</option>
                                        <option value="Pending">Pending</option>
                                    </select>
                                </div>
                                </div>

                                <div class="card-body text-center">
                            <div class="table-responsive table-bordered">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="table-bordered">
                                            <th scope="col">Name</th>
                                            <th scope="col">Competency</th>
                                            <th scope="col">Completion Status</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Updated At</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($idps as $idp)
                                            <tr>
                                                <td>{{$idp->name}}</td>
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
                                                <td>{{ $idp->submit_status }}</td>
                                                <td>
                                                    <button type="button" wire:click="show({{$idp->idp_id}})" class="btn btn-info">View</button>
                                                    @if ($idp->comment)
                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#showCommentModal" wire:click="showComment({{$idp->idp_id}})" class="btn btn-info">View Comment</button>
                                                    @endif


                                                    @if ($idp->submit_status != 'Approved')
                                                        @if ($idp->submit_status == 'Pending')
                                                            @if (auth()->user()->role_as == 1)
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#approveIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn btn-success">Approve</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#rejectIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn btn-danger">Reject</button>
                                                            @endif    
                                                        @endif

                                                            @if ($idp->submit_status == 'Not Submitted' || $idp->submit_status == 'Rejected')
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#submitIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn btn-success">Submit</button>

                                                                
                                                            @endif
                                                            @if ($idp->submit_status == 'Pending')
                                                                @if (auth()->user()->role_as == 0)
                                                                    <button type="button" data-bs-toggle="modal" data-bs-target="#removeSubmissionIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn btn-danger">Remove Submission</button>
                                                                @endif    
                                                            @else
                                                                <button type="button" wire:click="edit({{$idp->idp_id}})" class="btn btn-primary">Edit</button>
                                                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteIdpModal" wire:click="getId({{$idp->idp_id}})" class="btn btn-danger mx-2">Delete</button>
                                                            @endif
                                                    @endif
                                                    
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="10">No Record Found</td>
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
                @endif
            </div>
        </div>
    </div>
    @include('livewire.idp.idp-modal')
</div>
