@extends('layout')


@section('content')
        <main>
            <div class="mx-4">
@php
    $pieces = explode("-", $idp->created_at);
    $competency = json_decode($idp->competency, true);
    $sug = json_decode($idp->sug, true);
    $dev_act = json_decode($idp->dev_act, true);
    $target_date = json_decode($idp->target_date, true);
    $responsible = json_decode($idp->responsible, true);
    $support = json_decode($idp->support, true);
    $status = json_decode($idp->status, true);
@endphp

                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Edit the {{$idp->name}}'s {{$pieces[0]}} Individual Development Plan
                        </h2>

                    </header>
                    <form method="POST" action="{{route('idp.update',$idp->idp_id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
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
                        
                            @if ($idp->purpose_meet == "/")
                                <input type="checkbox" id="purpose_meet" name="purpose_meet" value="/" checked>
                                <label for="purpose_meet">To meet the competencies of current position.</label><br>
                            @else
                                <input type="checkbox" id="purpose_meet" name="purpose_meet" value="/">
                                <label for="purpose_meet">To meet the competencies of current position.</label><br>
                            @endif

                            @if ($idp->purpose_improve == "/")
                                <input type="checkbox" id="purpose_improve" name="purpose_improve" value="/" checked>
                                <label for="purpose_improve">To improve the current level position’s level of competencies.</label><br>
                            @else
                                <input type="checkbox" id="purpose_improve" name="purpose_improve" value="/">
                                <label for="purpose_improve">To improve the current level position’s level of competencies.</label><br>
                            @endif

                            @if ($idp->purpose_obtain == "/")
                                <input type="checkbox" id="purpose_obtain" name="purpose_obtain" value="/" checked>
                                <label for="purpose_obtain">To obtain new level of competencies from position and different functions.</label><br>
                            @else
                                <input type="checkbox" id="purpose_obtain" name="purpose_obtain" value="/">
                                <label for="purpose_obtain">To obtain new level of competencies from position and different functions.</label><br>
                            @endif

                            @if ($idp->purpose_others == "/")
                                <input type="checkbox" id="purpose_others" name="purpose_others" value="/" checked>
                                <label for="purpose_others">Others, please specify: </label><input type="text" class="border border-gray-200" name="purpose_explain" value = "{{$idp->purpose_explain}}"/>
                            @else
                                <input type="checkbox" id="purpose_others" name="purpose_others" value="/">
                                <label for="purpose_others">Others, please specify: </label><input type="text" class="border border-gray-200" name="purpose_explain" value = "{{$idp->purpose_explain}}"/>
                            @endif
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
                                            <option value="{{$competency[$i]}}">{{$competency[$i]}}</option>
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
                                    </td>
                                    <td>
                                        <select name="sug[]" id="sug">
                                            <option value="{{$sug[$i]}}">{{$sug[$i]}}</option>
                                            <option value="S">S</option>
                                            <option value="U">U</option>
                                            <option value="G">G</option>
                                        </select>
                                        @error('sug')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input
                                        type="text"
                                        name="dev_act[]"
                                        value = "{{$dev_act[$i]}}"
                                        />
                                        @error('dev_act')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input
                                        type="date"
                                        name="target_date[]"
                                        value="{{$target_date[$i]}}"
                                        />
                                        </div>
                                        @error('target_date')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input
                                        type="text"
                                        name="responsible[]"
                                        value="{{$responsible[$i]}}"
                                        />
                                        @error('responsible')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <input
                                        type="text"
                                        name="support[]"
                                        value="{{$support[$i]}}"
                                        />
                                        @error('support')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <select name="status[]" id="status">
                                            <option value="{{$status[$i]}}">{{$status[$i]}}</option>
                                            <option value="Ongoing">Ongoing</option>
                                            <option value="Completed">Completed</option>
                                        </select>
                                        @error('status')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                </tr>
                            @endfor
                        </table>
                        <div class="mb-6">
                            <label for="compfunctiondesc" class="inline-block text-lg mb-2">
                                What function do you feel competent to perform?<br>
                                (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
                            </label><br>
                            <table>
                                <tr>
                                    <td>
                                        <select name="compfunction0" id="compfunctiondesc">
                                            <option value="{{$idp->compfunction0}}">{{$idp->compfunction0}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach
                                            @error('compfunction0')
                                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                            @enderror
                                        </select>
                                    </td>
                                    <td>
                                        <select name="compfunction1" id="compfunctiondesc">
                                            <option value="{{$idp->compfunction1}}">{{$idp->compfunction1}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach
                                            @error('compfunction1')
                                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                            @enderror
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea rows="4" cols="50" name="compfunctiondesc0" id="compfunctiondesc">{{$idp->compfunctiondesc0}}</textarea>
            
                                        @error('compfunctiondesc0')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <textarea rows="4" cols="50" name="compfunctiondesc1" id="compfunctiondesc">{{$idp->compfunctiondesc1}}</textarea>
            
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
                                            <option value="{{$idp->diffunction0}}">{{$idp->diffunction0}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach
                                            @error('diffunction0')
                                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                            @enderror
                                        </select>
                                    </td>
                                    <td>
                                        <select name="diffunction1" id="diffunctiondesc">
                                            <option value="{{$idp->diffunction1}}">{{$idp->diffunction1}}</option>
                                            @foreach ($comps as $key => $comp)
                                            <optgroup label={{$key}}>
                                                @foreach ($comp as $item)
                                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                                @endforeach
                                            @endforeach
                                            @error('diffunction1')
                                            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                            @enderror
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <textarea rows="4" cols="50" name="diffunctiondesc0" id="diffunctiondesc">{{$idp->diffunctiondesc0}}</textarea>
            
                                        @error('diffunctiondesc0')
                                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                        @enderror
                                    </td>
                                    <td>
                                        <textarea rows="4" cols="50" name="diffunctiondesc1" id="diffunctiondesc">{{$idp->diffunctiondesc1}}</textarea>
            
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
                                        <textarea rows="4" cols="50" name="career">{{$idp->career}}</textarea>
            
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
                                Submit
                            </button>
                        </div>


                    </form>

            </div>
        </main>
@endsection
