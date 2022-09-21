@extends('layout')


@section('content')

<h1>List of Submitted Certificates</h1>
<div class="max-width-lg">
  
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
  
   </div>

  
<form method="POST" action="{{route('training.printall')}}" enctype="multipart/form-data" >
    @csrf
<label for="range">Range of Trainings</label>
<input type="text" name="range1"/>
<input type="text" name="range2"/>

<div class="mb-6">
    <label for="photo" class="inline-block text-lg mb-2"
        >Attach the Photo of your Signature</label
    >
    <input type="file" name="photo" accept="image/*" id="photo" required>
</div>
<button type="submit"><i class="fa-solid fa-download"></i>Download File</button>
</form>

@endsection