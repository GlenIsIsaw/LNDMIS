@extends('layout')


@section('content')

<h1>List of {{auth()->user()->name}}'s Individual Development Plan</h1>

@foreach ($idps as $idp)
    @php
        $pieces = explode("-", $idp->created_at);
    @endphp
    <p><a href="{{route('idp.show',$idp->idp_id)}}">{{$idp->name}}'s Individual Development Plan For Year {{$pieces[0]}}</a></p>
@endforeach

@endsection