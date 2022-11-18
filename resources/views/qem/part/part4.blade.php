<div class="row d-flex justify-content-center">
    <!--Grid column-->
    <div class="col-md-6">

            <label><h6>Total Average:</h6></label>
            <div class="fw-bold">
    
                <p>{{$total_average}} - {{$rating}}</p>
            </div>
            

    
        @if ($rating == 'Not Effective')
            
        

                <label><h6>Remarks</h6>
                <textarea wire:model.lazy="remarks" cols="30" rows="10"></textarea>
                </label>
                @error('remarks')<span class="text-danger">{{$message}}</span><br> @enderror

        @endif
    </div>
    <!--Grid column-->
  </div>
    
