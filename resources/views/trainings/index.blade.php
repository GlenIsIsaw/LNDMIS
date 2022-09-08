<h1>List of Submitted Certificates</h1>

@foreach ($lists as $list)
<h4><a href="{{route('training.show',$list->id)}}">{{$list->certificate_title}} submitted by {{$list->name}}</a></h4>

@endforeach

<h4><a href="{{ route('training.printall')}}">Print All</a></h4>