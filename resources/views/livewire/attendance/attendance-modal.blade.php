<!-- Filter Summary Attendance -->
<div wire:ignore.self class="modal fade" id="filterSummaryAttendanceModal" tabindex="-1" aria-labelledby="filterSummaryAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterSummaryAttendanceModalLabel">Filter Attendance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label  class="fw-bold">Search by Name:</label>
                    <input wire:model="name" class="form-control border border-3 rounded-3" placeholder="Search..." />
                </div>
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Competency:</label>
                        <select wire:model='competency' class="form-control border border-3 rounded-3" style="width: 100%; height: 500%">
                            <option value=""></option>
                            @php
                                $check = '';
                            @endphp
                            @forelse ($attendance as $item)
                                @if ($check == $item->competency)
                                    @continue
                                @else
                                    {{$check = $item->competency}}
                                @endif
                                <option value="{{$item->competency}}">{{$item->competency}}</option>
                            @empty
                            <option value="">Nothing</option>
                            @endforelse 
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

<!-- Print Summary Attendance -->
<div wire:ignore.self class="modal fade" id="printSummaryAttendanceModal" tabindex="-1" aria-labelledby="printSummaryAttendanceModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printSummaryAttendanceModalLabel">Download Attendance Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printall">
                <div class="modal-body">
                    <label class="fw-bold">Date Range:</label>    
                    <div class="mx-3 my-3">
                        <label class="fw-bold">Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border border-dark border-3 rounded-3"> 
                        @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mx-3 my-3">
                        <label class="fw-bold">End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border border-dark border-3 rounded-3">
                        @error('end_date') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="mx-3 my-3">
                        <label>
                            <input type="checkbox" wire:model="mySignature">
                            Include My Signature
                        </label>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Save Print</button>
                </div>
            </form>
        </div>
    </div>
</div>
