@extends('layout')


@section('content')
        <main>
            <div class="mx-4">
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Edit the {{$part['name']}}'s {{$part['year']}} Individual Development Plan
                        </h2>

                    </header>
                    <form method="POST" action="{{route('idp.update',$part['idp_id'])}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <input type="hidden" id="user_id" name="users_id" value="{{$part['user_id']}}">

                        @if (array_key_exists("purpose_meet",$part))
                            <input type="hidden" id="purpose_meet" name="purpose_meet" value="{{$part['purpose_meet']}}">
                        @endif

                        @if (array_key_exists("purpose_improve",$part))
                            <input type="hidden" id="purpose_improve" name="purpose_improve" value="{{$part['purpose_improve']}}">
                        @endif

                        @if (array_key_exists("purpose_obtain",$part))
                            <input type="hidden" id="purpose_obtain" name="purpose_obtain" value="{{$part['purpose_obtain']}}">
                        @endif

                        @if (array_key_exists("purpose_others",$part))
                            <input type="hidden" id="purpose_others" name="purpose_others" value="{{$part['purpose_others']}}">
                            <input type="hidden" name="purpose_explain" value = "{{$part['purpose_explain']}}"/>
                        @endif

                        @for ($i = 0; $i < 3; $i++)
                            <input type="hidden" id="competency" name="competency[]" value="{{$part['competency'][$i]}}">
                            <input type="hidden" id="sug" name="sug[]" value="{{$part['sug'][$i]}}">
                            <input type="hidden" id="dev_act" name="dev_act[]" value="{{$part['dev_act'][$i]}}">
                            <input type="hidden" id="target_date" name="target_date[]" value="{{$part['target_date'][$i]}}">
                            <input type="hidden" id="responsible" name="responsible[]" value="{{$part['responsible'][$i]}}">
                            <input type="hidden" id="support" name="support[]" value="{{$part['support'][$i]}}">
                            <input type="hidden" id="status" name="status[]" value="{{$part['status'][$i]}}">
                        @endfor

                        <div class="mb-6">
                            <label for="compfunctiondesc" class="inline-block text-lg mb-2">
                                What function do you feel competent to perform?<br>
                                (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
                            </label><br>
                            <table>
                                <tr>
                                    <td>
                                        <select name="compfunction0" id="compfunctiondesc">
                                            <option value="{{$part['compfunction0']}}">{{$part['compfunction0']}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach

                                        </select>
                                        @error('compfunction0')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="compfunction1" id="compfunctiondesc">
                                            <option value="{{$part['compfunction1']}}">{{$part['compfunction1']}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach
                                        </select>
                                        @error('compfunction1')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea rows="4" cols="50" name="compfunctiondesc0" id="compfunctiondesc">{{$part['compfunctiondesc0']}}</textarea>
            
                                        @error('compfunctiondesc0')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <textarea rows="4" cols="50" name="compfunctiondesc1" id="compfunctiondesc">{{$part['compfunctiondesc1']}}</textarea>
            
                                        @error('compfunctiondesc1')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-6">
                            <label for="diffunctiondesc" class="inline-block text-lg mb-2">
                                What function do you have a difficulty to perform?<br>
                                (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)                                
                            </label><br>
                            <table>
                                <tr>
                                    <td>
                                        <select name="diffunction0" id="diffunctiondesc">
                                            <option value="{{$part['diffunction0']}}">{{$part['diffunction0']}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach

                                        </select>
                                        @error('diffunction0')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="diffunction1" id="diffunctiondesc">
                                            <option value="{{$part['diffunction1']}}">{{$part['diffunction1']}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach

                                        </select>
                                        @error('diffunction1')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea rows="4" cols="50" name="diffunctiondesc0" id="diffunctiondesc">{{$part['diffunctiondesc0']}}</textarea>
            
                                        @error('diffunctiondesc0')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <textarea rows="4" cols="50" name="diffunctiondesc1" id="diffunctiondesc">{{$part['diffunctiondesc1']}}</textarea>
            
                                        @error('diffunctiondesc1')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mb-6">
                            <p class="inline-block text-lg mb-2">
                                Where do you see your career progressing in? the next two years?
                            </p>
                            <table>
                                <tr>
                                    <td>
                                        <textarea rows="4" cols="50" name="career">{{$part['career']}}</textarea>
            
                                        @error('career')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                            </table>
                            
                        </div>
                        <div class="mb-6">
                            <button
                                type="submit"
                                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Edit
                            </button>
                        </div>


                    </form>

            </div>
        </main>
@endsection
