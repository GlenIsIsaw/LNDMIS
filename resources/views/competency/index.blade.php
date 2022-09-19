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
                    <th>Competencies</th>
                    <th>Teaching</th>
                    <th>Non-Teaching</th>
                    @foreach ($comps as $key => $comp)
                    
                    <tr>
                        <th>{{$key}}</th>
                        <td></td>
                        <td></td>
                    </tr>
                        @foreach ($comp as $item)
                        <tr>
                            <td>{{$item->competency_name}}</td>
                            <td>{{$item->teaching}}</td>
                            <td>{{$item->nonteaching}}</td>
                        </tr>
                        @endforeach
                    
                    @endforeach
                </table>
            </div>
        </main>
    </body>
</html>

@endsection
