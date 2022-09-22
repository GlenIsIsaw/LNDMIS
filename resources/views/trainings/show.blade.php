@extends('layout')


@section('content')


<div class="break-all overflow-auto rounded-lg shadow">
<table class="w-fit">
    <tbody class="divide-y divide-gray-100">
    <thead class="bg-gray-50 border-b-2 border-gray-200">
    <tr class="bg-white">
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap w-60">Name</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap w-full">{{$training->name}}</td>
    </tr>
    <tr class="bg-gray">
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Training</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{$training->certificate_title}}</td>
    </tr>
    <tr>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Certificate Type</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{$training->certificate_type}}</td>
    </tr>
    <tr class="bg-white">
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Level</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{$training->level}}</td>
    </tr>
    <tr class="bg-gray">
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Venue</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{$training->venue}}</td>
    </tr>
    <tr>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Sponsors</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{$training->sponsors}}</td>
    </tr>
    <tr class="bg-white">
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Date Covered</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{$training->date_covered}}</td>
    </tr>
    <tr class="bg-gray">
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Number of Hours</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{$training->num_hours}}</td>
    </tr>
    <tr class="bg-white">
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Type</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{$training->type}}</td>
    </tr>
    <tr class="bg-gray">
        
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Has an Attendance Form</th>
        @if ($training->attendance_form == 0)
            <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><a href="{{route('attendance.create',$training->training_id)}}"><span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-red-900 rounded-lg bg-opacity-90">Create Attendance Report</span></a></td>
        @else
          <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><a href="{{route('attendance.show',$training->training_id)}}"><span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-green-900 rounded-lg bg-opacity-90">View Attendance Report</span></a></td>
        @endif
    </tr>
    <tr class="bg-white">
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Certificate</th>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">            <img src="{{ url('storage/users/'.$training->name.'/'.$training->certificate) }}"
            style="height: 100px; width: 150px;"></td>
    </tr>

  </table>
</thead>
</tbody>



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
</div>


@endsection