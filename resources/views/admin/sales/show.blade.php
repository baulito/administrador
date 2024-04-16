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
    
@endsection