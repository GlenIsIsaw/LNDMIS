
<div class="justify-content-center">

   
</div>


<div class="mb-3">
    <label class="fw-bold">Certificate Types</label><span class="text-danger fw-bold">*</span>
    <select type="text" wire:model="certificate_type" class="form-control border border-3 border-secondary">
        <option value="{{$certificate_type}}">{{$certificate_type}}</option>
                <option value="Certificate of Eligibility">Certificate of Eligibility</option>
                <option value="Certificate of Training">Certificate of Training</option>
                <option value="Certificate of Appreciation">Certificate of Appreciation</option>
                <option value="Certificate of Attendance">Certificate of Attendance</option>
                <option value="Certificate of Commendation">Certificate of Commendation</option>
                <option value="Certificate of Completion">Certificate of Completion</option>
                <option value="Certificate of Participation">Certificate of Participation</option>
                <option value="Certificate of Recognition">Certificate of Recognition</option>
                <option value="Membership Certificate">Membership Certificate</option>
                <option value="Others">Others</option>
    </select>
    @if ($certificate_type == 'Others')
        <label class="fw-bold mt-2 ms-3">Specify The Type of Certificate:</label><span class="text-danger fw-bold">*</span>
        <input type="text" wire:model.lazy="certificate_type_others" class="form-control border border-3 border-secondary rounded-3 ms-3" style="width:50%;">
    @endif
    @error('certificate_type_others') <span class="text-danger">{{ $message }}</span> @enderror
    @error('certificate_type') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Certificate Title</label><span class="text-danger fw-bold">*</span>
    <input type="text" wire:model.lazy="certificate_title" class="form-control border border-3 border-secondary">
    @error('certificate_title') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="mb-3">
    <label class="fw-bold">Seminar Type</label><span class="text-danger fw-bold">*</span>
    <select type="text" wire:model="seminar_type" class="form-control border border-3 border-secondary">
        <option value="{{$seminar_type}}">{{$seminar_type}}</option>
                <option value="Research Related Training">Research Related Training</option>
                <option value="Personal Development Training">Personal Development Training</option>
                <option value="Professional Development Training">Professional Development Training</option>
                <option value="Extension Related Training">Extension Related Training</option>
                <option value="Others">Others</option>
    </select>
    @if ($seminar_type == 'Others')
        <label class="fw-bold mt-2 ms-3">Specify The Type of Seminar:</label><span class="text-danger fw-bold">*</span>
        <input type="text" wire:model.lazy="seminar_type_others" class="form-control border border-3 border-secondary rounded-3 ms-3" style="width:50%;">
    @endif
    @error('seminar_type_others') <span class="text-danger">{{ $message }}</span> @enderror
    @error('seminar_type') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Level</label><span class="text-danger fw-bold">*</span>
    <select wire:model="level" class="form-control border border-3 border-secondary">
        <option value="{{$level}}">{{$level}}</option>
        <option value="International">International</option>
        <option value="Local">Local</option>
        <option value="N/A">N/A</option>
        <option value="National">National</option>
        <option value="Regional">Regional</option>
        <option value="Others">Others</option>
    </select>
    @if ($level == 'Others')
        <label class="fw-bold mt-2 ms-3">Specify The Level:</label><span class="text-danger fw-bold">*</span>
        <input type="text" wire:model.lazy="level_others" class="form-control border border-3 border-secondary rounded-3 ms-3" style="width:50%;">
        
    @endif
    @error('level_others') <span class="text-danger">{{ $message }}</span> @enderror
    @error('level') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Date of Completion</label><span class="text-danger fw-bold">*</span>
    <input type="date" wire:model.lazy="date_covered" class="form-control border border-3 border-secondary">

    <label class="fw-bold mt-2 ms-3">Specify the Date:</label>
    <input type="text" wire:model.lazy="specify_date" class="form-control border border-3 border-secondary rounded-3 ms-3" placeholder="Optional" style="width:50%;">
    @error('date_covered') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<hr class="h-color mx-2 mt-3">
<div class="float-end">
    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1" wire:click="backButton">Close</button>
    <button type="button" wire:click="part1" class="btn btn-primary rounded-3 px-3 py-2 text-center" id="part1" wire:loading.attr="disabled">Next</button>   
</div>