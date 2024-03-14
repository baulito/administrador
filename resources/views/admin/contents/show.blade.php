@extends("theme.admin.admin")
@section('content')
    @if (isset($content))
        <h1>{{ $content->title }}</h1>

        <p>{{ $content->subtitle }}</p>
        <p>{{ $content->url }}</p>
        <p>{{ $content->introduction }}</p>
        <p>{{ $content->description }}</p>

        <p>
            @if($content->image)
                <img src="{{ asset('storage/' . $content->image) }}" alt="Imagen">
            @else
                Sin imagen
            @endif
        </p>

        <p>{{ $content->videourl }}</p>
        <p>{{ $content->section }}</p>
        <p>{{ $content->link }}</p>
        <p>{{ $content->order }}</p>

        <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-primary">Editar</a>
    @endif
@endsection