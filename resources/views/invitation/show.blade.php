
    <div class="card-header">
        <div class="fw-bold fs-5 text-uppercase">
            Show {{$name}}    
            <button type="button" class="btn-close mx-2 float-end card-header" data-bs-dismiss="modal" aria-label="Close"
            wire:click="backButton"></button>
            <button type="button" class="btn btn-info text-white float-start text-uppercase py-1" style="background-image: linear-gradient(
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
