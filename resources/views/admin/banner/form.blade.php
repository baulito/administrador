<div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            {!! Form::label('title', 'Título:',['class' => 'form-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
            @error('name')
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
</div>
{!! Form::hidden('order', null) !!}
@section('scripts')
    
@endsection