@extends('app')

@section('content')
<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            TeAcercoSalud
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container" style="margin-top: 100px">

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tienda</li>
        </ol>
    </nav>

    {{-- Mensajes de sesión --}}
    @if(session()->has('success_msg'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session()->get('success_msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @if(session()->has('alert_msg'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session()->get('alert_msg') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $error }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
        @endforeach
    @endif

    <h4 class="mb-4">Productos disponibles</h4>
    <div class="row">
        @foreach($medicamentos as $pro)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('images/' . $pro->image_path) }}"
                         class="card-img-top mx-auto"
                         style="height: 150px; width: 150px; display: block;"
                         alt="{{ $pro->nombre }}">
                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $pro->nombre }}</h6>
                        <p>${{ number_format($pro->precioUnitario, 2) }}</p>

                        <form action="{{ route('agragarMedicamento') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $pro->id }}">
                            <input type="hidden" name="nombre" value="{{ $pro->nombre }}">
                            <input type="hidden" name="precioUnitario" value="{{ $pro->precioUnitario }}">
                            <input type="hidden" name="cantidad" value="1">
                            <input type="hidden" name="minimo" value="{{ $pro->minimo }}">
                            <input type="hidden" name="maximo" value="{{ $pro->maximo }}">
                            <input type="hidden" name="detalles" value="{{ $pro->detalles }}">
                            <input type="hidden" name="image_path" value="{{ $pro->image_path }}">

                            <button class="btn btn-secondary btn-sm" title="Agregar al carrito">
                                <i class="fa fa-shopping-cart"></i> Agregar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr class="my-5">
    <h4 class="mb-4">Carrito de compras</h4>

    @if(isset($receta) && count($receta) > 0)
        <div class="table-responsive">
            <table class="table table-bordered text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio unitario</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($receta as $item)
                        <tr>
                            <td>{{ $item->nombre }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>${{ number_format($item->precioUnitario, 2) }}</td>
                            <td>${{ number_format($item->cantidad * $item->precioUnitario, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="d-flex justify-content-between align-items-center mt-3">
            <h5><b>Total: </b>${{ $carrito->obtenerTotal() }}</h5>

            <div>
                <form action="{{ route('limpiarReceta') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-secondary btn-sm">Vaciar carrito</button>
                </form>
                <a href="{{ route('checkout') }}" class="btn btn-success btn-sm">Proceder al Checkout</a>
            </div>
        </div>
    @else
        <p class="text-muted mt-3">No hay productos en tu carrito.</p>
    @endif

    <br><br>
</div>
@endsection
