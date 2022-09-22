<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "#800000",
                        },
                    },
                },
            };
        </script>
        <title>LNDMIS Log In</title>


    </head>
    <nav class="fixed top-0 left-0 w-full bg-red-900 text-white h-24 flex justify-between items-center">
        <a href="/"
            ><img class="w-24 ml-7" src="images/cnsc.png" alt="" class="logo"
        /></a>
        <ul class="flex space-x-6 mr-6 text-lg">
        
        
       
        </nav>

        <div style="background-image: url('images/lnd.jpg')" class="w-full h-full bg-no-repeat bg-center bg-cover"> 
<div class="container">
    <div class="flex items-center justify-center h-screen w-screen">
        <div class="bg-gray-400 w-96 p-6 rounded shadow-sm">
            <div class="card">
                <div class="card-header text-center text-3xl mb-4">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-7 text-left">
                            <label for="email" class="col-md-4 col-form-label outline-white-900 text-md-end">{{ __('Email Address') }}</label>

                            <div class="row mb-3">
                                <input id="email" type="email" class="w-full py-2 bg-gray-100 text-gray-900 px-1 outline-none mb-4 form-control  @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-7 text-left">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="w-full py-2 bg-gray-100 text-gray-900 px-1 outline-none mb-4 form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

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
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary bg-red-900 w-full text-white py-2 rounded hover:bg-yellow-500 transition-colors mb-7">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
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
<footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
    >
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        
        
    </footer>

