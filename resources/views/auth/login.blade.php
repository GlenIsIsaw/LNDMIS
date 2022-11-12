
   
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Camarines Norte State College Learning and Development</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="styles.css" />
    @livewireStyles

</head>    
        
       
      

<div style="background-image: linear-gradient(
    to right, #1a2a6c,
    #b21f1f, #fdbb2d);" class="vh-50 py-5"> 


<div class="container py-5 px-3 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-20 col-md-10 col-lg-7 col-xl-6 h-100">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <img src="/images/cnsc.png" class="rounded mx-auto mt-4 mb-1 d-block" alt="..." width="100" height="100">
                <div class="card-title text-center fw-bold fs-2 text-uppercase mt-2 mb-4">{{ __('Log in') }}</div>

                <div class="card-body ">
                  
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                       
                        <div class="row mb-7 text-left">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="border-3 border-secondary w-full py-2 bg-gray-100 text-gray-900 px-1 outline-none mb-4 form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                               
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                               
                            </div>
                            @if (session('error'))
                            <div class="alert alert-danger">
                                    {{ session('error') }}
                            </div>
                        @endif
                        </div>


                        <div class="row mb-7 text-left">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="border-3 border-secondary w-full py-2 bg-gray-100 text-gray-900 px-1 outline-none mb-4 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input border-3" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="d-grid gap-2 col-md-5 offset-md-4 mb-4" >
                                <button type="submit" style="background-image: linear-gradient(
                                    to right, #1a2a6c,
                                    #b21f1f, #fdbb2d);" class="btn btn-secondary bg-red-900 w-full text-white text-uppercase fw-bold py-2 rounded-pill hover:bg-yellow-500 transition-colors mb-7">
                                    {{ __('log In') }}
                                </button>
                            </div>
                            <hr class="px-5">
                                <div class="col-md-auto offset-md-auto">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link text-secondary" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div> 
<footer>

    

</footer>


