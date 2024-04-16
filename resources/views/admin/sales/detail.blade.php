@extends("theme.admin.admin")
@section('content')
    <div class="row  align-items-center">
        <div class="col-sm-10">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" class="mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Ventas</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Venta </li>
                    
                </ol>
            </nav>
        </div>
    </div>
    <h1>Venta No. </h1>
    

    <div class=" pl-5 pr-5 sm:container sm:mx-auto">
        <div class="detalle-compra shadow-xl">
            <div class="text-right">
                <a href="/mypurchases" class="btn btn-sm btn-info">
                    Ir a mis compras
                </a>
            </div>
            <?php if($content->negocio_compra_estado == 1){ ?>
                <div>
                <h1>Gracias por su compra</h1>
                <div class="pagoaprobado">Tu pago fue Aprobado</div>
                </div>
            <?php } else if($content->negocio_compra_estado == 2){ ?>
                <div>
                    <div class="pagorechazado">Tu pago fue Rechazado</div>
                </div>
            <?php } else { ?>
                <div class="pagopendiente">
                    Tu pago se encuentra pendiente de aprobación
                </div>
            <?php } ?>
          <div >
            <div class="">
              <h2>Información de compra</h2>
              <div class="">
                <div class="row">
                  <div class="col-sm-3">
                    <strong>Producto</strong>
                  </div>
                  <div class="col-sm-3">
                    <strong>V. Unitario</strong>
                  </div>
                  <div class="col-sm-3">
                    <strong>Cantidad</strong>
                  </div>
                  <div class="col-sm-3">
                    <strong>V.Total</strong>
                  </div>
                </div>
              </div>
              @foreach ($content->items as $item)
              <div class="caja-producto-detalle">
                <div class="row">
                  <div  class="col-sm-3">
                    <h3>{{ $item->negocio_compra_item_nombre }}</h3>
                  </div>
                  <div class="col-sm-3">
                    $ {{ $item->negocio_compra_item_valor }}
                    
                  </div>
                  <div  class="col-sm-3">
                    <strong class="md:hidden">Cantidad: </strong>
                    $ {{ $item->negocio_compra_item_cantidad }}
                  </div>
                  <div  class="col-sm-3" >
                    $ {{ $item->negocio_compra_item_valor * $item->negocio_compra_item_cantidad }}
                  </div>
                </div>
              </div>
              @endforeach
              
              <hr />
              <br />
              <div>
                <div>Sub Total</div>
                <div>$</div>
                <div>Envio</div>
                <div>$</div>
                <div>Total</div>
                <div>$</div>
              </div>
            </div>
            <div class="text-left">
              <h2>Información de pago</h2>
              <div>
                <strong>Estado pago:</strong>{" "}
                {{$content->negocio_compra_estado_texto}}
              </div>
                <div>
                  <div>
                    <strong>Pagado con:</strong> {{$content->infopago->tipo}}
                  </div>
                  <div>
                    <strong>Medio de pago:</strong> {{$content->infopago->entidad}}
                  </div>
                  <div>
                    <strong>Fecha de pago:</strong> {{$content->infopago->fecha}}
                  </div>
                </div>
            
                <?php if($content->negocio_compra_estado == 0 && $content->negocio_compra_tipopago ){ ?>
                <a
                  class="btn btn-sm btn-info"
                  href={{$content->negocio_compra_urlefecty}}
                >
                  Tiket de pago
                </a>
             <?php } ?>
              <div class="datosconfidenciales">
                El Baulito.co no almacena datos de medios de pago.
              </div>
              <br />

              <h2>Información de Envio</h2>
              <div>
                <strong>Nombre: </strong>
                {{$content->negocio_compra_nombre}}
              </div>
              <div>
                <strong>Correo: </strong>
                {{$content->negocio_compra_correo}}
              </div>
              <div>
                <strong>Dirección: </strong>
                {{$content->negocio_compra_direccion}}
              </div>

              @if ($content->informacionenvio && $content->informacionenvio->tracking)
                  
                <div>
                  <br />
                  <h2>Estado de tu envio</h2>
                  <div class="estadoenvio">
                    <h3>Envio en preparación</h3>
                    <div>{datet}</div>
                  </div>
                  @foreach ($content->informacionenvio->tracking as $traking)
                    <div class="estadoenvio">
                        <h3>{{ $traking->updateState}}</h3>
                        <div>>{{ $traking->date}}</div>
                    </div>
                  @endforeach
                </div>
            @endif
            </div>
          </div>
        </div>
      </div>
@endsection