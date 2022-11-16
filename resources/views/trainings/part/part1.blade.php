
<div class="justify-content-center">

    <div class="progress" style="height:25px; mx-auto">
        <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
        aria-valuenow="33" aria-valuemin="0" aria-valuemax="100" style="width:33%">
          
        </div>
      </div>
</div>

<hr class="h-color mx-2 mt-3">

<div class="mb-3 mt-4">
    <label>Name</label>
    <div class="fw-bold text-lg"><p>{{auth()->user()->name}}</p></div>
</div>


<div class="mb-3">
    <label class="fw-bold">Certificate Types</label>
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
        <label class="fw-bold mt-2 ms-3">Specify The Type of Certificate:</label>
        <input type="text" wire:model="certificate_type_others" class="form-control border border-3 border-secondary rounded-3 ms-3" style="width:50%;">
    @endif
    @error('certificate_type_others') <span class="text-danger">{{ $message }}</span> @enderror
    @error('certificate_type') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Certificate Name</label>
    <input type="text" wire:model="certificate_title" class="form-control border border-3 border-secondary">
    @error('certificate_title') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Level</label>
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
        <label class="fw-bold mt-2 ms-3">Specify The Level:</label>
        <input type="text" wire:model="level_others" class="form-control border border-3 border-secondary rounded-3 ms-3" style="width:50%;">
        
    @endif
    @error('level_others') <span class="text-danger">{{ $message }}</span> @enderror
    @error('level') <span class="text-danger">{{ $message }}</span> @enderror
</div>
<div class="mb-3">
    <label class="fw-bold">Date Covered</label>
    <input type="input" wire:model="date_covered" class="form-control border border-3 border-secondary">
    @error('date_covered') <span class="text-danger">{{ $message }}</span> @enderror
</div>

<hr class="h-color mx-2 mt-3">
<div class="float-end">
    <button type="button" class="btn btn-danger rounded-3 px-3 py-2 text-center me-1" wire:click="backButton">Close</button>
    <button type="button" wire:click="part1" class="btn btn-primary rounded-3 px-3 py-2 text-center">Next</button>   
</div>