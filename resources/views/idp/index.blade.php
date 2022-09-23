@extends('layout')


@section('content')
<header class="text-center align-top">
<h1 class="text-2xl font-bold uppercase mt-6">List of Approved Individual Development Plan</h1>
</header>
<form action="{{route('idp.index')}}">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
      <div class="absolute top-4 left-3">
        <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
      </div>
      <input type="text" name="search" class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"/>
      <div class="absolute top-2 right-2">
        <button type="submit" class="h-10 w-20 text-white rounded-lg bg-red-900 hover:bg-black-600">
          Search
        </button>
      </div>
    </div>
  </form>
  <div class="text-center mt-6">
    <form action="{{route('idp.index')}}">
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
          <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">Filter</button>
    </form>
    </div>
@if (!$idps->isEmpty())
    


    <table>
      <tr>
        <td></td>
        <th>Name</th>
        <th>Competencies</th>
        <th>Completion Status</th>
        <th>Created At</th>
        <th>Updated At</th>
        <th>Status</th>
      </tr>
      @foreach ($idps as $idp)
        @php
        $pieces = explode("-", $idp->created_at);
        @endphp
          <tr>
            <td>
              <a href="{{route('idp.edit',$idp->idp_id)}}" class="text-xs">
                <i class="fa-solid fa-pen mt-2 text-center inline-block border-2 border-black py-2 px-4 rounded-xl"></i>
            </a>
            </td>
            <td><a href="{{route('idp.show',$idp->idp_id)}}">{{$idp->name}}</td>
            <td>
              <ol class="list-decimal">
                @foreach ($idp->competency as $item)
                  <li>{{$item}}</li>
                @endforeach
              </ol>
            </td>
            <td>
              <ol class="list-decimal">
                @foreach ($idp->status as $item)
                  <li>{{$item}}</li>
                @endforeach
            </ol>
            </td>
            <td>{{$idp->created_at}}</td>
            <td>{{$idp->updated_at}}</td>
            <td>{{$idp->submit_status}}</td>
          </tr>
      @endforeach
    </table>
    @endif
@endsection