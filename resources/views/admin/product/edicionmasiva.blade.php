@extends("theme.admin.admin")
@section('content')
    <div class="row  align-items-center">
        <div class="col-sm-10">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" class="mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edición masiva de productos</li>
                </ol>
            </nav>
        </div>
    </div>
    <h1>Edición masiva de productos</h1>
    <form action="/product/edicionmasiva" >
        <div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="" class="form-label">Busqueda</label>
                    <input type="text" name="busqueda" class="form-control" value="{{ isset($filters['busqueda']) ? $filters['busqueda'] : '' }}" >
                </div>
                <div class="col-sm-3">
                    {!! Form::label('category', 'Categoria:',['class' => 'form-label']) !!}
                    {!! Form::select('category', $categories, isset($filters['category']) ? $filters['category'] : null, ['class' => 'form-control']) !!}
                </div>
                <div class="col-sm-3"></div>
                <div class="col-sm-3 ">
                    <div for="" class="form-label">&nbsp;</div>
                    <div class="d-grid">
                        <button class=" btn  btn-success">Filtrar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('components.pagination')
    @include('admin.product.list.edicion')
    @include('components.pagination')
@endsection

@section('scripts')
    <script>
    </script>
@endsection