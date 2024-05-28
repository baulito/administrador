<table class="table table-striped table-bordered table-edicion mt-5 table-hover">
    <thead>
        <tr>
            <th></th>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>SKU</th>
            <th>Disponibilidad</th>
            <th>Estado</th>
            <th>Sede</th>
            <th width="50">Peso</th>
            <th width="50">Alto</th>
            <th width="50">Largo</th>
            <th width="50">Ancho</th>
            <th width="60">Inventario</th>
            <th width="100">Valor</th>
            <th width="100">Promoción</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contents as $content)
            <tr>
                <td>
                    <a class="btn btn-danger eliminar-btn" data-toggle="modal" data-target="#confirmarEliminarModal" data-id="{{ $content->id }}"><i class="fas fa-trash-alt"></i></a>
                    <form action="{{ route('product.destroy', $content->id) }}" id="form-delete-{{  $content->id }}" method="post" class="d-grid">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
                <td>
                    @if (isset($content->thumbnail))
                        <div class="image-min  zoom-image" data-image="{{ asset($content->image_1) }}"> <img src="{{ asset($content->thumbnail) }}" alt=""></div> 
                    @else
                        <div class="image" style=""></div>
                    @endif
                </td>
                <td>
                    <div>{{ $content->name }}</div>
                </td>
                <td>
                    <div>{!! Form::text('sku', $content->sku, ['class' => 'form-control form-control-sm update-data','data-producto'=>$content->id]) !!}</div>
                </td>
                <td>
                    <label class="switch">
                        {!! Form::checkbox('state',1,$content->state == 1,['id'=>'state','data-producto'=>$content->id,"class"=>'update-data']) !!}
                        <span class="slider round"></span>
                    </label>
                </td>
                <td>
                    {!! Form::select('product_status', $status, $content->product_status, ['class' => 'form-select form-select-sm update-data', 'required'=>true,'data-producto'=>$content->id]) !!}
                </td>
                <td>{!! Form::select('campus', $campus, $content->campus, ['class' => 'form-select form-select-sm update-data', 'required'=>true,'data-producto'=>$content->id]) !!}</td>
                <td>{!! Form::text('wheight',$content->wheight, ['class' => 'form-control form-control-sm inputNumerico update-data', 'required' => 'required','data-producto'=>$content->id]) !!}</td>
                <td>{!! Form::text('height', $content->height, ['class' => 'form-control form-control-sm inputNumerico update-data', 'required' => 'required','data-producto'=>$content->id]) !!}</td>
                <td>{!! Form::text('long',  $content->long, ['class' => 'form-control form-control-sm inputNumerico update-data', 'required' => 'required','data-producto'=>$content->id]) !!}</td>
                <td>{!! Form::text('width', $content->width , ['class' => 'form-control form-control-sm inputNumerico update-data', 'required' => 'required','data-producto'=>$content->id]) !!}</td>
                <td>{!! Form::text('amount', $content->amount , ['class' => 'form-control form-control-sm inputNumerico update-data', 'required' => 'required','data-producto'=>$content->id]) !!}</td>
                <td>{!! Form::text('value', $content->value , ['class' => 'form-control form-control-sm inputNumerico update-data', 'required' => 'required','data-producto'=>$content->id]) !!}</td>
                <td>{!! Form::text('old_value', $content->old_value , ['class' => 'form-control form-control-sm inputNumerico update-data','data-producto'=>$content->id]) !!}</td>
            </tr>
        @endforeach
    </tbody>
</table>