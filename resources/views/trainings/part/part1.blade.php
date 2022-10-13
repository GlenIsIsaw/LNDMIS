
<div class="d-flex justify-content-center">
    <h6><b>Part1</b>->Part2->Part3</h6>
</div>
<div class="mb-3">
    <label>Name</label>
    <p>{{auth()->user()->name}}</p>
</div>
<div class="mb-3">
    <label>Certificate Types</label>
    <select type="text" wire:model="certificate_type" class="form-control">
        <option value="">...</option>
                <option value="Certificate of Eligibility">Certificate of Eligibility</option>
                <option value="Certificate of Training">Certificate of Training</option>
                <option value="Certificate of Appreciation">Certificate of Appreciation</option>
                <option value="Certificate of Attendance">Certificate of Attendance</option>
                <option value="Certificate of Commendation">Certificate of Commendation</option>
                <option value="Certificate of Completion">Certificate of Completion</option>
                <option value="Certificate of Participation">Certificate of Participation</option>
                <option value="Certificate of Recognition">Certificate of Recognition</option>
                <option value="Membership Certificate">Membership Certificate</option>
    </select>
    @error('certificate_type') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Certificate Name</label>
    <input type="text" wire:model="certificate_title" class="form-control">
    @error('certificate_title') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Level</label>
    <select wire:model="level" class="form-control">
        <option value="">...</option>
        <option value="International">International</option>
        <option value="Local">Local</option>
        <option value="N/A">N/A</option>
        <option value="National">National</option>
        <option value="Regional">Regional</option>
    </select>
    @error('level') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label>Date Covered</label>
    <input type="date" wire:model="date_covered" class="form-control">
    @error('date_covered') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<div class="float-end">
<button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
<button type="button" wire:click="next" class="btn btn-primary">Next</button>   
</div>