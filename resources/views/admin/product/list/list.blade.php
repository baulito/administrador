<div >
    <div class="list-header">
        <div class="row">
            <div class="col-sm-2">
                Imagen
            </div>
            <div class="col-sm-4">
                Producto
            </div>
            <div class="col-sm-2">
                SKU
            </div>
            <div class="col-sm-2">
                Valor
            </div>
            <div class="col-sm-2">
            </div>
        </div>
    </div>
    @foreach($contents as $content)
        <div class="list-product">
            <div class="row align-items-center ">
                <div class="col-sm-2">
                    @if (isset($content->thumbnail))
                        <div class="image zoom-image" data-image="{{ asset($content->image_1) }}"> <img  src="{{ asset($content->thumbnail) }}" alt=""></div> 
                    @else
                        <div class="image" style=""></div>
                    @endif
                </div>
                <div class="col-sm-4">
                    <div>{{ $content->name }}</div>
                </div>
                <div class="col-sm-2">
                    <div>{{ $content->sku }}</div>
                </div>
                <div class="col-sm-2">
                    <div class="values">
                        @if ($content->old_value)
                            <div class="value-old"> {{ number_format($content->value) }}</div>
                            <div class="value">{{ number_format($content->old_value) }}</div>
                        @else
                            <div class="value">{{ number_format($content->value) }}</div>
                        @endif
                   
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="buttons">
                        <div class="row g-1">
                            <div class="col-6 d-grid">
                                <a href="{{ route('product.edit', $content->id) }}" class="btn btn-primary btn-sm btn-block">Editar</a>
                            </div>
                            <div class="col-6 d-grid">
                                <a class="btn btn-danger eliminar-btn" data-toggle="modal" data-target="#confirmarEliminarModal" data-id="{{ $content->id }}"><i class="fas fa-trash-alt"></i></a>
                                <form action="{{ route('product.destroy', $content->id) }}" id="form-delete-{{  $content->id }}" method="post" class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>