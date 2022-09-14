@extends('layout')


@section('content')
@include('partials._hero')


</head>
<body class="mb-48">
    <nav class="flex justify-between items-center mb-4">
        <a href="/"
            ><img class="w-24" src="images/logo.png" alt="" class="logo"
        /></a>
        <ul class="flex space-x-6 mr-6 text-lg">
            <li>
                <a href="manage.html" class="hover:text-laravel"
                    ><i class="fa-solid fa-gear"></i> Manage Gigs</a
                >
            </li>
            <li>
                <form action="/">
                    <button>
                        <i class="fa-solid fa-door-closed"></i> Logout
                    </button>
                </form>
            </li>
        </ul>
    </nav>

    <main>
   
        <form action="/">
            <div class="relative border-2 border-gray-100 m-4 rounded-lg">
                <div class="absolute top-4 left-3">
                    <i
                        class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
                    ></i>
                </div>
                <input
                    type="text"
                    name="search"
                    class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                    placeholder="Search Something"
                />
                <div class="absolute top-2 right-2">
                    <button
                        type="submit"
                        class="h-10 w-20 text-white rounded-lg bg-black-500 hover:bg-red-600"
                    >
                        Search
                    </button>
                </div>
            </div>
        </form>

        <div class="mx-4">
            <div class="bg-gray-50 border border-gray-200 p-10 rounded">
                <header>
                    <h1
                        class="text-3xl text-center font-bold my-6 uppercase"
                    >
                        EMPLOYEE DASHBOARD
                    </h1>
                </header>

                <table class="w-full table-auto rounded-sm">
                    <tbody>
                        <tr class="border-gray-300">
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a href="show.html">
                                    This is a file
                                </a>
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a
                                    href="edit.html"
                                    class="text-blue-400 px-6 py-2 rounded-xl"
                                    ><i
                                        class="fa-solid fa-pen-to-square"
                                    ></i>
                                    Edit</a
                                >
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <form action="">
                                    <button class="text-red-600">
                                        <i
                                            class="fa-solid fa-trash-can"
                                        ></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>

                        <tr class="border-gray-300">
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a href="show.html">
                                   Another file
                                </a>
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <a
                                    href="edit.html"
                                    class="text-blue-400 px-6 py-2 rounded-xl"
                                    ><i
                                        class="fa-solid fa-pen-to-square"
                                    ></i>
                                    Edit</a
                                >
                            </td>
                            <td
                                class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                            >
                                <form action="">
                                    <button class="text-red-600">
                                        <i
                                            class="fa-solid fa-trash-can"
                                        ></i>
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>





@endsection