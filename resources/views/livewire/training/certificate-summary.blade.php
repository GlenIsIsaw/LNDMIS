<!-- Filter Summary Modal -->
<div wire:ignore.self class="modal fade" id="filterSummaryCertificateModal" tabindex="-1" aria-labelledby="filterSummaryCertificateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterSummaryCertificateModalLabel">Filter Certificate</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                        <div class="mb-3">
                            <label class="fw-bold">Sort by Name:</label>
                            <select wire:model='name' class="form-control border border-3 rounded-3" style="width: 100%; height: 500%">
                                <option value=""></option>
                                @php
                                    $check = '';
                                @endphp
                                @forelse ($certificate as $item)
                                    @if ($check == $item->name)
                                        @continue
                                    @else
                                        {{$check = $item->name}}
                                    @endif
                                    <option value="{{$item->name}}">{{$item->name}}</option>
                                @empty
                                <option value="">Nothing</option>
                                @endforelse 
                            </select>
                        </div>
                        <div class="mb-3">
                            <label  class="fw-bold">Search by Certificate Title:</label>
                            <select wire:model='filter_certificate_title' class="form-control border border-3 rounded-3" style="width: 100%; height: 500%">
                                <option value=""></option>
                                @php
                                    $check = '';
                                @endphp
                                @forelse ($certificate as $item)
                                    @if ($check == $item->certificate_title)
                                        @continue
                                    @else
                                        {{$check = $item->certificate_title}}
                                    @endif
                                    <option value="{{$item->certificate_title}}">{{$item->certificate_title}}</option>
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
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Show Certificate Modal -->
<div wire:ignore.self class="modal fade" id="showCertificateModal" tabindex="-1" aria-labelledby="showCertificateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="showCertificateModalLabel" class="text-break">Show {{$certificate_title}}</h5>
                <button type="button" class="btn-close mx-2 float-end card-header" data-bs-dismiss="modal" aria-label="Close"
                    wire:click="resetInput"></button>
            </div>
            <div class="modal-body">

                <img class="img-fluid justify-center" style="justify-center" src="{{ url('storage/users/'.$user_id.'/'.$certificate_name) }}?{{ rand() }}">

            </div>
        </div>
    </div>
</div>

<!-- Print Certificate Modal -->
<div wire:ignore.self class="modal fade" id="printCertificateModal" tabindex="-1" aria-labelledby="printCertificateModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printCertificateModalLabel">Print Certificates</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printAll">
                <div class="modal-body">
                    <h6>Are you sure you want to print this?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Print All</button>
                </div>
            </form>
        </div>
    </div>
</div>