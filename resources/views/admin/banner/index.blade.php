@extends("theme.admin.admin")
@section('content')
    <div class="row  align-items-center">
        <div class="col-sm-10">
            <nav aria-label="breadcrumb" >
                <ol class="breadcrumb" class="mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home-admin') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Banners</li>
                </ol>
            </nav>
        </div>
        <div class="col-sm-2 text-right">
            <a href="{{ route('banner.create') }}" class="btn btn-success"><i class="fas fa-plus"></i></a>
        </div>
    </div>
    <h1>Lista de Banners</h1>
    <table  id="sortable-table" class="table mt-3">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Imagen</th>
                <th style="width: 100px">Orden</th>
                <th style="width: 200px">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($contents as $content)
                <tr data-id="{{ $content->id }}" data-order="{{ $content->order }}">
                    <td>{{ $content->title }}</td>
                    <td>
                        @if(isset($content->image_url) )
                            <img src="{{ asset($content->image_url) }}" alt="Imagen" class="img-thumbnail">
                        @else
                            Sin imagen
                        @endif
                    </td>
                    <td class="order-handle">
                        <button class="btn btn-info arrow-up"><i class="fas fa-sort-up"></i></button>
                        <button class="btn btn-info arrow-down"><i class="fas fa-sort-down"></i></button>
                    </td>
                    <td>
                        <a style="display: none" href="{{ route('contents.show', $content->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('banner.edit', $content->id) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('banner.destroy', $content->id) }}" method="post" style="display:inline">
                             @csrf
                             @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
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
                    url: "{{ route('banner.updateOrder') }}",
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