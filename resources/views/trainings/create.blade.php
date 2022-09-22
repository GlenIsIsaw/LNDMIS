@extends('layout')


@section('content')

        <main>
            
           
            <div class="mx-4 w-full h-full bg-no-repeat bg-center bg-cover" style="background-image: url('images/lnd.jpg')">
                <div
                    class="bg-gray-100 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
                >
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-4">
                            Post a Certificate
                        </h2>
                        
                    </header>
                    


                    <form method="POST" action="{{route('training.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6 ml-3">
                            <label for="Name" class="inline-block text-lg mb-2 ">
                                Name 
                            </label>
                            <select name="user_id" id="user_id" class="border-2 border-black border-gray-200 rounded p-2 w-full">
                                <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                            </select>
                            @error('name')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        
                            <div class="mb-6">
                                <label for="certificate_type" class="inline-block text-lg mb-2 mt-5">
                                    Certificate Types
                                </label>
                                <select name="certificate_type" id="certificate_type" class="border-2 border-black border-gray-200 rounded p-2 w-full">
                                    <option value=""></option>
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
                            <label for="name" class="inline-block x text-lg mb-2 mt-5">
                                Certificate Name
                            </label>
                            <input
                                type="text"
                                class="border-2 border-black border-gray-200 rounded p-2 w-full"
                                name="certificate_title"
                                value = "{{old('certificate_title')}}"
                            />
                        </div>
                        
                        @error('certificate_title')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror
                        <div class="mb-6">
                            <label for="level" class="inline-block text-lg mb-2">
                                Level
                            </label>
                            <select name="level" id="level" class="border-2 border-black border-gray-200 rounded p-2 w-full">
                                <option value=""></option>
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
                                class="border-2 border-black border-gray-200 rounded p-2 w-full"
                                name="date_covered"
                                
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
                                class="border-2 border-black border-gray-200 rounded p-2 w-full"
                                name="venue"
                                value = "{{old('venue')}}"
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
                                class="border-2 border-black border-gray-200 rounded p-2 w-full"
                                name="sponsors"
                                value = "{{old('sponsors')}}"
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
                                class="border-2 border-black border-gray-200 rounded p-2 w-full"
                                name="num_hours"
                                value = "{{old('num_hours')}}"
                            />
                        </div>
                        @error('num_hours')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6">
                            <label for="type" class="inline-block text-lg mb-2">
                                Type
                            </label>
                            <select name="type" id="type" class="border-2 border-black border-gray-200 rounded p-2 w-full">
                                <option value=""></option>
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
                            <input type="file" name="photo" class="border-2 border-black border-gray-200 rounded p-2 w-full" accept="image/*" id="photo" required >
                        </div>
                   
                        <div class="flex space-x-2 justify-center items-center mt-10">
                            <button
                                type="submit"
                                class="bg-gray-700 text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Cancel
                            </button>
                        
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Create
                            </button>
                        </div>

                    </form>
                </div>
            </div>
            </div>
        </main>
    
       
    </body>
</html>

@endsection
