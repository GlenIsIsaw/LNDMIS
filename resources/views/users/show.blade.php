<div class="card-header">
    <h4>
        {{$name}}'s Profile
        <button type="button" wire:click="editUser({{$User_id}})" class="btn-primary rounded-3 shadow fw-bold px-5 py-2 float-end">Edit</button>
    </h4>
</div>
<div class="card-body">
    <div class="row">
        <div class="col">
            <table class="table table-sm table-bordered border border-2 border-dark">
                <tr>
                    <th>Name</th>
                    <td class="text-center">{{$name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td class="text-center">{{$email}}</td>
                </tr>
                <tr>
                    <th>College</th>
                    <td class="text-center">{{$info->college_name}}</td>
                </tr>
                <tr>
                    <th>Supervisor</th>
                    <td class="text-center">{{$info->name}}</td>
                </tr>
                <tr>
                    <th>Teacher</th>
                    <td class="text-center">{{$teacher}}</td>
                </tr>
                <tr>
                    <th>Date Joined</th>
                    <td class="text-center">{{$yearJoined}}</td>
                </tr>
                <tr>
                    <th>Position</th>
                    <td class="text-center">{{$position}}</td>
                </tr>
                <tr>
                    <th>Date In Position</th>
                    <td class="text-center">{{$yearinPosition}}</td>
                </tr>
            </table>
        </div>
        <div class="col">
          <h6>Signature</h6>
          <img class="img-fluid" src="{{ url('storage/users/'.$name.'/'.$signature) }}" alt="No Signature">
        </div>

      </div>
</div>
