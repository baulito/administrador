<div class="row">
    <div class="col-sm-8">
        <div class="form-group">
            {!! Form::label('name', 'Nombre:',['class' => 'form-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group ">
            {!! Form::label('dispatch', 'Producto para despacho:',['class' => 'form-check-label mb-2']) !!}
            <div>
                <label class="switch">
                    @if (isset($content))
                        {!! Form::checkbox('dispatch',1,$content->dispatch == 1,['id'=>'dispatch']) !!}
                    @else
                        {!! Form::checkbox('dispatch',1,false,['id'=>'dispatch']) !!}
                    @endif
                   
                    <span class="slider round"></span>
                </label>
            </div>
            
        </div>
    </div>
   
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('country', 'País:') !!}
            {!! Form::select('country', $country, null, ['class' => 'form-control', 'required'=>true]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('city', 'Ciudad:') !!}
            {!! Form::select('city', $city, null, ['class' => 'form-control', 'required'=>true]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('address', 'Dirección:',['class' => 'form-label']) !!}
            {!! Form::text('address', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('address')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('additional', 'Adicional:',['class' => 'form-label']) !!}
            {!! Form::text('additional', null, ['class' => 'form-control', 'required' => 'required', 'placeholder'=>'Barrrio, Oficina, Casa, Apartamento']) !!}
            @error('additional')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('phone1', 'Telefono 1:',['class' => 'form-label']) !!}
            {!! Form::text('phone1', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('phone1')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('phone2', 'Telefono 2:',['class' => 'form-label']) !!}
            {!! Form::text('phone2', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('phone2')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('image', 'Imagen:') !!}
            <div class="input-image"  data-image="{{ isset($content) && $content->image ? $content->image_url  : '' }}" >
                <label >
                    <div class="preview">@if(isset($content) && $content->image)<img src="{{$content->image_url}}" alt="">@endif</div> 
                    {!! Form::file('image') !!}
                </label>
                <span class="remove" style="display:none;"><i class="fas fa-trash-alt"></i></span>
                <span class="zoom" style="{{ isset($content) && $content->image ? ''  : 'display:none;' }}"><i class="far fa-eye"></i></span>
            </div>
           
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('description', 'Descripción:') !!}
            {!! Form::textarea('description', null, ['class' => ' textarea-editor']) !!}
        </div>
    </div>
</div>
{!! Form::hidden('order', null) !!}
<br>
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