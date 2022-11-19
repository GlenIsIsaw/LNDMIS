@error('benefits')<span class="text-danger">{{$message}}</span><br> @enderror
@error('benefits.*')<span class="text-danger">{{$message}}</span> @enderror
<div class="table-responsive table-bordered rounded-3 text-center">


    <table class="table table-bordered table-striped border-secondary border border-5 table-hover">
        <thead>
            <tr>
                <th>Particulars</th>
                <th colspan="4">Rating</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>
                     II. <u>BENEFITS TO THE INSTITUTION</u>
                </th>
                <td>Very Effective - 3</td>
                <td>Effective - 2</td>
                <td>Not Effective - 1</td>
                <td>N/A</td>
            </tr>

            <tr>
                <td>
                    1.	The employee demonstrates improvement in the delivery of services
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.0" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.0" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.0" value="1" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.0" >
                </td>
            </tr>
            <tr>
                <td>
                    2.	The employee demonstrate competency in performing the task assigned to his/her office
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.1" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.1" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.1" value="1" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.1" >
                </td>
            </tr>
            <tr>
                <td>
                    3.	There is an improvement in the clientele satisfaction rating.
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.2" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.2" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.2" value="1" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.2" >
                </td>
            </tr>

            <tr>
                <td>
                    4.	The training contributes to the attainment of vision of CNSC
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.3" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.3" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.3" value="1" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="benefits.3" >
                </td>
            </tr>



        </tbody>
    </table>

</div>


<div class="float-end">
    <button type="button" wire:click="back" class="btn btn-secondary me-1">Back</button>
    <button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
    <button type="button" wire:click="part2" class="btn btn-primary">Next</button>
</div>