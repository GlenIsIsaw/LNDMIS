@extends('layout')

@section('content')

<button type="button" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
    <a href="{{route('training.empindex')}}">List of Trainings</a>
</button>
<button type="button" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
    <a href="{{route('idp.empindex')}}">Individual Development Plan</a>
</button>
@endsection
