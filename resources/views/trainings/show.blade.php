@extends('layout')


@section('content')
<table>
    <tr>
        <td>
            <h1>Training Information</h1>
            <label for="name">Name</label>
            <p>{{$training->name}}</p>
            <label for="certificate_title">Training</label>
            <p>{{$training->certificate_title}}</p>
            <label for="certificate_type">Certificate Type</label>
            <p>{{$training->certificate_type}}</p>
            <label for="level">Level</label>
            <p>{{$training->level}}</p>
            <label for="venue">Venue</label>
            <p>{{$training->venue}}</p>
            <label for="sponsors">Sponsors</label>
            <p>{{$training->sponsors}}</p>
            <label for="date">Date Covered</label>
            <p>{{$training->date_covered}}</p>
            <label for="hours">Number of Hours</label>
            <p>{{$training->num_hours}}</p>
            <label for="type">Type</label>
            <p>{{$training->type}}</p>
            <label for="certificate">Certificate</label>
            <img src="{{ url('storage/users/'.$training->name.'/'.$training->certificate) }}"
            style="height: 100px; width: 150px;">

            <a href="/trainings/{{$training->training_id}}/edit">
            <i class="fa-solid fa-pencil"></i> Edit
            </a>

            <form method="POST" action="/trainings/{{$training->training_id}}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
            </form>
        </td>
        @if ($training->attendance_form == 0)
            <td>
                <h1>The training do not have a attendance form</h1>
                <p><a href="{{route('attendance.create')}}">Create Attendance Form</a></p>
            </td>
        @else
            

        <td>
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

            <a href="/attendance/{{$training->att_id}}/edit">
            <i class="fa-solid fa-pencil"></i> Edit
            </a>

            <form method="POST" action="/attendance/{{$training->att_id}}">
            @csrf
            @method('DELETE')
            <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
            </form>
        </td>
        @endif
    </tr>
</table>



@endsection