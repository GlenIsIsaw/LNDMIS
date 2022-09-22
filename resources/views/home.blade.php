@extends('layout')

@section('content')



<div class="w-fit h-fit flex justify-items-center left items-center">
    <div class="border border-black-20 w-50 h-50 justify-center items-center">
<button type="button" class="bg-laravel text-white rounded py-5 px-20 hover:bg-black rounded-lg">
    <a href="{{route('training.empindex')}}">List of Trainings</a>
</button>



<button type="button" class="bg-laravel text-white rounded py-5 px-20 hover:bg-black rounded-lg">
    <a href="{{route('idp.empindex')}}">Individual Development Plan</a>
</button>

</div>
</ul>
@endsection
