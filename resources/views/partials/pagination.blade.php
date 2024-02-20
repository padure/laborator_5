@if($paginator->hasPages())
    <nav>
        <a href="{{$paginator->previousPageUrl()}}">Inapoi</a>
        <a href="{{$paginator->nextPageUrl()}}">Inainte</a>
    </nav>
@endif
