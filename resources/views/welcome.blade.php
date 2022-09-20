<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        
        <title> Learning And Development </title>
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

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <div class="relative flex items-top justify-center min-h-screen bg-no-repeat bg-center bg-white-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0" >
            @if (Route::has('login'))
                <div class="bg-red-900 hidden fixed top-0 right-0 px- py-4 sm:block w-full">
                    @auth
                        <a href="{{ url('/home') }}" class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black ml-5">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black ml-5">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" ></a>
                        @endif
                    @endauth
                </div>
            @endif

            <section
            class="relative h-72 w-full bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4"
        >
            <div
                class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
                style="background-image: url('images/cnsc.png')"
            ></div>

            <div class="z-10">
                <h1 class="text-6xl font-bold uppercase text-white">
                    Camarines Norte State College

                    <br><span class="text-center">Learning And Development</span>
                </h1>
                <p class="text-2xl text-gray-200 font-bold my-4">
                    <!--comment-->
                </p>
                
            </div>
        </section>
               

                    
                </div>
            </div>
        </div>
        <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
    >
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        
        
    </footer>
    </body>
</html>
