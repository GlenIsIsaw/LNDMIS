@extends('layout')


@section('content')

<header class="text-center align-top">
  


  <h1 class="text-2xl font-bold uppercase mt-6">List of Submitted Certificates</h1>
  
  <form action="{{route('training.queue')}}">
      
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
      <div class="absolute top-4 left-3">
        <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
      </div>
      <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"/>
      <div class="absolute top-2 right-2">
        <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-900 hover:bg-yellow-600">
          Search
        </button>
      </div>
    </div>
  </form>
  <div class="text-center mt-6">
    <form action="{{route('training.queue')}}">
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
          <select name="status" id="status">
            <option value=""></option>
            <option value="Approved">Approved</option>
            <option value="Not Submitted">Not Submitted</option>
            <option value="Rejected">Rejected</option>
            <option value="Pending">Pending</option>
          </select>
          <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Filter</button>
    </form>
    </div>
  
  @if(!$lists->isEmpty())

    <div class="break-all overflow-auto rounded-lg shadow mt-7">
    <table class="w-full">
      <thead class="bg-gray-50 border-b-2 border-gray-200">
      <tbody class="divide-y divide-gray-100">
      <tr>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">Name</th>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">Certificate Title</th>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">Date Covered</th>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">level</th>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">Number of Hours</th>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">Venue</th>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">Sponsors</th>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">Has an Attendance Report</th>
        <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap break-normal">Status</th>
  
        
      </tr>
  
    </thead>
      @foreach($lists as $list)
      <tr>
      <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><a href="{{route('training.show',$list->id)}}">{{$list->name}}</a></td>
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $list->certificate_title }}</td>
  
      
      <td class="p-3 text-sm text-gray-700 whitespace-nowrap w-60">{{ $list->date_covered }}</td>
      <td class="p-3 text-sm text-gray-700 whitespace-nowrap w-23"><a href="/training?level={{ $list->level }}">{{ $list->level }}</a></td>
      <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $list->num_hours }}</td>
      <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $list->venue }}</td>
      <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap">{{ $list->sponsors }}</td>
      @if ($list->attendance_form == 0)
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><a href="{{route('attendance.create',$list->id)}}"><span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-red-900 rounded-lg bg-opacity-90 text-center w-40">Create Attendance Report</span></a></td>
      @else
        <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><a href="{{route('attendance.show',$list->id)}}"><span class="p-1.5 text-xs font-medium uppercase tracking-wider text-white bg-green-900 rounded-lg bg-opacity-90">View Attendance Report</span></a></td>
      @endif
  
        <td class="p-3 text-sm text-gray-700 text-center whitespace-nowrap"> {{ $list->status }}</td>
  
      </tr>
      @endforeach
    </table>
    </div>
  </tbody>
  @endif

  

@endsection