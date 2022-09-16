@extends('layout')


@section('content')

<h1>List of Submitted Certificates</h1>
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
     <td>{{ $list->level }}</td>
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

@endsection