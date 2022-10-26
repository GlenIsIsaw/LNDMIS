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
                        @foreach ($Idp as $idp)
                            <option value="{{$idp->name}}">{{$idp->name}}</option>
                        @endforeach
                        

                    </select>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>