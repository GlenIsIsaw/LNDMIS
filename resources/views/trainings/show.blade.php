@extends('layout')


@section('content')

<h1>{{$training->certificate_title}}</h1>

<label for="name">Name</label>
<h4>{{$training->name}}</h4>
<label for="certificate_title">Training</label>
<h4>{{$training->certificate_title}}</h4>
<label for="certificate_type">Certificate Type</label>
<h4>{{$training->certificate_type}}</h4>
<label for="level">Level</label>
<h4>{{$training->level}}</h4>
<label for="venue">Venue</label>
<h4>{{$training->venue}}</h4>
<label for="sponsors">Sponsors</label>
<h4>{{$training->sponsors}}</h4>
<label for="date">Date Covered</label>
<h4>{{$training->date_covered}}</h4>
<label for="hours">Number of Hours</label>
<h4>{{$training->num_hours}}</h4>
<label for="type">Type</label>
<h4>{{$training->type}}</h4>
<label for="certificate">Certificate</label>
<img src="{{ url('storage/users/'.$training->name.'/'.$training->certificate) }}"
style="height: 100px; width: 150px;">

<a href="/trainings/{{$training->id}}/edit">
<i class="fa-solid fa-pencil"></i> Edit
</a>

<form method="POST" action="/trainings/{{$training->id}}">
@csrf
@method('DELETE')
<button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
</form>


@endsection