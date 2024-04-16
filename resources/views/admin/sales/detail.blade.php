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
    

    <div className=" pl-5 pr-5 sm:container sm:mx-auto">
        <div className="detalle-compra shadow-xl">
            <div className="text-right">
                <a href="/mypurchases" className="btn btn-sm btn-info">
                    Ir a mis compras
                </a>
            </div>
            <?php if($content->negocio_compra_estado == 1){ ?>
                <div>
                <h1>Gracias por su compra</h1>
                <div className="pagoaprobado">Tu pago fue Aprobado</div>
                </div>
            <?php } else if($content->negocio_compra_estado == 2){ ?>
                <div>
                    <div className="pagorechazado">Tu pago fue Rechazado</div>
                    <div className="text-center">
                        <a className="btn btn-sm btn-info"  href="/cart" >Reintentar Pago</a> 
                    </div>
                </div>
            <?php } else { ?>
                <div className="pagopendiente">
                    Tu pago se encuentra pendiente de aprobación
                </div>
            <?php } ?>
          <div >
            <div className="">
              <h2>Información de compra</h2>
              <div className="">
                <div
                  className="row"
                >
                  <div className="col-sm-3">
                    <strong>Producto</strong>
                  </div>
                  <div className="col-sm-3">
                    <strong>V. Unitario</strong>
                  </div>
                  <div className="col-sm-3">
                    <strong>Cantidad</strong>
                  </div>
                  <div className="col-sm-3">
                    <strong>V.Total</strong>
                  </div>
                </div>
              </div>
              @foreach ($content->items as $item)
              <div className={"caja-producto-detalle"}>
                <div
                  className={
                    "grid grid-cols-2  md:grid-cols-8 gap-4 items-center"
                  }
                >
                  <div className={" col-span-2 md:col-span-5"}>
                    <h3>{item.negocio_compra_item_nombre}</h3>
                    {item.caracteristicastxt ? (
                      <div
                        style={{ fontSize: "12px" }}
                        dangerouslySetInnerHTML={{
                          __html: "" + item.caracteristicastxt,
                        }}
                      ></div>
                    ) : (
                      ""
                    )}
                  </div>
                  <div className="hidden md:inline-grid">
                    $
                    {item.negocio_compra_item_valor.toLocaleString(
                      "en-us",
                      { minimumFractionDigits: 0 }
                    )}
                  </div>
                  <div>
                    <strong className="md:hidden">Cantidad: </strong>
                    {item.negocio_compra_item_cantidad}
                  </div>
                  <div className={"text-right"}>
                    $
                    {(
                      item.negocio_compra_item_valor *
                      item.negocio_compra_item_cantidad
                    ).toLocaleString("en-us", {
                      minimumFractionDigits: 0,
                    })}
                  </div>
                </div>
              </div>
              @endforeach
              
              <hr />
              <br />
              <div
                className={
                  "grid grid-cols-3 md:grid-cols-10 gap-4 items-center mr-3"
                }
              >
                <div
                  className={"col-span-2 md:col-span-9 text-right totales"}
                >
                  Sub Total
                </div>
                <div className={"text-right"}>
                  
                </div>
                <div
                  className={"col-span-2 md:col-span-9 text-right totales"}
                >
                  Envio
                </div>
                <div className={"text-right"}>
                  $
                  
                </div>
                <div
                  className={"col-span-2 md:col-span-9 text-right totales"}
                >
                  Total
                </div>
                <div className={"text-right"}>
                  
                </div>
              </div>
            </div>
            <div className="text-left">
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
                  className="btn btn-sm btn-info"
                  href={{$content->negocio_compra_urlefecty}}
                >
                  Tiket de pago
                </a>
             <?php } ?>
              <div className="datosconfidenciales">
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
                  <div className="estadoenvio">
                    <h3>Envio en preparación</h3>
                    <div>{datet}</div>
                  </div>
                  @foreach ($content->informacionenvio->tracking as $traking)
                    <div className="estadoenvio">
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