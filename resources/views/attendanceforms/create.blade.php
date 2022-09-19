@extends('layout')


@section('content')
        <main>
            <div class="mx-4">
                <div
                    class="bg-gray-100 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
                >
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Post an Attendance Form
                        </h2>

                    </header>
                    

                    <form method="POST" action="{{route('attendance.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-6">
                            <div class="mb-6">
                                <label for="list_of_training_id" class="inline-block text-lg mb-2 mt-6">
                                    Training
                                </label>
                                <select name="list_of_training_id" id="list_of_training_id">
                                    <option value=""></option>
                                    @foreach ($training as $item)
                                        <option value="{{$item->id}}">{{$item->certificate_title}}</option>
                                    @endforeach
                                    
                                </select>
                                @error('list_of_training_id')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            <label for="competency" class="inline-block text-lg mb-2 mt-6">
                                Specific Competency Target to Enhance
                            </label>
                            <select name="competency" id="competency">
                        
                                @foreach ($comps as $key => $comp)
                                <optgroup label={{$key}}>
                                    @foreach ($comp as $item)
                                    <option value="{{$item->competency_name}}">{{$item->competency_name}}</option>
                                    @endforeach
                                @endforeach
                            </select>
                            @error('competency')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror
                        
                            <div class="mb-6">
                                <label for="knowledge_acquired" class="inline-block text-lg mb-2 mt-6">
                                    Knowledge Acquired(What skills, knowledge and attitudes acquired?)
                                </label>
                                <textarea rows="4" cols="50" name="knowledge_acquired">
                                    Enter text here...
                                </textarea>

                        @error('knowledge_acquired')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                        @enderror

                        <div class="mb-6 mt-6">
                            <label for="outcome" class="inline-block text-lg mb-2">
                                Outcome
                            </label>
                            <textarea rows="4" cols="50" name="outcome">
                                Enter text here...
                            </textarea>

                    @error('outcome')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <div class="mb-6 mt-6">
                        <label for="personal_action" class="inline-block text-lg mb-2">
                            Personal Action
                        </label>
                        <textarea rows="4" cols="50" name="personal_action">
                            Enter text here...
                        </textarea>

                @error('personal_action')
                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                @enderror
                        
                   
                        <div class="text-center mt-6">
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

           
        </footer>
    </body>
</html>

@endsection
