<h1>List of Submitted Files</h1>

@foreach ($documents as $document)
<h4><a href="{{ route('document', $document->id)}}">{{$document->pname}}</a></h4>

@endforeach