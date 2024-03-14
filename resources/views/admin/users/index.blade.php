@extends("theme.admin.admin")
@section('content')
    <div class="row  align-items-center">
        <div class="col-sm-10">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" class="mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                </ol>
            </nav>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('users.create') }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    <h1>Lista de Usuarios</h1>

    <form action="/users" >
        <div>
            <div class="row">
                <div class="col-sm-3">
                    <label for="" class="form-label">Busqueda</label>
                    <input type="text" name="busqueda" class="form-control" value="{{ isset($filters['busqueda']) ? $filters['busqueda'] : '' }}" >
                </div>
                <div class="col-sm-3">
                    {!! Form::label('level', 'Nivel:',['class' => 'form-label']) !!}
                    {!! Form::select('level', $Levels, isset($filters['level']) ? $filters['level'] : null, ['class' => 'form-control']) !!}
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
    <table  id="sortable-table" class="table mt-3">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Telefono</th>
                <th>Nivel</th>
                <th style="width: 200px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contents as $content)
                @if (isset($content->user_id))
                    <tr data-id="{{ $content->user_id }}">
                        <td>{{ $content->user_names }} {{ $content->user_lastnames }}</td>
                        <td>{{ $content->user_email }}</td>
                        <td>{{ $content->user_phone }}</td>
                        <td>{{ $Levels[$content->user_level] }}</td>
                        <td>
                            <a style="display: none" href="{{ route('contents.show', $content->user_id) }}" class="btn btn-info">Ver</a>
                            <a href="{{ route('users.edit', $content->user_id) }}" class="btn btn-primary">Editar</a>
                            <form action="{{ route('users.destroy', $content->user_id) }}" method="post" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>
    @include('components.pagination')
@endsection

@section('scripts')

@endsection