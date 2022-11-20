<!-- Print IDP Completion Report -->
<div wire:ignore.self class="modal fade" id="printIdpCompModal" tabindex="-1" aria-labelledby="printIdpCompModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold text-uppercase" id="printIdpCompModalLabel">IDP Completion Reports</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="download">
                <div class="modal-body">
                    <h6>Are you sure you want to download the IDP Completion Reports</h6>
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