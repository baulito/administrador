@extends("theme.admin.admin")
@section('content')
    <div class="row  align-items-center">
        <div class="col-sm-10">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" class="mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('contents.index') }}">Contenidos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear Contenido</li>

                </ol>
            </nav>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('contents.index') }}" class="btn btn-info"><i class="fas fa-hand-point-left"></i> Volver</a>
        </div>
    </div>
    <h1>Crear nueva categoria</h1>

        {!! Form::open(['route' => 'category.store', 'method' => 'post', 'enctype' => 'multipart/form-data' , 'class'=>' g-3 needs-validation','novalidate'=>true]) !!}

        {{-- Incluye el formulario con los campos necesarios --}}
        @include('admin.category.form')
        <div class="text-right">
            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
        </div>
    {!! Form::close() !!}
@endsection