<div >
    <div class="list-header">
        <div class="row">
            <div class="col-sm-2">
                Imagen
            </div>
            <div class="col-sm-6">
                Producto
            </div>
            <div class="col-sm-2">
                SKU
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
                        <div class="image"> <img src="{{ asset($content->thumbnail) }}" alt=""></div> 
                    @else
                        <div class="image" style=""></div>
                    @endif
                </div>
                <div class="col-sm-6">
                    <div>{{ $content->name }}</div>
                </div>
                <div class="col-sm-2">
                    <div>{{ $content->sku }}</div>
                </div>
                <div class="col-sm-2">
                    <div class="buttons">
                        <div class="row g-1">
                            <div class="col-6 d-grid">
                                <a href="{{ route('product.edit', $content->id) }}" class="btn btn-primary btn-sm btn-block">Editar</a>
                            </div>
                            <div class="col-6 d-grid">
                                <form action="{{ route('product.destroy', $content->id) }}" method="post" class="d-grid">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger btn-block">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>