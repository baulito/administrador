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
              <br><br>
                <div class="row">
                    <div class="col-sm-6">
                        <h2>Información de pago</h2>
                        <div>
                          <strong>Estado pago:</strong>
                          {{$content->negocio_compra_estado_texto}}
                        </div>
                        @if (isset($content->infopago) && isset($content->infopago->tipo))
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
                        @endif
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
                    </div>
                    <div class="col-sm-6">
                      
                      @if ($content->negocio_compra_tipoenvio != 1)
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
                      @else
                        <h2>El Cliente recogera el paquete en: </h2>
                        @if ($content->campus)
                          <div> <strong>Sede: </strong> {{ $content->campus->name }}</div>
                          <div> <strong>Dirección: </strong> {{ $content->campus->address }}  {{ $content->campus->additional }}</div>
                          <div> <strong>Ciudad: </strong> {{ $content->campus->cityname }}</div>
                        @endif
                        
                      @endif
                    </div>
                </div>
              
              
              
                <br><br>
                @if ($content->negocio_compra_tipoenvio != 1)
                    @if (isset($content->informacionenvio) && isset($content->informacionenvio[0]))
                        <div>
                            <h2>Estado de tu envio</h2>
                            @foreach ($content->informacionenvio as $key => $informacion)
                                <div class="info-paquete">
                                  <div class="row">
                                      <div class="col-sm-9">
                                        <h3>Paquete enviado por {{ $informacion->transportadora }} desde  {{ $informacion->desde }}</h3>
                                        <div class="guia-paquete">No de guia:  {{ $informacion->guide }}</div>
                                      </div>
                                      <div class="col-sm-3 text-right">
                                         @if (isset($informacion->pdfGuide))
                                             <a class="btn btn-sm btn-primary" href="{{ $informacion->pdfGuide }}" target="_blank">Descargar Guía</a>
                                         @endif
                                      </div>
                                  </div>
                                  
                                    @if (count($content->informacionenvio) > 1)

                                      <h3>Paquete No. {{ $key+1 }}</h3>
                                    @endif
                                    <div class="row">
                                      @foreach ($informacion->seguimiento as $pos => $traking)
                                          <div class="col-sm-3" >
                                              <div class="estadoenvio <?php if(($pos+1) == count($informacion->seguimiento) ){ echo "actual"; } ?>">
                                                  <h4>{{ $traking->estado}}</h4>
                                                  <div>{{ $traking->fecha}}</div>
                                              </div>
                                          </div>
                                      @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        @if ( $content->negocio_compra_estado == 1)
                            <div>
                                <h2>No se ha generado una guía</h2>
                                @if ($generacionGuia->susses == true)
                                    <button class="btn btn-info" id="generarguia" data-id="{{ $content->negocio_compra_id }}">Generar Guía</button>
                                @else
                                    <div>{{ $generacionGuia->message  }}</div>
                                @endif
                            </div>
                        @endif
                    @endif
                @else
                    <div>
                          <h2></h2>
                    </div>
                @endif
            </div>
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