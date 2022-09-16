@extends('layout')


@section('content')
        <main>
            <div class="mx-4">
@php
    $pieces = explode("-", $idp->created_at);
    $yearPos = App\Http\Controllers\IDPController::year($idp->yearinPosition);
    $yearJon = App\Http\Controllers\IDPController::year($idp->yearJoined);
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
                            {{$idp->name}}'s Individual Development Plan {{$pieces[0]}}
                    </h2>
                </header>

                <table>
                    <tr>
                        <td><p >Employee Name: {{$idp->name}}</p></td>
                        <td><p>Position: {{$idp->position}}</p></td>
                        <td><p>Years in the Position: {{$yearPos}}</p></td>
                    </tr>
                    <tr>
                        <td><p>Supervisor's Name: {{$idp->supervisor}}</p></td>
                        <td colspan="2"><p>Years in the Agency: {{$yearJon}}</p></td>
                    </tr>
                </table>
                <h4 class="font-bold">PURPOSE</h4>
                <p>({{$idp->purpose_meet}}) To meet the competencies of current position</p>
                <p>({{$idp->purpose_improve}}) To improve the current level position’s level of competencies.</p>
                <p>({{$idp->purpose_obtain}}) To obtain new level of competencies from position and different functions.</p>
                <p>({{$idp->purpose_others}}) Others, please specify: {{$idp->purpose_explain}}</p>

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
                                    <p>{{$competency[$i]}}</p>
                                </td>
                                <td>
                                    <p>{{$sug[$i]}}</p>
                                </td>
                                <td>
                                    <p>{{$dev_act[$i]}}</p>
                                </td>
                                <td>
                                    <p>{{$target_date[$i]}}</p>
                                </td>
                                <td>
                                    <p>{{$responsible[$i]}}</p>
                                </td>
                                <td>
                                    <p>{{$support[$i]}}</p>
                                </td>
                                <td>
                                    <p>{{$status[$i]}}</p>
                                </td>
                            </tr>
                        @endfor
                </table>
                <h4 class="font-bold">
                    What function do you feel competent to perform?<br>
                    (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
                </h4>
                    <p>1. {{$idp->compfunctiondesc0}}</p>
                    <p>2. {{$idp->compfunctiondesc1}}</p>
                <h4 class="font-bold">
                    What function do you have a difficulty to perform?<br>
                    (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
                </h4>
                    <p>1. {{$idp->diffunctiondesc0}}</p>
                    <p>2. {{$idp->diffunctiondesc1}}</p>
                
                <h4 class="font-bold">
                    Where do you see your career progressing in? the next two years?
                </h4>
                <p>{{$idp->diffunctiondesc0}}</p>
            </div>
        </main>
@endsection
