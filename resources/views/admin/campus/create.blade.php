@extends("theme.admin.admin")
@section('content')
    <div class="row  align-items-center">
        <div class="col-sm-10">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" class="mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('campus.index') }}">Sedes</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Crear Sede</li>

                </ol>
            </nav>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('contents.index') }}" class="btn btn-info"><i class="fas fa-hand-point-left"></i> Volver</a>
        </div>
    </div>
    <h1>Crear nueva sede</h1>

        {!! Form::open(['route' => 'campus.store', 'method' => 'post', 'enctype' => 'multipart/form-data' , 'class'=>' g-3 needs-validation','novalidate'=>true]) !!}

        {{-- Incluye el formulario con los campos necesarios --}}
        @include('admin.campus.form')
        <div class="text-right">
            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
        </div>
    {!! Form::close() !!}
@endsection