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
            {!! Form::label('state', 'Producto Disponible:',['class' => 'form-check-label mb-2']) !!}
            <div>
                <label class="switch">
                    @if (isset($content))
                        {!! Form::checkbox('state',1,$content->state == 1,['id'=>'state']) !!}
                    @else
                        {!! Form::checkbox('state',1,false,['id'=>'state']) !!}
                    @endif
                   
                    <span class="slider round"></span>
                </label>
            </div>
            
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('sku', 'SKU:',['class' => 'form-label']) !!}
            {!! Form::text('sku', null, ['class' => 'form-control']) !!}
            @error('sku')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('category', 'Categoria:',['class' => 'form-label']) !!}
            {!! Form::select('category', $categories, null, ['class' => 'form-control', 'required'=>true]) !!}
        </div>
    </div>
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('description', 'Descripción:') !!}
            {!! Form::textarea('description', null, ['class' => ' textarea-editor']) !!}
            <br>
        </div>
    </div>
    <div class="col-sm-12">
        {!! Form::label( '', 'Imagenes:') !!}
    </div>
    @for ($i = 1; $i < 10; $i++)
        <?php 
            $nameimageurl = 'image_url_'.$i;
            $nameimage = 'image_'.$i;
        ?>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
            <div class="form-group">
                <div class="input-image"  data-image="{{ isset($content) && $content->$nameimage ? $content->$nameimageurl  : '' }}" >
                    <label >
                        <div class="preview">@if(isset($content) && $content->$nameimage)<img src="{{$content->$nameimageurl}}" alt="">@endif</div> 
                        {!! Form::file( $nameimage) !!}
                    </label>
                    <span class="remove" style="display:none;"><i class="fas fa-trash-alt"></i></span>
                    <span class="zoom" style="{{ isset($content) && $content->$nameimage ? ''  : 'display:none;' }}"><i class="far fa-eye"></i></span>
                </div>
            
            </div>
        </div>
    @endfor
    <div class="col-sm-12">
        <div class="form-group">
            {!! Form::label('tags', 'Tags:',['class' => 'form-label ']) !!}
            {!! Form::text('tags', null, ['class' => 'form-control tags']) !!}
            @error('tags')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('product_status', 'Estado del producto:',['class' => 'form-label']) !!}
            {!! Form::select('product_status', $status, null, ['class' => 'form-control', 'required'=>true]) !!}
        </div>
    </div>
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('campus', 'Sede de despacho del producto:',['class' => 'form-label']) !!}
            {!! Form::select('campus', $campus, null, ['class' => 'form-control', 'required'=>true]) !!}
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('wheight', 'Peso:',['class' => 'form-label']) !!}
            {!! Form::text('wheight', null, ['class' => 'form-control inputNumerico', 'required' => 'required']) !!}
            @error('wheight')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('height', 'Alto:',['class' => 'form-label']) !!}
            {!! Form::text('height', null, ['class' => 'form-control inputNumerico', 'required' => 'required']) !!}
            @error('height')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('long', 'Largo:',['class' => 'form-label']) !!}
            {!! Form::text('long', null, ['class' => 'form-control inputNumerico', 'required' => 'required']) !!}
            @error('long')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('width', 'Ancho:',['class' => 'form-label']) !!}
            {!! Form::text('width', null, ['class' => 'form-control inputNumerico', 'required' => 'required']) !!}
            @error('width')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('amount', 'Inventario:',['class' => 'form-label ']) !!}
            {!! Form::text('amount', null, ['class' => 'form-control inputNumerico', 'required' => 'required']) !!}
            @error('amount')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('value', 'Valor:',['class' => 'form-label']) !!}
            {!! Form::text('value', null, ['class' => 'form-control inputNumerico', 'required' => 'required']) !!}
            @error('value')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="col-sm-4">
        <div class="form-group">
            {!! Form::label('old_value', 'Valor en promoción:',['class' => 'form-label']) !!}
            {!! Form::text('old_value', null, ['class' => 'form-control inputNumerico']) !!}
            @error('old_value')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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