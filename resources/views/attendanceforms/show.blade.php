@extends('layout')


@section('content')
<main>
    <div class="mx-4">
        <div
            class="bg-gray-100 border border-gray-200 p-10 rounded max-w-2xl mx-auto mt-24"
        >
<header class="text-center">
    <h1 class="text-2xl font-bold uppercase mt-6">Attendance Form Information</h1>

</header>

<div class="text-left mt-6 text-red-600">
    <label for="name">Name</label>
</div>
    <p>{{$training->name}}</p>

<div class="text-left mt-6 text-red-600">
    <label for="certificate_title">Title of Intervention Attended</label>
</div>
    <p><div class="break-all">{{$training->certificate_title}}</div></p>

<div class="text-left mt-6 text-red-600">
    <label for="date_covered">Date Conducted</label>
</div>
    <p>{{$training->date_covered}}</p>

<div class="text-left mt-6 text-red-600">
    <label for="venue">Venue</label>
</div>
    <p><div class="break-all">{{$training->venue}}</div></p>

<div class="text-left mt-6 text-red-600">
    <label for="sponsors">Sponsors</label>
</div>
    <p>{{$training->sponsors}}</p>

<div class="text-left mt-6 text-red-600">
    <label for="competency">Specific Competency to Develop/Enhance</label>
</div>
    <p>{{$training->competency}}</p>

<div class="text-left mt-6 text-red-600">
   <label for="knowledge_acquired">Knowledge Acquired</label>
</div>
    <p>{{$training->knowledge_acquired}}</p>

<div class="text-left mt-6 text-red-600">
    <label for="outcome">Outcome</label>
</div>
    <p>{{$training->outcome}}</p>

<div class="text-left mt-6 text-red-600">
    <label for="personal_action">Personal Action</label>
</div>
    <p>{{$training->personal_action}}</p>

    
    <form method="POST" action="{{route('attendance.print',$training->att_id)}}" enctype="multipart/form-data" >
        @csrf    
    <div class="mb-6 mt-6">
        <td><label for="esign" class="inline-block text-lg mb-2"
            >Attach the Photo of your Own Signature</label
        >
        <input type="file" name="esign" accept="image/*" id="esign" class="border-2 border-black border-gray-200 rounded p-2 w-full">
    </div>
    <div class="mb-6 mt-6">
        <td> <label for="ssign" class="inline-block text-lg mb-2"
            >Attach the Photo of you Supervisor Signature</label
        >
    
        <input type="file" name="ssign" accept="image/*" id="ssign" class="border-2 border-black border-gray-200 rounded p-2 w-full">
    </div>

    <div class ="flex space-x-2 ml-5 justify-center items-center">
    <button type="submit" class="bg-laravel text-white rounded py-2 px-2 hover:bg-black mt-2 text-center"><i class="fa-solid fa-download mt-2 text-center"></i>Download</button>
    </form>
        @if ($training->status == 'Approved')
            @if (auth()->user()->role_as == 1)
            <button type="submit" class="bg-laravel text-white rounded py-1 px-2 hover:bg-black mt-2 text-center">    <a href="{{route('attendance.edit',$training->att_id)}}">
                <i class="fa-solid fa-download mt-2 text-center"></i>Edit</a></button>
        
        
                <form method="POST" action="{{route('attendance.destroy',$training->att_id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="bg-laravel text-white rounded py-2 px-5 hover:bg-black mt-6"><i class="fa-solid fa-trash"></i>Delete</button>
                </form>
            @endif
        @else
            <button type="submit" class="bg-laravel text-white rounded py-2 px-5 hover:bg-black mt-2 text-center">    <a href="{{route('attendance.edit',$training->att_id)}}">
                <i class="fa-solid fa-download mt-2 text-center"></i>Edit</a></button>
        
        
                <form method="POST" action="{{route('attendance.destroy',$training->att_id)}}">
                    @csrf
                    @method('DELETE')
                    <button class="bg-laravel text-white rounded py-2.5 px-5 hover:bg-black mt-2 "><i class="fa-solid fa-trash"></i>Delete</button>
                </form>
        @endif
        @if ($training->status == 'Not Submitted' || $training->status == 'Rejected')
        <form method="POST" action="{{route('training.submit', $training->training_id)}}">
            @csrf
            @method('PUT')
            <button class="bg-green-700 text-white rounded py-2.5 px-7 hover:bg-black mt-2 text-center"><i class="fa-solid"></i>Done</button>
        </form>
    @endif

        </div>  
        </div>
</main>

@endsection