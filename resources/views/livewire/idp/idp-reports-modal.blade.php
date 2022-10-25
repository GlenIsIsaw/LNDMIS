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
                    <label class="fw-bold">Sort by Name:</label>
                    <select wire:model='name' class="form-control border border-3 rounded-3" style="width: 100%; height: 500%">
                        <option value=""></option>
                        @foreach ($arrays as $name => $item)
                            <option value="{{$name}}">{{$name}}</option>
                        @endforeach
                        

                    </select>
                </div>
                <div class="modal-body">
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
                    <!-- <label class="fw-bold"> Sort by the Date Created:</label>
                    <div class="mx-3 my-3">
                        <label>Start Date</label>
                        <input type="date" wire:model="start_date" class="form-control border border-3 rounded-3">
                        <label>End Date</label>
                        <input type="date" wire:model="end_date" class="form-control border border-3 rounded-3">
                    </div>
                    -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>