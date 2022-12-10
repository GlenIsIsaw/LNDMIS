<!-- Filter Summary Modal -->
<div wire:ignore.self class="modal fade" id="filterSummaryTrainingModal" tabindex="-1" aria-labelledby="filterSummaryTraningModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterSummaryTrainingModalLabel">Filter Training</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label  class="fw-bold">Search by Name:</label>
                        <input wire:model="name" class="form-control border border-3 rounded-3" placeholder="Search..." />
                    </div>

                        <div class="mb-3">
                            <label  class="fw-bold">Search by Certificate Title:</label>
                            <input wire:model="filter_certificate_title" class="form-control border border-3 rounded-3" placeholder="Search..." />
                        </div>
                     
                    <div class="mb-3">
                        @php
                        $data = [];
                            foreach ($seminar as $item){
                                foreach ($item as $name => $value){
                                    if ($name == 'certificate_type'){
                                        array_push($data, $value);
                                    }
                                }   
                            }
                        @endphp
                        <label class="fw-bold">Sort by Certificate Type:</label>
                        <select type="text" wire:model="filter_certificate_type" class="form-control border border-3 rounded-3">
                            <option value="">...</option>
                            @foreach (array_unique($data) as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        @php
                        $data = [];
                            foreach ($seminar as $item){
                                foreach ($item as $name => $value){
                                    if ($name == 'seminar_type'){
                                        array_push($data, $value);
                                    }
                                }   
                            }
                        @endphp
                        <label class="fw-bold">Sort by Seminar Type:</label>
                        <select type="text" wire:model="filter_seminar_type" class="form-control border border-3 rounded-3">
                            <option value="">...</option>
                            @foreach (array_unique($data) as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        @php
                        $data = [];
                            foreach ($seminar as $item){
                                foreach ($item as $name => $value){
                                    if ($name == 'level'){
                                        array_push($data, $value);
                                    }
                                }   
                            }
                        @endphp
                        <label class="fw-bold">Sort by Level:</label>
                        <select wire:model="filter_level" class="form-control border border-3 rounded-3">
                            <option value="">...</option>
                            @foreach (array_unique($data) as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        @php
                        $data = [];
                            foreach ($seminar as $item){
                                foreach ($item as $name => $value){
                                    if ($name == 'type'){
                                        array_push($data, $value);
                                    }
                                }   
                            }
                        @endphp
                        <label class="fw-bold">Sort by Type:</label>
                        <select wire:model="filter_type" class="form-control border border-3 rounded-3">
                            <option value="">...</option>
                            @foreach (array_unique($data) as $item)
                                <option value="{{ $item }}">{{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    
                    <label class="fw-bold">Sort by Date Covered:</label>    
                    <div class="mx-3 my-3">
                        <label>Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border border-3 rounded-3"> 

                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border border-3 rounded-3">
                    </div>
                    


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Filter Summary Modal -->
<div wire:ignore.self class="modal fade" id="printTrainingModal" tabindex="-1" aria-labelledby="printTrainingModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="printTrainingModalLabel">Download Trainings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printAll">
                <div class="modal-body">
                    <h6 class="text-capitalize mb-3">Date Range:</h6>
                    <div class="mb-3 mx-3">
                        <label class="fw-bold">Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border-dark border-3">
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-3 mx-3">
                        <label class="fw-bold">End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border-dark border-3">
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="mx-3">
                        <label>
                            <input class="border-dark border-3" type="checkbox" wire:model="mySignature">
                            Include My Signature
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Print All</button>
                </div>
            </form>
        </div>
    </div>
</div>

