<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Show Quantified Evaluation Matrix  
    </div>
    <div class="float-end">   
        <button type="button" class="btn btn-danger float-end" wire:click="backButton"><i class="fas fa-times fa-4"></i></button></div>
</div>
<div class="card-body">
    <div class="col">
        <table class="table table-striped table-hover rounded-3">
            <tr>
                <th style="width:20%">Name</th>
                <td class="text-left text-capitalize">{{$name}}</td>
                
            </tr>
            <tr>
                <th>Tile Intervention Attended</th>
                <td class="text-left text-capitalize">{{$certificate_title}} </td>
            </tr>
            <tr>
                <th>Date Conducted</th>
                <td class="text-left text-capitalize">{{$date_covered}}</td>
            </tr>
            <tr>
                <th>Date of Evaluation</th>
                <td class="text-left text-capitalize">{{$date_eval}}</td>
            </tr>
            <tr>
                <th>Venue</th>
                <td class="text-left text-capitalize">{{$venue}}</td>
            </tr>

            <tr>
                <th>Sponsors</th>
                <td class="text-left text-capitalize">{{$sponsors}} </td>
            </tr>
            <tr>
                <th>Supervisor</th>
                <td class="text-left text-capitalize">{{$supervisor}}</td>
            </tr>
        </table>
    </div>


    <div class="mt-2">
        
        </div>


            <div class="d-flex justify-content-center">
             
                    <table class="table-hover" style="width:40%">
               <tr>
                    <th style="width:30%">Very Effective</th>
                    <td style="width:30%">  2.61 – 3.0 </td>
               </tr>
               <tr>
                <th>Effective </th>
                <td>1.81 – 2.60</td>
               </tr>
               <tr>
                    <th>Not Effective</th>
                    <td>1.0  – 1.80</td>

               </tr>
                
                    </table>
                
            </div>

            
    </div>

    <div class="card-body">
        <div class="d-flex justify-content-center">
            <p class="mt-3">
                Direction: Please put a checkmark (/) under corresponding responses using the scale below.<br>
            </p>
        </div>
        <div class="col">
    <div class="table-responsive table-bordered rounded-3 text-center">


        <table class="table table-sm table-bordered table-striped border-secondary border border-5 table-hover px-5">

                <tr>
                    <th>Particulars</th>
                    <th colspan="5">Rating</th>
                </tr>

                <tr>
                    <th>
                         I. <u>CONTENT AND RELEVANCE OF THE SEMINAR</u>
                    </th>
                    <td>Very Effective - 3</td>
                    <td>Effective - 2</td>
                    <td>Not Effective - 1</td>
                    <td>N/A</td>
                    <td>Numerical & Adjectival Rating</td>
                </tr>
    
                <tr>
                    <td>
                        1.	The training is relevant to the mandate of the institution.
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.0" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.0" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.0" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.0" disabled>
                    </td>
                    <td>
                        @if ($content[0] == 'on')
                        <p>N/A</p>
                        @else
                            <p>{{$content[0]}}</p>
                        @endif
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        2.	The objectives of the training are function of the office/unit.
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.1" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.1" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.1" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.1" disabled>
                    </td>
                    <td>
                        @if ($content[1] == 'on')
                        <p>N/A</p>
                        @else
                            <p>{{$content[1]}}</p>
                        @endif
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        3.	The employee is capable in performing the acquired knowledge to his/her office.
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.2" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.2" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.2" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="content.2" disabled>
                    </td>
                    <td>
                        @if ($content[2] == 'on')
                        <p>N/A</p>
                        @else
                            <p>{{$content[2]}}</p>
                        @endif
                        
                    </td>
                </tr>
                <tr>
                    <th colspan="5">SUB-TOTAL RATING</th>
                    <td><p>{{$content['total']}}</p></td>
                </tr>
                <tr>
                    <th colspan="5">AVERAGE RATING</th>
                    <td><p>{{$content['average']}}</p></td>
                </tr>
    
        </table>
        <table class="table table-bordered table-striped border-secondary border border-5 table-hover">

                <tr>
                    <th>Particulars</th>
                    <th colspan="5">Rating</th>
                </tr>

                <tr>
                    <th>
                         II. <u>BENEFITS TO THE INSTITUTION</u>
                    </th>
                    <td>Very Effective - 3</td>
                    <td>Effective - 2</td>
                    <td>Not Effective - 1</td>
                    <td>N/A</td>
                    <td>Numerical & Adjectival Rating</td>
                </tr>
    
                <tr>
                    <td>
                        1.	The employee demonstrates improvement in the delivery of services
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.0" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.0" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.0" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.0" disabled>
                    </td>
                    <td>
                        @if ($benefits[0] == 'on')
                            <p>N/A</p>
                        @else
                            <p>{{$benefits[0]}}</p>
                        @endif
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        2.	The employee demonstrate competency in performing the task assigned to his/her office
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.1" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.1" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.1" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.1" disabled>
                    </td>
                    <td>
                        @if ($benefits[1] == 'on')
                            <p>N/A</p>
                        @else
                            <p>{{$benefits[1]}}</p>
                        @endif
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        3.	There is an improvement in the clientele satisfaction rating.
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.2" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.2" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.2" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.2" disabled>
                    </td>
                    <td>
                        @if ($benefits[2] == 'on')
                            <p>N/A</p>
                        @else
                            <p>{{$benefits[2]}}</p>
                        @endif
                        
                    </td>
                </tr>
    
                <tr>
                    <td>
                        4.	The training contributes to the attainment of vision of CNSC
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.3" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.3" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.3" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="benefits.3" disabled>
                    </td>
                    <td>
                        @if ($benefits[3] == 'on')
                            <p>N/A</p>
                        @else
                            <p>{{$benefits[3]}}</p>
                        @endif
                        
                    </td>
                </tr>

                <tr>
                    <th colspan="5">SUB-TOTAL RATING</th>
                    <td><p>{{$benefits['total']}}</p></td>
                </tr>
                <tr>
                    <th colspan="5">AVERAGE RATING</th>
                    <td><p>{{$benefits['average']}}</p></td>
                </tr>

        </table>

        <table class="table table-bordered table-striped border-secondary border border-5 table-hover">
            <thead>
                <tr>
                    <th>Particulars</th>
                    <th colspan="5">Rating</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th> 
                         III. <u>REALIZATION OF THE PERSONAL ACTION PLAN</u>
                    </th>
                    <td>Very Effective - 3</td>
                    <td>Effective - 2</td>
                    <td>Not Effective - 1</td>
                    <td>N/A</td>
                    <td>Numerical & Adjectival Rating</td>
                </tr>
    
                <tr>
                    <td>
                        1.	Employee conducted re-echo seminar to his/her peers
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.0" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.0" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.0" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.0" disabled>
                    </td>
                    <td>
                        @if ($realization[0] == 'on')
                            <p>N/A</p>
                        @else
                            <p>{{$realization[0]}}</p>
                        @endif
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        2.	Employee conducted re-echo through informal talk.
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.1" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.1" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.1" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.1" disabled>
                    </td>
                    <td>
                        @if ($realization[1] == 'on')
                            <p>N/A</p>
                        @else
                            <p>{{$realization[1]}}</p>
                        @endif
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        3.	Co-employees benefited from the re-echo
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.2" value="3" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.2" value="2" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.2" value="1" disabled>
                    </td>
                    <td>
                        <input class="form-check-input" type="radio" wire:model="realization.2" disabled>
                    </td>
                    <td>
                        @if ($realization[2] == 'on')
                            <p>N/A</p>
                        @else
                            <p>{{$realization[2]}}</p>
                        @endif
                        
                    </td>
                </tr>
                <tr>
                    <th colspan="5">SUB-TOTAL RATING</th>
                    <td><p>{{$realization['total']}}</p></td>
                </tr>
                <tr>
                    <th colspan="5">AVERAGE RATING</th>
                    <td><p>{{$realization['average']}}</p></td>
                </tr>
    
    
    
            </tbody>
        </table>


    
    </div>
   

</div>
    </div>
    <div class="card-footer mx-2">
        <div class="float-start text-capitalize fw-light  fs-5 fst-italic">
           
                Remarks if the rating is Not Effective:
            
           <p> {{$remarks}} </p>
        </div>

        <div class="float-end text-uppercase fw-bold fs-5">
         
               Total Average: <p class="badge badge-pill fs-5 text-white" style="background-color: #926F34">{{$total_average}} - 
               
               {{$rating}} </p>
            
        </div>
    </div>
</div>

