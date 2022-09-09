@extends('layout')


@section('content')

<h1>List of Submitted Certificates</h1>

@foreach ($lists as $list)
<h4><a href="{{route('training.show',$list->id)}}">{{$list->certificate_title}} submitted by {{$list->name}}</a></h4>

@endforeach

<form method="POST" action="{{route('training.printall')}}" >
    @csrf
<label for="range">Range of Trainings</label>
<input type="text" name="range1"/>
<input type="text" name="range2"/>
<button type="submit">Print All</button>
</form>

@endsection