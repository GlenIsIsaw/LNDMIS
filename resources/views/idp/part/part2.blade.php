



    
       <div>
            <label for="compfunctiondesc" class="inline-block text-lg mb-2 fw-bold" >
                What function do you feel competent to perform?<br>
                (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
            </label><br>
            <div class="form-floating">
                <tr>
                    <td>

                        <select wire:model="compfunction0" id="compfunctiondesc" class="form-select border border-2 rounded-3 border-dark mb-1" cols="13" style="height: 10px">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach
                        </select>

                        @error('compfunction0') <span class="text-danger">{{ $message }}</span> @enderror

                        <textarea cols="133" style="height: 100px" class="form-control border border-2 rounded-3 border-dark" wire:model="compfunctiondesc0" class="border border-2 rounded-3 border-dark me-5" id="compfunction0"></textarea>
                        <label for ="compfunction0"></label>
                        @error('compfunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror

                    </td>
                </tr>
                

                <div class="form-floating">
                    <tr>
                        <td>
                    
                        <select wire:model="compfunction1" id="compfunctiondesc" class="form-select border border-2 rounded-3 border-dark mb-1 mt-4" cols="13" style="height: 10px">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach

                        </select>
                        @error('compfunction1') <span class="text-danger">{{ $message }}</span> @enderror

                        <textarea cols="133" style="height: 100px" class="form-control border border-2 rounded-3 border-dark" wire:model="compfunctiondesc1" class="border border-2 rounded-3 border-dark ms-5" id="diffunctiondesc"></textarea>
                        <label for = "floatingTextarea2"></label>
                        @error('compfunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                   
                    </td>
                </tr>
                </div>
            </div>
        
        <hr class="h-color mx-2 mt-3">
        <div>
            <label for="diffunctiondesc" class="inline-block text-lg mb-2 fw-bold">
                What function do you have a difficulty to perform?<br>
                (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)                                
            </label><br>
            <div class="form-floating">
                <tr>
                    <td>
                        <select wire:model="diffunction0" id="diffunctiondesc" class="form-select border border-2 rounded-3 border-dark mb-1 mt-4" cols="13" style="height: 10px">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach

                        </select>
                        @error('diffunction0') <span class="text-danger">{{ $message }}</span> @enderror
                        <textarea cols="133" style="height: 100px" wire:model="diffunctiondesc1" class="form-control border border-2 rounded-3 border-dark me-5" id="diffunctiondesc"></textarea>

                        @error('diffunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <select wire:model="diffunction1" id="diffunctiondesc" class="form-select border border-2 rounded-3 border-dark mb-1 mt-4" cols="13" style="height: 10px">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach

                        </select>
                        @error('diffunction1') <span class="text-danger">{{ $message }}</span> @enderror
                        <textarea cols="133" style="height: 100px" wire:model="diffunctiondesc0" class=" form-control border border-2 rounded-3 border-dark me-5" id="diffunctiondesc"></textarea>

                        @error('diffunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
               
                
            
        </div>
        <hr class="h-color mx-2 mt-3">
        <div>
            <p class="inline-block text-lg mb-2 fw-bold">
                Where do you see your career progressing in? the next two years?
            </p>
            <table>
                <div class="form-floating">
                <tr>
                    <td>
                        <textarea cols="153" style="height: 100px" class="form-control border border-2 rounded-3 border-dark me-5"  wire:model="career">{{old('career')}}</textarea>
                        
                        @error('career') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                </tr>
                </div>
            </table>
        </div>
        </div>

  


