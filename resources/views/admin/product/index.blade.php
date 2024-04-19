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
    <form action="/product" >
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
                <div class="col-sm-3">
                    {!! Form::label('out', 'Estado:',['class' => 'form-label']) !!}
                    <select name="out" id="out" class="form-control" >
                        <option value="1">Activos</option>
                        <option value="2" <?php if(isset($filters['out']) &&  $filters['out']== 2){ echo "selected";} ?>>Inactivos</option>
                    </select>
                </div>
                <div class="col-sm-3 ">
                    <div for="" class="form-label">&nbsp;</div>
                    <div class="d-grid">
                        <button class=" btn  btn-success">Filtrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <div class="text-end">
                @if (isset($filters['listtype']) && $filters['listtype'] == 'list')
                    <a class="btn  btn-info" href="{{ $urltype."&listtype=box" }}" ><i class="fas fa-th"></i></a>
                    <a class="btn  btn-secondary" disabled><i class="fas fa-list"></i></a>
                @else
                    <a class="btn  btn-secondary" disabled><i class="fas fa-th"></i></a>
                    <a class="btn  btn-info" href="{{ $urltype."&listtype=list" }}"><i class="fas fa-list"></i></a>
                @endif
            </div>
        </div>
    </form>
    @include('components.pagination')
    @if (isset($filters['listtype']) && $filters['listtype'] == 'list')
        @include('admin.product.list.list')
    @else
        @include('admin.product.list.box')
    @endif
    @include('components.pagination')
@endsection

@section('scripts')
    <script>
    </script>
@endsection