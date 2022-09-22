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
      <style>
        table, th, td {
          margin-left:auto;
          margin-right:auto;
          margin-top:25px;
          height:50px;
          width: auto;
          padding:20px;
          border: 2px solid black;
        }
      
    
        </style>
        <title>CNSC | Learning and Development MIS</title>

      </head>

    <body class="mb-48">
        <nav class="bg-red-900 text-white h-24 flex justify-between items-center mb-2">
            <a href="/"
                ><img class="w-24 ml-5" src="images/cnsc.png" alt="" class="logo"
            /></a>
            <ul class="flex space-x-6 mr-6 text-lg">
            @auth
            <ul class="flex space-x-6 mr-6 text-lg">
            <li>
              <span class="ml-5 inline-block border-none py-2 px-4 rounded-xl font-bold uppercase">
                Welcome {{auth()->user()->name}}
              </span>
            </li>
            <li>
              <a href="/user/{{auth()->user()->id}}/edit" class="hover:text-black hover:border-black ml-5 inline-block border-2 border-white py-2 px-4 rounded-xl"><i class="fa-solid fa-gear"></i> Manage Account</a>
            </li>
            <li>
              <form class="inline" method="POST" action="/logout">
                @csrf
                <button type="submit">
                  <nav class="hover:text-yellow-500 hover:border-yellow-500 ml-5 inline-block border-2 border-white py-2 px-4 rounded-xl"><i class="fa-solid fa-door-closed"></i> Logout
                </button>
              </form>
            </li>
            @else
            <li>
              <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
            </li>
            <li>
              <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
            </li>
            @endauth
            </ul>
            @if(session()->has('message'))
            <div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show"
              class="fixed top-0 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
              <p>
                {{session('message')}}
              </p>
            </div>
            @endif
        </nav>
        <main>
    @yield('content')
        </main>
        <footer
        class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-24 mt-24 opacity-90 md:justify-center"
    >
        <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>

        
        
    </footer>
</body>
</html>