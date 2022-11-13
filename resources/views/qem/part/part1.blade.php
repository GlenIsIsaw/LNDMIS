@error('content')<span class="text-danger">{{$message}}</span><br> @enderror
@error('content.*')<span class="text-danger">{{$message}}</span> @enderror
<div class="table-responsive table-bordered rounded-3 text-center">


    <table class="table table-bordered table-striped border-secondary border border-5 table-hover">
        <thead>
            <tr>
                <th>Particulars</th>
                <th colspan="3">Rating</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>
                     I. <u>CONTENT AND RELEVANCE OF THE SEMINAR</u>
                </th>
                <td>Very Effective - 3</td>
                <td>Effective - 2</td>
                <td>Not Effective - 1</td>
            </tr>

            <tr>
                <td>
                    1.	The training is relevant to the mandate of the institution.
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.0" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.0" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.0" value="1" >
                </td>
            </tr>
            <tr>
                <td>
                    2.	The objectives of the training are function of the office/unit.
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.1" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.1" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.1" value="1" >
                </td>
            </tr>
            <tr>
                <td>
                    3.	The employee is capable in performing the acquired knowledge to his/her office.
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.2" value="3" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.2" value="2" >
                </td>
                <td>
                    <input class="form-check-input" type="radio" wire:model="content.2" value="1" >
                </td>
            </tr>



        </tbody>
    </table>

</div>


<div class="float-end">
    <button type="button" class="btn btn-danger" wire:click="backButton">Close</button>
    <button type="button" wire:click="part1" class="btn btn-primary">Next</button>
</div>