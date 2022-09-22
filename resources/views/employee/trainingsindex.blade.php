@extends('layout')


@section('content')
<header class="text-center align-top">
  


<h1 class="text-2xl font-bold uppercase mt-6">List of {{ auth()->user()->name }} Certificates</h1>

<div class="flex space-x-6 ml-5 mt-10 justify-center items-center">

      <a href="{{route('trainings.create')}}" class="bg-gray-700 text-white rounded py-4 px-12 hover:bg-yellow-500 text-top">Back</a>
      <a href="{{route('trainings.create')}}" class="bg-laravel text-white rounded py-4 px-10 hover:bg-black text-top">Create</a>
      
      </div>
</header>

<form action="{{route('training.empindex')}}">
    
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
  <table class="w-fit">
    <thead class="bg-gray-50 border-b-2 border-gray-200">
    <tbody class="divide-y divide-gray-100">
    <tr>
      <td></td>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Name</th>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Certificate Title</th>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Date Covered</th>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">level</th>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Number of Hours</th>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Venue</th>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Sponsors</th>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Has an Attendance Report</th>
      <th class="p-3 text-sm font-bold tracking-wide text-left whitespace-nowrap">Status</th>

      
    </tr>

  </thead>
    @foreach($lists as $list)
    <tr>
    <td>
      @if ($list->status != 'Approved')
        <a href="{{route('training.edit',$list->id)}}" class="text-xs">
            <i class="fa-solid fa-pen mt-2 text-center inline-block border-2 border-black py-2 px-4 rounded-xl"></i>
        </a>
    <form method="POST" action="{{route('training.destroy',$list->id)}}">
        @csrf
        @method('DELETE')
        <button class="text-red-500" onclick="return confirm('Are you sure?')"><i class="fa-solid fa-trash mt-6 inline-block border-2 border-red-900 py-2 px-4 rounded-xl"></i></button>
    </form>
    @endif
    </td>
    
    <td class="p-3 text-sm text-gray-700 whitespace-nowrap"><a href="{{route('training.show',$list->id)}}">{{$list->name}}</a></td>
    <td class="p-3 text-sm text-gray-700 w-30"><div class="break-all">{{ $list->certificate_title }}</div></td>
    
    
    <td class="p-3 text-sm text-gray-700 whitespace-nowrap w-20">{{ $list->date_covered }}</td>
    <td class="p-3 text-sm text-gray-700 whitespace-nowrap w-23"><a href="/training?level={{ $list->level }}">{{ $list->level }}</a></td>
    <td class="p-3 text-sm text-gray-700 whitespace-nowrap">{{ $list->num_hours }}</td>
    <td class="p-3 text-sm text-gray-700"><div class="overflow-wrap: break-words">{{ $list->venue }}</div></td>
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
@else

<div class="flex items-center justify-center h-60 text-2xl">
<p>No Result(s) Found</p>
</div>
@endif



@endsection