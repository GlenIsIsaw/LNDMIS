<div class="card-header">
    <div class="fw-bolder fs-3 float-start text-uppercase">
        Show Quantified Evaluation Matrix  
    </div>
    <button type="button" class="btn-close mx-2 float-end card-header" data-bs-dismiss="modal" aria-label="Close"
    wire:click="backButton"></button>
</div>
<div class="card-body">
    <div class="mb-1">
        <p>Name: <b>{{$name}} </b></p>
    </div>
    <div class="mb-1">
        <p>Title of Intervension Attended: <b>{{$certificate_title}} </b></p>
    </div>
    <div class="mb-1">
        <p>Date Conducted: <b>{{$date_covered}} </b></p>
    </div>
    <div class="mb-1">
        <p>Date of Evaluation: <b>{{$date_eval}} </b></p>
    </div>
    <div class="mb-1">
        <p>Venue: <b>{{$venue}} </b></p>
    </div>
    <div class="mb-1">
        <p>Sponsors: <b>{{$sponsors}} </b></p>
    </div>
    <div class="mb-1">
        <p>Supervisor: <b>{{$supervisor}} </b></p>
    </div>

    <div class="mb-1">
        <div class="d-flex justify-content-center">
            <p>
                Directions: Please put a checkmark (/) under corresponding responses using scale below.<br>
            </p>
        </div>


            <div class="d-flex justify-content-center">
                <p>
                    Very Effective 		-    2.61 – 3.0	<br>
                    Effective			-    1.81 – 2.60<br>
                    Not Effective		-    1.0  – 1.80<br>

                </p>
            </div>


    </div>

    <div class="table-responsive table-bordered rounded-3 text-center">


        <table class="table table-bordered table-striped border-secondary border border-5 table-hover">

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
    <div class="float-end">
        <h5>
           Total Average: {{$total_average}} - {{$rating}}
        </h5>
    </div>

    <div>
        <h6>
            Note: Remarks if the rating is Not Effective:
        </h6>
        <p>{{$remarks}}</p>
    </div>

</div>