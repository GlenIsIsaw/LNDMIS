<h1>List of Submitted Files</h1>

@foreach ($documents as $document)
<h4><a href="{{ route('document', $document->id)}}">{{$document->sname}}</a></h4>

@endforeach

<h4><a href="{{ route('document.printall')}}">Print All</a></h4>