@extends('layout')


@section('content')
<table>
    <tr>
        <th>Name</th>
        <td>{{$training->name}}</td>
    </tr>
    <tr>
        <th>Training</th>
        <td>{{$training->certificate_title}}</td>
    </tr>
    <tr>
        <th>Certificate Type</th>
        <td>{{$training->certificate_type}}</td>
    </tr>
    <tr>
        <th>Level</th>
        <td>{{$training->level}}</td>
    </tr>
    <tr>
        <th>Venue</th>
        <td>{{$training->venue}}</td>
    </tr>
    <tr>
        <th>Sponsors</th>
        <td>{{$training->sponsors}}</td>
    </tr>
    <tr>
        <th>Date Covered</th>
        <td>{{$training->date_covered}}</td>
    </tr>
    <tr>
        <th>Number of Hours</th>
        <td>{{$training->num_hours}}</td>
    </tr>
    <tr>
        <th>Type</th>
        <td>{{$training->type}}</td>
    </tr>
    <tr>
        <th>Has an Attendance Form</th>
        @if ($training->attendance_form == 0)
            <td><a href="{{route('attendance.create',$training->training_id)}}">Create Attendance Report</a></td>
        @else
          <td><a href="{{route('attendance.show',$training->training_id)}}">View Attendance Report</a></td>
        @endif
    </tr>
    <tr>
        <th>Certificate</th>
        <td>            <img src="{{ url('storage/users/'.$training->name.'/'.$training->certificate) }}"
            style="height: 100px; width: 150px;"></td>
    </tr>

  </table>
    <button type="submit" class="bg-laravel text-white rounded py-1 px-2 hover:bg-black mt-2 text-center">
        <a href="{{route('training.edit',$training->training_id)}}">
            <i class="fa-solid fa-download mt-2 text-center"></i>
            Edit
        </a>
    </button>

    @if ($training->status == 'Not Submitted')
        
        <form method="POST" action="{{route('training.submit', $training->training_id)}}">
            @csrf
            @method('PUT')
            <button class="bg-laravel text-white rounded py-1 px-2 hover:bg-black mt-2 text-center"><i class="fa-solid fa-arrow-up-from-bracket"></i>Submit</button>
        </form>
    @endif


    <form method="POST" action="{{route('training.destroy',$training->training_id)}}">
        @csrf
        @method('DELETE')
        <button class="bg-laravel text-white rounded py-1 px-2 hover:bg-black mt-2 text-center text-red-500 "><i class="fa-solid fa-trash"></i>Delete</button>
    </form>
@endsection