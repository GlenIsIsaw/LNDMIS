@extends('layout')


@section('content')
        <main>
            <div class="mx-4">
                <div
                    class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
                >
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Edit a Certificate
                        </h2>
                        <p class="mb-4">Edit: {{$training->certificate_title}}</p>
                    </header>

                    <form method="POST" action="/trainings/{{$training->id}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label for="Name" class="inline-block text-lg mb-2">
                                Name
                            </label>
                            <select name="user_id" id="user_id">
                                <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                            </select>
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        
                            <div class="mb-6">
                                <label for="certificate_type" class="inline-block text-lg mb-2">
                                    Certificate Types
                                </label>
                                <select name="certificate_type" id="certificate_type">
                                    <option value="{{$training->certificate_type}}">{{$training->certificate_type}}</option>
                                    <option value="Certificate of Eligibility">Certificate of Eligibility</option>
                                    <option value="Certificate of Training">Certificate of Training</option>
                                    <option value="Certificate of Appreciation">Certificate of Appreciation</option>
                                    <option value="Certificate of Attendance">Certificate of Attendance</option>
                                    <option value="Certificate of Commendation">Certificate of Commendation</option>
                                    <option value="Certificate of Completion">Certificate of Completion</option>
                                    <option value="Certificate of Participation">Certificate of Participation</option>
                                    <option value="Certificate of Recognition">Certificate of Recognition</option>
                                    <option value="Membership Certificate">Membership Certificate</option>
                                  </select>

                        @error('certificate_type')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="name" class="inline-block text-lg mb-2">
                                Certificate Name
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="certificate_title"
                                value = "{{$training->certificate_title}}"
                            />
                        </div>
                        
                        @error('certificate_title')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <div class="mb-6">
                            <label for="level" class="inline-block text-lg mb-2">
                                Level
                            </label>
                            <select name="level" id="level">
                                <option value="{{$training->level}}">{{$training->level}}</option>
                                <option value="International">International</option>
                                <option value="Local">Local</option>
                                <option value="N/A">N/A</option>
                                <option value="National">National</option>
                                <option value="Regional">Regional</option>
                              </select>
                        </div>

                        @error('level')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="year" class="inline-block text-lg mb-2">
                                Dates Covered
                            </label>
                            <input
                                type="date"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="date_covered"
                                value = "{{$training->date_covered}}"
                                
                            />
                        </div>
                        @error('date_covered')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="venue" class="inline-block text-lg mb-2">
                                Venue
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="venue"
                                value = "{{$training->venue}}"
                            />
                        </div>
                        
                        @error('venue')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="sponsors" class="inline-block text-lg mb-2">
                                Sponsors
                            </label>
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="sponsors"
                                value = "{{$training->venue}}"
                            />
                        </div>
                        
                        @error('sponsors')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <div class="mb-6">
                            <label for="email" class="inline-block text-lg mb-2"
                                >No. of Hours</label
                            >
                            <input
                                type="number"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="num_hours"
                                value = "{{$training->num_hours}}"
                            />
                        </div>
                        @error('num_hours')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="type" class="inline-block text-lg mb-2">
                                Type
                            </label>
                            <select name="type" id="type">
                                <option value="{{$training->type}}">{{$training->type}}</option>
                                <option value="Eligibility">Eligibility</option>
                                <option value="Event-Facilitator">Event-Facilitator</option>
                                <option value="Membership">Membership</option>
                                <option value="Seminar">Seminar</option>
                                <option value="Seminar-Facilitator">Seminar-Facilitator</option>
                            </select>
                        </div>

                        @error('type')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="photo" class="inline-block text-lg mb-2"
                                >Attach the Photo of the Certificate</label
                            >
                            <input type="file" name="photo" accept="image/*" id="photo">
                        </div>
                        <img src="{{ url('storage/users/'.$training->name.'/'.$training->certificate) }}"
                            style="height: 100px; width: 150px;">
                        

                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Submit
                            </button>
                        </div>


                    </form>
                </div>
            </div>
        </main>

        <footer
            class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
        >
            <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

            <a
                href="create.html"
                class="absolute top-1/3 right-10 bg-black text-white py-2 px-5"
                >Post Job</a
            >
        </footer>
    </body>
</html>

@endsection
