@extends('layout')


@section('content')

<h1>List of Submitted Certificates</h1>

@foreach ($lists as $list)
<h4><a href="{{route('training.show',$list->id)}}">{{$list->certificate_title}} in {{$list->date_covered}}</a></h4>
@endforeach

@endsection