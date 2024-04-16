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
    <h1>Venta No. {{ $content->negocio_compra_id }}</h1>
    

    <div class=" pl-5 pr-5 sm:container sm:mx-auto">
        <div class="detalle-compra shadow-xl">
            <?php if($content->negocio_compra_estado == 1){ ?>
                <div>
                <div class="pagoaprobado"> El pago fue Aprobado</div>
                </div>
            <?php } else if($content->negocio_compra_estado == 2){ ?>
                <div>
                    <div class="pagorechazado">El pago fue Rechazado</div>
                </div>
            <?php } else { ?>
                <div class="pagopendiente">
                    El pago se encuentra pendiente de aprobación
                </div>
            <?php } ?>
          <div >
            <div class="">
              <h2>Información de compra</h2>
              <div class="encabezado-producto">
                <div class="row">
                  <div class="col-sm-3">
                    <strong>Producto</strong>
                  </div>
                  <div class="col-sm-3 text-end">
                    <strong>V. Unitario</strong>
                  </div>
                  <div class="col-sm-3 text-end">
                    <strong>Cantidad</strong>
                  </div>
                  <div class="col-sm-3 text-end">
                    <strong>V.Total</strong>
                  </div>
                </div>
              </div>
              @foreach ($content->items as $item)
              <div class="caja-producto-detalle">
                <div class="row">
                  <div  class="col-sm-3">
                    {{ $item->negocio_compra_item_nombre }}
                  </div>
                  <div class="col-sm-3 text-end">
                    $ {{ number_format($item->negocio_compra_item_valor) }}
                    
                  </div>
                  <div  class="col-sm-3 text-end">
                    {{ $item->negocio_compra_item_cantidad }}
                  </div>
                  <div  class="col-sm-3 text-end" >
                    $ {{ number_format($item->negocio_compra_item_valor * $item->negocio_compra_item_cantidad) }}
                  </div>
                </div>
              </div>
              @endforeach
              <div class="row text-end">
                <div class="col-sm-9 "><strong>Sub Total</strong></div>
                <div class="col-sm-3">$ {{ number_format($content->negocio_compra_subtotal) }}</div>
                <div class="col-sm-9"><strong>Envio</strong></div>
                <div class="col-sm-3">$ {{ number_format($content->negocio_compra_valor_envio) }}</div>
                <div class="col-sm-9"><strong>Total</strong></div>
                <div class="col-sm-3">$ {{ number_format($content->negocio_compra_valor) }}</div>
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

              @if (isset($content->informacionenvio) && isset($content->informacionenvio->tracking))
                  
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

      <style>
        .pagoaprobado,.pagorechazado,.pagoapendiente{
            font-size: 30px;
            text-align: center;
        }
        .pagoaprobado{
            color: green;
        }

        .pagorechazado{
            color: red;
        }
        .pagoapendiente{
            color: #666;
        }

        .detalle-compra h2{
            color:blue;
            font-size: 20px
        }

        .caja-producto-detalle{
            padding-top: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #CCC;
        }

        .encabezado-producto{
            border-bottom: 1px solid #CCC;
            border-top: 1px solid #CCC;
        }
      </style>
@endsection