
    <div class="card-header">
        <div class="fw-bold fs-5 text-uppercase text-start">
            Show {{$name}}    
            <div class="float-end ">
                <button type="button" class="btn btn-danger" wire:click="backButton"><i class="fas fa-times px-2 py-1"></i></button>
            </div>
            <button type="button" class="btn btn-info text-white float-end fw-bold text-uppercase py-2 px-2" style="background-image: linear-gradient(
                to bottom, #43C6AC,
                #191654);" wire:click="downloadCert"><i class="fas fa-download me-2"></i>Download</button>
            
        </div>
    </div>
    <div class="card-body">
 

        @if ($fileType == "pdf")
            <div class="container" style="  position: relative;
            width: 100%;
            overflow: hidden;
            padding-top: 56.25%; /* 16:9 Aspect Ratio */">
                <iframe class="responsive-iframe" style="  position: absolute;
                top: 0;
                left: 0;
                bottom: 0;
                right: 0;
                width: 100%;
                height: 100%;
                border: none;" src="{{ url('storage/users/IncomingTrainings/'.$file) }}?{{ rand() }}"></iframe>
        </div>

        @else
            <img class="img-fluid justify-center" style="justify-center" src="{{ url('storage/users/IncomingTrainings/'.$file) }}?{{ rand() }}">
        @endif

    </div>
