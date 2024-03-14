<div class="row">
    @foreach($contents as $content)
            <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                <div class="box_product">
                    @if (isset($content->thumbnail))
                        <div class="image" style="background-image: url({{ asset($content->thumbnail) }})"></div> 
                    @else
                        <div class="image" style=""></div>
                    @endif
                    
                    <h3>{{ $content->name }}</h3>
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
    @endforeach
</div>