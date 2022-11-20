<!-- Filter Summary Idp -->
<div wire:ignore.self class="modal fade" id="filterSummaryIdpModal" tabindex="-1" aria-labelledby="filterSummaryIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterSummaryIdpModalLabel">Filter IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label  class="fw-bold">Search by Name:</label>
                    <input type="search" wire:model="name" class="form-control border border-3 rounded-3" placeholder="Search..." />
                </div>
                <div class="mb-3">
                    <label class="fw-bold">Sort by Person Responsible:</label>
                    <select wire:model='responsible' class="form-control border border-3 rounded-3" style="width: 100%; height: 500%">
                        <option value=""></option>
                        <option value="Immediate Supervisor">Immediate Supervisor</option>
                        <option value="VPAA">VPAA</option>
                        <option value="VPAF">VPAF</option>
                        <option value="VPRE">VPRE</option>
                    </select>
                </div>
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Competency:</label>
                        <select wire:model='competency' class="form-control border border-3 rounded-3" style="width: 100%; height: 500%">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Sort by SUG:</label>
                        <select wire:model="sug" class="form-control border border-3 rounded-3" style="width: 100%; height: 500%">
                            <option value=""></option>
                            <option value="S">S</option>
                            <option value="U">U</option>
                            <option value="G">G</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Status:</label>
                        <select wire:model="filter_status" class="form-control border border-3 rounded-3">
                            <option value="">...</option>
                            <option value="Approved">Approved</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Print Summary Idp -->
<div wire:ignore.self class="modal fade" id="printSummaryIdpModal" tabindex="-1" aria-labelledby="printSummaryIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-uppercase" id="printSummaryIdpModalLabel">Download Summary</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printall">
                <div class="modal-body">
                    <h5 class="text-capitalize mb-3">Are you sure you want to Download the summary of year {{$year}}?</h5>
                    <label>
                        <input type="checkbox" wire:model="mySignature" class="text-uppercase ms-2 mb-3">
                        Include My Signature
                    </label>
                    <br>
                    <label>
                        <input type="checkbox" wire:model="supSignature" class="text-uppercase ms-2"> 
                        Include My Supervisor's Signature
                    </label>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Download</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Competency Summary Idp -->
<div wire:ignore.self class="modal fade" id="compSummaryIdpModal" tabindex="-1" aria-labelledby="compSummaryIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="compSummaryIdpModalLabel">Competencies Count</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Target Competency</th>
                                <th>Count</th>
                            </tr>
                            @forelse ($competencies as $comp => $count)
                                <tr>
                                    <td>{{$comp}}</td>
                                    <td>{{$count}}</td>
                                </tr>
                            @empty
                                <tr>No Records</tr>
                            @endforelse
                                <tr>
                                    <th>Total</th>
                                    <th>{{array_sum($competencies)}}</th>
                                </tr>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Print Tnm Idp -->
<div wire:ignore.self class="modal fade" id="printTnmModal" tabindex="-1" aria-labelledby="printTnmModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-uppercase" id="printTnmModalLabel">Download TNM Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printTnmReports">
                <div class="modal-body">
                    <h6>Are you sure you want to download the TNM Reports</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Download</button>
                </div>
            </form>
        </div>
    </div>
</div>