<div class="row">
    @foreach($contents as $content)
            <div class="col-sm-6 col-md-4 col-lg-3 col-xxl-2">
                <div class="box_product <?php if( $content->state != 1 || $content->amount < 1 ){ echo "product_out"; } ?>">
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
    @endforeach
</div>