@extends("theme.admin.admin")
@section('content')
    <div class="row  align-items-center">
        <div class="col-sm-10">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" class="mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Ventas</li>
                </ol>
            </nav>
        </div>
    </div>
    <h1>Lista de ventas</h1>
    <table  id="sortable-table" class="table mt-3">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Nombre</th>
                <th>Celular</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Envio</th>
                <th style="width: 200px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contents as $content)
                <tr data-id="{{ $content->compra_id }}">
                    <td>{{ $content->fecha }}</td>
                    <td>{{ $content->nombre }}</td>
                    <td>{{ $content->celular }}</td>
                    <td>${{ number_format($content->total) }}</td>
                    <td>{{ $content->estadopago }}</td>
                    <td>
                        @if ($content->estadopagocode == 1)
                            @if ($content->tipoenvio != 1)
                                @if (isset($content->informacionenvio[0]))
                                    {{  $content->informacionenvio[0]->estadoactual }}
                                @else
                                    No se ha generado envio
                                @endif
                            @else
                                Recogida en Tienda
                            @endif
                        @else
                            No aplica
                        @endif
                    </td>
                    <td>
                        <a  href="{{ route('sales.show', $content->compra_id) }}" class="btn btn-info">Ver</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $('#sortable-table tbody').on('click', '.arrow-up, .arrow-down', function () {
                $(".main-loader").show();
                var row = $(this).closest('tr');
                var currentOrder = row.data('order');
                var direction = $(this).hasClass('arrow-up') ? 'up' : 'down';

                // Envía la solicitud AJAX para actualizar el orden en la base de datos
                $.ajax({
                    url: "{{ route('category.updateOrder') }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        order_id: row.data('id'),
                        current_order: currentOrder,
                        direction: direction
                    },
                    success: function (response) {
                        $(".main-loader").hide();
                        // Actualiza la tabla con los nuevos datos si es necesario
                        if (response.success) {
                            // Mueve la fila en la tabla
                            moveRow(row, direction);
                            //console.log(response.message);
                        } else {
                            
                        }
                    },
                    error: function (error) {
                        console.error(error);
                        $(".main-loader").hide();
                    }
                });
            });

            function moveRow(row, direction) {
                var tbody = row.parent();
                var rows = tbody.children('tr');
                var currentIndex = rows.index(row);
                var newIndex = direction === 'up' ? currentIndex - 1 : currentIndex + 1;

                if (newIndex >= 0 && newIndex < rows.length) {
                    console.log("entro")
                    // Mueve la fila en la tabla
                    rows.eq(currentIndex)[direction === 'up' ? 'insertBefore' : 'insertAfter'](rows.eq(newIndex));
                }
            }
        });
    </script>
@endsection