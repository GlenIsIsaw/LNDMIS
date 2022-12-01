<div class="row d-flex justify-content-center">
    <!--Grid column-->
    <div class="col-md-3 ml-md-auto">

            <label><h6>Total Average:</h6></label>
            <div class="fw-bold">
    
                <p>{{$total_average}} - {{$rating}}</p>
            </div>
            

    
        @if ($rating == 'Not Effective')
            
        <div class="fw-bold text-center float-start mb-3">

                <label><h6>Remarks</h6>
                <textarea wire:model.lazy="remarks" class="border border-3 border-dark rounded-3" style="width: 97%" rows="10" cols="70"></textarea>
                </label>
                @error('remarks')<span class="text-danger">{{$message}}</span><br> @enderror

        @endif
    </div>
    </div>
    <!--Grid column-->
  </div>
    
