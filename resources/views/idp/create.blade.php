@extends('layout')


@section('content')
        <main>
            <div class="mx-4">

                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mt-6">
                            Create an Individual Development Plan
                        </h2>

                    </header>
                    


                    <form method="POST" action="{{route('idp.store')}}" enctype="multipart/form-data" name="part1">
                        @csrf
                        <div class="mb-6">
                            <label for="Name" class="inline-block text-lg mb-2">
                                Name
                            </label>
                            <select name="user_id" id="user_id">
                                <option value="{{auth()->user()->id}}">{{auth()->user()->name}}</option>
                            </select>
                            @error('user_id')
                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                            @enderror <br>
                        
                            <input type="checkbox" id="purpose_meet" name="purpose_meet" value="/">
                            <label for="purpose_meet">To meet the competencies of current position.</label><br>
                            <input type="checkbox" id="purpose_improve" name="purpose_improve" value="/">
                            <label for="purpose_improve">To improve the current level position’s level of competencies.</label><br>
                            <input type="checkbox" id="purpose_obtain" name="purpose_obtain" value="/">
                            <label for="purpose_obtain">To obtain new level of competencies from position and different functions.</label><br>
                            <input type="checkbox" id="purpose_others" name="purpose_others" value="/">
                            <label for="purpose_others">Others, please specify: </label><input type="text" class="border border-gray-200" name="purpose_explain" value = "{{old('purpose_explain')}}"
                        /><br>
                        <table>
                            <th>Target Competency</th>
                            <th>S/U/G Priorities</th>
                            <th>Development Activity</th>
                            <th>Target Completion Date</th>
                            <th>Person Responsible</th>
                            <th>Support Needed </th>
                            <th>Completion Status</th>

                            @for ($i = 0; $i < 3; $i++)
                                <tr>
                                    <td>
                                        <select name="competency[]" id="competency">
                                            <option value="{{old("competency."."$i")}}">{{old("competency."."$i")}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('competency.*')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="sug[]" id="sug">
                                            <option value="{{old("sug."."$i")}}">{{old("sug."."$i")}}</option>
                                            <option value="S">S</option>
                                            <option value="U">U</option>
                                            <option value="G">G</option>
                                        </select>
                                        @error('sug.*')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input
                                        type="text"
                                        name="dev_act[]"
                                        value="{{old("dev_act."."$i")}}"
                                        />
                                        @error('dev_act.*')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input
                                        type="date"
                                        name="target_date[]"
                                        value="{{old("target_date."."$i")}}"
                                            />
                                        </div>
                                        @error('target_date.*')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input
                                        type="text"
                                        name="responsible[]"
                                        value="{{old("responsible."."$i")}}"
                                        />
                                        @error('responsible.*')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input
                                        type="text"
                                        name="support[]"
                                        value="{{old("support."."$i")}}"
                                        />
                                        @error('support.*')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="status[]" id="status">
                                            <option value="Ongoing">Ongoing</option>
                                        </select>
                                        @error('status.*')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                            @endfor
                        </table>
                            
                        </div>
                        <div class="mb-6 text-center">
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Next
                            </button>
                        </div>


                    </form>

            </div>
        </main>
@endsection
