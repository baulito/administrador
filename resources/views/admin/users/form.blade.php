<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_names', 'Nombres:',['class' => 'form-label']) !!}
            {!! Form::text('user_names', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('user_names')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_lastnames', 'Apellidos:',['class' => 'form-label']) !!}
            {!! Form::text('user_lastnames', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('user_lastnames')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('user_email', 'Correo:',['class' => 'form-label']) !!}
            {!! Form::text('user_email', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('user_email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_typeid', 'Tipo Documento:',['class' => 'form-label']) !!}
            {!! Form::select('user_typeid', $documentType, null, ['class' => 'form-select']) !!}
            @error('user_typeid')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_idnumber', 'Documento:',['class' => 'form-label']) !!}
            {!! Form::text('user_idnumber', null, ['class' => 'form-control inputNumerico']) !!}
            @error('user_idnumber')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_city', 'Ciudad:',['class' => 'form-label']) !!}
            {!! Form::text('user_city', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('user_city')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_phone', 'Telefono:',['class' => 'form-label']) !!}
            {!! Form::text('user_phone', null, ['class' => 'form-control inputNumerico', 'required' => 'required']) !!}
            @error('user_phone')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_address', 'Direccion:',['class' => 'form-label']) !!}
            {!! Form::text('user_address', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('user_address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_level', 'Nivel:',['class' => 'form-label']) !!}
            {!! Form::select('user_level', $Levels, null, ['class' => 'form-select']) !!}
            @error('user_level')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_user', 'Usuario:',['class' => 'form-label']) !!}
            {!! Form::text('user_user', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('user_user')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('user_password', 'Contraseña:',['class' => 'form-label']) !!}
            <input type="password" name="user_password" id="user_password" class="form-control">
            @error('user_password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-12">
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('user_foto', 'Foto:') !!}
            <div class="input-image"  data-image="{{ isset($content) && $content->user_foto ? $content->thumbnail  : '' }}" >
                <label >
                    <div class="preview">@if(isset($content) && $content->user_foto)<img src="{{$content->thumbnail}}" alt="">@endif</div>
                    {!! Form::file('user_foto') !!}
                </label>
                <span class="remove" style="display:none;"><i class="fas fa-trash-alt"></i></span>
                <span class="zoom" style="{{ isset($content) && $content->user_foto ? ''  : 'display:none;' }}"><i class="far fa-eye"></i></span>
            </div>
        </div>
    </div>
</div>
{!! Form::hidden('order', null) !!}
@section('scripts')
    
@endsection