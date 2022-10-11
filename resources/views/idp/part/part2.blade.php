
        <div>
            <label for="compfunctiondesc" class="inline-block text-lg mb-2" >
                What function do you feel competent to perform?<br>
                (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)
            </label><br>
            <table>
                <tr>
                    <td>
                        <select wire:model="compfunction0" id="compfunctiondesc">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach
                        </select>
                        @error('compfunction0') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <select wire:model="compfunction1" id="compfunctiondesc">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach

                        </select>
                        @error('compfunction1') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea rows="4" cols="50" wire:model="compfunctiondesc0" id="compfunctiondesc">{{old('compfunctiondesc0')}}</textarea>

                        @error('compfunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <textarea rows="4" cols="50" wire:model="compfunctiondesc1" id="compfunctiondesc">{{old('compfunctiondesc1')}}</textarea>

                        @error('compfunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <label for="diffunctiondesc" class="inline-block text-lg mb-2">
                What function do you have a difficulty to perform?<br>
                (Choose two and indicate whether core, functional, or leadership, and specify what specific competency.)                                
            </label><br>
            <table>
                <tr>
                    <td>
                        <select wire:model="diffunction0" id="diffunctiondesc">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach

                        </select>
                        @error('diffunction0') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <select wire:model="diffunction1" id="diffunctiondesc">
                            <option value=""></option>
                            @foreach ($comps as $key => $comp)
                            <optgroup label={{$key}}>
                                @foreach ($comp as $item)
                                <option value="{{$key}}-{{$item->competency_name}}">{{$item->competency_name}}</option>
                                @endforeach
                            @endforeach

                        </select>
                        @error('diffunction1') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                </tr>
                <tr>
                    <td>
                        <textarea rows="4" cols="50" wire:model="diffunctiondesc0" id="diffunctiondesc"></textarea>

                        @error('diffunctiondesc0') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                    <td>
                        <textarea rows="4" cols="50" wire:model="diffunctiondesc1" id="diffunctiondesc"></textarea>

                        @error('diffunctiondesc1') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <p class="inline-block text-lg mb-2">
                Where do you see your career progressing in? the next two years?
            </p>
            <table>
                <tr>
                    <td>
                        <textarea rows="4" cols="50" wire:model="career">{{old('career')}}</textarea>

                        @error('career') <span class="text-danger">{{ $message }}</span> @enderror
                    </td>
                </tr>
            </table>
        </div>

        <button type="button" class="btn btn-secondary" wire:click="backButton"
            data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save</button>
