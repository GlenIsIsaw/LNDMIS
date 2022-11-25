@error('realization')<span class="text-danger">{{$message}}</span><br> @enderror
@error('realization.*')<span class="text-danger">{{$message}}</span> @enderror
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
                     III. <u>REALIZATION OF THE PERSONAL ACTION PLAN</u>
                </th>
                <td>Very Effective - 3</td>
                <td>Effective - 2</td>
                <td>Not Effective - 1</td>
                <td>N/A</td>
            </tr>

            <tr>
                <td>
                    1.	Employee conducted re-echo seminar to his/her peers
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.0" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.0" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.0" value="1" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.0">
                </td>
            </tr>
            <tr>
                <td>
                    2.	Employee conducted re-echo through informal talk.
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.1" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.1" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.1" value="1" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.1">
                </td>
            </tr>
            <tr>
                <td>
                    3.	Co-employees benefited from the re-echo
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.2" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.2" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.2" value="1" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="realization.2">
                </td>
            </tr>



        </tbody>
    </table>

</div>

<div class="float-end">
    <button type="button" wire:click="back" class="btn btn-secondary me-1" id="back" wire:loading.attr="disabled">Back</button>
    <button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
    <button type="button" wire:click="part3" class="btn btn-primary" id="part3" wire:loading.attr="disabled">Next</button>
</div>