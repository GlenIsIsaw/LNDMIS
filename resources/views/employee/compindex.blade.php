@extends('layout')


@section('content')
        <main>
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Competency List
                </h2>
            </header>

            <div class="align-self-center">
                <table>
                    @foreach ($comps as $key => $comp)
                        <th>{{$key}}</th>

                        @foreach ($comp as $item)
                        <tr>
                            <td>{{$item->competency_name}}</td>
                        </tr>
                        @endforeach
                    
                    @endforeach
                </table>
            </div>
        </main>
    </body>
</html>

@endsection
