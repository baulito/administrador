<div class="row">
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('title', 'Título:',['class' => 'form-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('subtitle', 'Subtítulo:',['class' => 'form-label']) !!}
            {!! Form::text('subtitle', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('url', 'URL:',['class' => 'form-label']) !!}
            {!! Form::text('url', null, ['class' => 'form-control','required' => 'required']) !!}
            @error('url')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    {!! Form::label('introduction', 'Introducción:') !!}
    {!! Form::textarea('introduction', null, ['class' => 'form-control','rows'=>'4']) !!}
</div>

<div class="form-group">
    {!! Form::label('description', 'Descripción:') !!}
    {!! Form::textarea('description', null, ['class' => ' textarea-editor']) !!}
</div>

<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('image', 'Imagen:') !!}
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('videourl', 'Video URL:') !!}
            {!! Form::text('videourl', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('section', 'Sección:') !!}
            {!! Form::select('section', $sections, null, ['class' => 'form-control', 'required'=>true]) !!}
        </div>
    </div>
    <div class="col-sm-6">  
        <div class="form-group">
            {!! Form::label('link', 'Enlace:') !!}
            {!! Form::text('link', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('order', null) !!}
@section('scripts')
    <script src="{{ asset('components/tinymce/tinymce.min.js')}}"></script>
    <script>
            tinymce.init({
                selector: '.textarea-editor',
                plugins: 'textcolor lists',
                toolbar: 'fontsize| styleselect | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | bullist numlist | fontsize',
                menubar: false, // Desactiva la barra de menús
                fontsize_formats: '8px 10px 12px 14px 18px 24px 36px',
               
            });

            $('#title').on('input', function() {
                // Obtiene el contenido del campo de texto
                var contenido = $(this).val();

                // Genera la URL (en este ejemplo, simplemente reemplaza espacios con guiones)
                var urlGenerada = contenido.toLowerCase().replace(/\s+/g, '-');

                // Actualiza el elemento donde se muestra la URL generada
                $('#url').val(urlGenerada);
            });

    </script>
@endsection