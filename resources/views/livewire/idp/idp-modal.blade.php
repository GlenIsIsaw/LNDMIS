
<!-- Show Comment -->
<div wire:ignore.self class="modal fade" id="showCommentModal" tabindex="-1" aria-labelledby="showCommentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" class="text-uppercase">
                <h5 class="modal-title" class="text-uppercase"  id="showCommentModalLabel">COMMENT</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        
                        <p class = "fst-normal lh-base mt-3">{{$comment}}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div wire:ignore.self class="modal fade" id="deleteIdpModal" tabindex="-1" aria-labelledby="deleteIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteIdpModalLabel">Delete the IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body">
                    <h4>Are you sure you want to delete this IDP ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-3 py-2 text-center">Yes! Delete IDP</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Submit IDP Modal -->
<div wire:ignore.self class="modal fade" id="submitIdpModal" tabindex="-1" aria-labelledby="submitIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submitIdpModalLabel">Submit IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="submit">
                <div class="modal-body">
                    <h4>Are you sure you want to submit your input ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-3 py-2 text-center">Yes! Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Remove Submit Idp Modal -->
<div wire:ignore.self class="modal fade" id="removeSubmissionIdpModal" tabindex="-1" aria-labelledby="removeSubmissionIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="removeSubmissionIdpModalLabel">Remove Submission of IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="removeSubmit">
                <div class="modal-body">
                    <h4>Are you sure you want to remove your submission ?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-3 py-2 text-center">Yes! Remove Submission</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Print IDP Modal -->
<div wire:ignore.self class="modal fade" id="printIdpModal" tabindex="-1" aria-labelledby="printIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="printIdpModalLabel">Download IDP</h5>
               
            </div>
            <form wire:submit.prevent="download">
                <div class="modal-body text-capitalize">
                    <h4>Are you sure you want to Download this IDP?</h4>
                    @if ($checkmySignature)
                        <label>
                            <input type="checkbox" wire:model="mySignature">
                            Include My Signature
                        </label>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-3 py-2 text-center">Yes! Download</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Print All IDP Modal -->
<div wire:ignore.self class="modal fade" id="printAllIdpModal" tabindex="-1" aria-labelledby="printAllIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase fw-bold" id="printAllIdpModalLabel">Download IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="printall">
                <div class="modal-body text-capitalize">
                    <h4>Are you sure you want to Download all of this IDP?</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Yes! Download</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Approve IDP Modal -->
<div wire:ignore.self class="modal fade" id="approveIdpModal" tabindex="-1" aria-labelledby="approveIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="approveIdpModalLabel">Approve the Submitted Idp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="approve">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Approve this Submission ?</h4>
                        <label>Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control border border-3 border-dark rouned-3"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-3 py-2 text-center">Yes! Approve</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Reject IDP Modal -->
<div wire:ignore.self class="modal fade" id="rejectIdpModal" tabindex="-1" aria-labelledby="rejectIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rejectIdpModalLabel">Reject the Submitted Idp</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal"
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="reject">
                <div class="modal-body">
                    <div class="mb-3">
                        <h4>Are you sure you want to Reject this Submission ?</h4>
                        <label>Comment:</label>
                        <textarea wire:model="comment" rows="4" cols="50" class="form-control border border-3 border-dark rounded-3"></textarea>
                        @error('comment') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center" wire:click="closeModal"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-3 py-2 text-center">Yes! Reject</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Create Confirmation IDP Modal -->
<div wire:ignore.self class="modal fade" id="createConfirmationIdpModal" tabindex="-1" aria-labelledby="createConfirmationIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createConfirmationIdpModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="store">
                <div class="modal-body">
                    <h6>Are you sure you want to save your input?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-3 py-2 text-center">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Confirmation IDP Modal -->
<div wire:ignore.self class="modal fade" id="editConfirmationIdpModal" tabindex="-1" aria-labelledby="editConfirmationIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editConfirmationIdpModalLabel">Confirmation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" 
                    aria-label="Close"></button>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body">
                    <h6>Are you sure you want to edit your IDP info?</h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary rounded-3 px-3 py-2 text-center">Yes! Save Input</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- View Idp Modal -->
<div wire:ignore.self class="modal fade" id="getIdpsModal" tabindex="-1" aria-labelledby="getIdpsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="getIdpsModalLabel">Remove Submission of IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    {{$idp_id}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Guide Idp Modal -->
<div wire:ignore.self class="modal fade" id="guideIdpModal" tabindex="-1" aria-labelledby="guideIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="guideIdpModalLabel">Guide in Accomplishing Individual Development Plan (IDP)</h5>
                
            </div>
                <div class="modal-body text-md-start">
                    <p class="lh-base">
                        Based on the competency assessment of individual, there are options for the purpose in doing the IDP so that the College Dean or Head of the Office will be able to focus on the appropriate learning and development interventions that employees may undertake.
                    </p>
                    <hr class="h-color mx-2"> 
                    <p>
                        <div class="fw-bolder mb-1">Target Competency (IDP Column 1) </div>This refers to the areas of competencies for development in their field of specialization as seen by the employees. 
                        Maximum of three target competencies shall be indicated to measure that they will be attained within the given period, however, if the one of the target interventions is directly needed for the designated position, there is no need to indicate it in the said document (IDP).

                    </p>
                    <hr class="h-color mx-2"> 
                    <p>
                        <div class="fw-bolder mb-1">S/U/G Priorities (IDP Column 2)</div> Approved set of criteria stated in the Learning and Development Plan (S-seriousness, U-urgency, G-growth priorities)
                        Seriousness - refers to the direct impact of learning need to organization's strategic directions
                        Urgency - answers the question of how immediate must the learning need be addressed
                        Growth Potential - pertains to the extent to which the learning need may give rise to more problems it not addressed
                        
                    </p>
                    <hr class="h-color mx-2"> 
                    <p>
                        <div class="fw-bolder mb-1"> Development Activity (IDP Column 3) </div> It considers a variety of developmental approaches of one or more specific actions to take to meet the individual's objective

                        
                    </p>
                    <hr class="h-color mx-2"> 
                    <p>
                        <div class="fw-bolder mb-1">Target Completion Date (IDP Column 4) </div> Refers to the schedule or completion date of the development activity
                    </p>
                    <hr class="h-color mx-2"> 
                    <p>
                        <div class="fw-bolder mb-1">Person Responsible (IDP Column 5) </div> A person or an office, whether internal or external, to assist in the chosen Development Activity.
                    </p>
                    <hr class="h-color mx-2"> 
                    <p>
                        <div class="fw-bolder mb-1"> Support Needed (IDP Column 6)</div> The resources and assistance needed by an employee to accomplish the L&D intervention.
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>

<!-- Filter Modal -->
<div wire:ignore.self class="modal fade" id="filterIdpModal" tabindex="-1" aria-labelledby="filterIdpModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterIdpModalLabel">Filter IDP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Competency:</label>
                        <select wire:model='filter_competency' class="form-control border border-dark border-3 rounded-3" style="width: 100%; height: 500%">
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
                        <label class="fw-bold">Sort by Completion Status:</label>
                        <select wire:model="filter_completion_status" class="form-control border border-dark border-3 rounded-3">
                            <option value="">...</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Sort by Status:</label>
                        <select wire:model="filter_status" class="form-control border border-dark border-3 rounded-3">
                            <option value="">...</option>
                            <option value="Approved">Approved</option>
                            <option value="Not Submitted">Not Submitted</option>
                            <option value="Rejected">Rejected</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <label class="fw-bold"> Sort by the Year:</label>
                    <div class="">
                        <select wire:model='year_table' class="fw-bold fs-4 border border-3 border-dark rounded-3 px-5 py-2">
                            <option value=""></option>
                            @for ($i = 2015; $i <= date('Y') + 1; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                            @endfor
                            

                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center"
                        data-bs-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>




