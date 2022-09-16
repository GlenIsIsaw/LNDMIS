@extends('layout')


@section('content')
    <h1>Attendance Form Information</h1>
    <label for="name">Name</label>
    <p>{{$training->name}}</p>
    <label for="certificate_title">Title of Intervention Attended</label>
    <p>{{$training->certificate_title}}</p>
    <label for="date_covered">Date Conducted</label>
    <p>{{$training->date_covered}}</p>
    <label for="venue">Venue</label>
    <p>{{$training->venue}}</p>
    <label for="sponsors">Sponsors</label>
    <p>{{$training->sponsors}}</p>
    <label for="competency">Specific Competency to Develop/Enhance</label>
    <p>{{$training->competency}}</p>
    <label for="knowledge_acquired">Knowledge Acquired</label>
    <p>{{$training->knowledge_acquired}}</p>
    <label for="outcome">Outcome</label>
    <p>{{$training->outcome}}</p>
    <label for="personal_action">Personal Action</label>
    <p>{{$training->personal_action}}</p>
    
    <form method="POST" action="/attendance/{{$training->training_id}}/print" enctype="multipart/form-data" >
        @csrf    
    <div class="mb-6">
        <label for="esign" class="inline-block text-lg mb-2"
            >Attach the Photo of your Signature</label
        >
        <input type="file" name="esign" accept="image/*" id="esign">
    </div>
    <div class="mb-6">
        <label for="ssign" class="inline-block text-lg mb-2"
            >Attach the Photo of you Supervisor Signature</label
        >
        <input type="file" name="ssign" accept="image/*" id="ssign">
    </div>
    <button type="submit"><i class="fa-solid fa-download"></i>Download</button>
    </form>

    <a href="/attendance/{{$training->att_id}}/edit">
    <i class="fa-solid fa-pencil"></i> Edit
    </a>

    <form method="POST" action="/attendance/{{$training->att_id}}">
        @csrf
        @method('DELETE')
        <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
    </form>

@endsection