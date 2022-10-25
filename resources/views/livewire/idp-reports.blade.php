
<div>
@php
    $arrays = array();
    $i = 0;
    $j = 0;
    foreach ($idps as $idp) {

        foreach ($idp->competency as $item) {
            
            $arrays[$i][$j]['competency'] = $item;
            $arrays[$i][$j]['name'] = $idp->name;
            $j++;
        }
        $i++;
        
    }
    $i = 0;
    $j = 0;
    foreach ($idps as $idp) {

        foreach ($idp->sug as $item) {
            
            $arrays[$i][$j]['sug'] = $item;
            $arrays[$i][$j]['name'] = $idp->name;
            $j++;
        }
        $i++;
    }
    $i = 0;
    $j = 0;
    foreach ($idps as $idp) {

        foreach ($idp->dev_act as $item) {
            
            $arrays[$i][$j]['dev_act'] = $item;
            $arrays[$i][$j]['name'] = $idp->name;
            $j++;
        }
        $i++;
    }
    $i = 0;
    $j = 0;
    foreach ($idps as $idp) {

        foreach ($idp->target_date as $item) {
            
            $arrays[$i][$j]['target_date'] = $item;
            $arrays[$i][$j]['name'] = $idp->name;
            $j++;
        }
        $i++;
    }
    $i = 0;
    $j = 0;
    foreach ($idps as $idp) {

        foreach ($idp->responsible as $item) {
            
            $arrays[$i][$j]['responsible'] = $item;
            $arrays[$i][$j]['name'] = $idp->name;
            $j++;
        }
        $i++;
    }
    $i = 0;
    $j = 0;
    foreach ($idps as $idp) {

        foreach ($idp->support as $item) {
            
            $arrays[$i][$j]['support'] = $item;
            $arrays[$i][$j]['name'] = $idp->name;
            $j++;
        }
        $i++;
    }
    //dd($arrays);

@endphp
    <div class="container py-3 px-5">
        <div class="row">
            <div class="col-md-12">
                <div id="main-card" style="padding-right: 5%">
                    <div class="card" >
                        <div class="card-header">
                            <h4>
                                Reports                            
                            </h4>
                            
                        </div>
                        <div class="card-body text-center">
                            <div class="table-responsive table-bordered text-center">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <!--<th>#</th> -->
                                        <th>Competencies</th>
                                        <th>S/U/G Priorities</th>
                                        <th>Development Activity</th>
                                        <th>Target Completion Date</th>
                                        <th>Employee Name</th>
                                        <th>Person Responsible</th>
                                        <th>Support Needed</th>
                                    </thead>
                                    <tbody>
                                        @forelse ($arrays as $array)
                                                @foreach ($array as $item)
                                                    <tr>
                                                        <td>{{$item['competency']}}</td>
                                                        <td>{{$item['sug']}}</td>
                                                        <td>{{$item['dev_act']}}</td>
                                                        <td>{{$item['target_date']}}</td>
                                                        <td>{{$item['name']}}</td>
                                                        <td>{{$item['responsible']}}</td>
                                                        <td>{{$item['support']}}</td>
                                                    </tr>
                                                @endforeach

                                        @empty
                                            <tr>
                                                <td colspan="10">No Record Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                {{ $idps->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@include('livewire.main-modal')
</div>




