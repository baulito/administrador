@extends("theme.admin.admin")
@section('content')
    <div class="row  align-items-center">
        <div class="col-sm-10">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" class="mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">productos</li>
                </ol>
            </nav>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('product.create') }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    <h1>Lista de productos</h1>
    <div class="row">
        @foreach($contents as $content)
                <div class="col-sm-4 col-md-3 col-lg-2">
                    <div class="box_product">
                        <div class="image" style="background-image: url({{ asset($content->thumbnail) }})"></div>
                        <h3>{{ $content->name }}</h3>
                        <div class="buttons">
                            <div class="row g-1">
                                <div class="col-6 d-grid">
                                    <a href="{{ route('product.edit', $content->id) }}" class="btn btn-primary btn-sm btn-block">Editar</a>
                                </div>
                                <div class="col-6 d-grid">
                                    <form action="{{ route('product.destroy', $content->id) }}" method="post" class="d-grid">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger btn-block">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
    </script>
@endsection