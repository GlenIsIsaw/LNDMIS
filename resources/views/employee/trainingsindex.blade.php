@extends('layout')


@section('content')

<h1>List of Submitted Certificates</h1>

@if(!$lists->isEmpty())
  <form action="{{route('training.empindex')}}">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
      <div class="absolute top-4 left-3">
        <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
      </div>
      <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"/>
      <div class="absolute top-2 right-2">
        <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-500 hover:bg-red-600">
          Search
        </button>
      </div>
    </div>
  </form>

  <form action="{{route('training.empindex')}}">
      <label for="start_date" class="inline-block text-lg mb-2">
          Start Date
      </label>
      <input
          type="date"
          name="start_date"
        />
      <label for="end_date" class="inline-block text-lg mb-2">
          End Date
      </label>
      <input
          type="date"
          name="end_date"
        />
        <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Filter</button>
  </form>
  <table>
    <tr>
      <th>name</th>
      <th>certificate_title</th>
      <th>date_covered</th>
      <th>level</th>
      <th>num_hours</th>
      <th>Venue</th>
      <th>Sponsors</th>
      <th>Has an Attendance Report</th>

      
    </tr>
    @foreach($lists as $list)
    <tr>
    <td><a href="{{route('training.show',$list->id)}}">{{$list->name}}</a></td>
    <td>{{ $list->certificate_title }}</td>
    <td>{{ $list->date_covered }}</td>
    <td><a href="/training?level={{ $list->level }}">{{ $list->level }}</a></td>
    <td>{{ $list->num_hours }}</td>
    <td>{{ $list->venue }}</td>
    <td>{{ $list->sponsors }}</td>
    @if ($list->attendance_form == 0)
      <td><a href="{{route('attendance.create')}}">Create Attendance Report</a></td>
    @else
      <td><a href="{{route('attendance.show',$list->id)}}">View Attendance Report</a></td>
    @endif

    </tr>
    @endforeach
  </table>
@else
<p>You Dont have Any Submitted Trainings/Seminar/Workshop</p>
@endif

   <a href="{{route('trainings.create')}}"><i class="fa-solid fa-pen-to-square"></i>Create</a>

@endsection