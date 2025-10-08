@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Medicamentos</h2>

    <div class="row">
        @foreach($productos as $producto)
        <div class="col-md-3 mb-4">
            <div class="card shadow-sm">
                <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="text-muted">${{ number_format($producto->precio, 2) }}</p>
                    <button class="btn btn-primary btn-agregar"
                            data-id="{{ $producto->id }}"
                            data-nombre="{{ $producto->nombre }}"
                            data-precio="{{ $producto->precio }}">
                        Agregar
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Tabla debajo -->
    <div class="card mt-5 shadow">
        <div class="card-header bg-dark text-white"> Carrito </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0" id="tabla-carrito">
                <thead class="table-dark">
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
        <div class="card-footer text-end">
            <h5>Total general: <span id="totalGeneral" class="fw-bold text-success">$0.00</span></h5>
        </div>
    </div>
</div>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const tabla = document.querySelector('#tabla-carrito tbody');
    const totalGeneralEl = document.getElementById('totalGeneral');
    const productosAgregados = {};

    document.querySelectorAll('.btn-agregar').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;
            const nombre = btn.dataset.nombre;
            const precio = parseFloat(btn.dataset.precio);

            if (productosAgregados[id]) {
                const fila = document.getElementById(`fila-${id}`);
                const cantidadInput = fila.querySelector('.cantidad');
                cantidadInput.value = parseInt(cantidadInput.value) + 1;
                actualizarTotalFila(fila, precio);
            } else {
                const fila = document.createElement('tr');
                fila.id = `fila-${id}`;
                fila.innerHTML = `
                    <td>${nombre}</td>
                    <td>$${precio.toFixed(2)}</td>
                    <td><input type="number" min="1" value="1" class="form-control form-control-sm cantidad" style="width:80px;"></td>
                    <td class="total">$${precio.toFixed(2)}</td>
                    <td><button class="btn btn-danger btn-sm eliminar">🗑</button></td>
                `;
                tabla.appendChild(fila);
                productosAgregados[id] = { precio };

                fila.querySelector('.cantidad').addEventListener('change', e => {
                    if (e.target.value < 1) e.target.value = 1;
                    actualizarTotalFila(fila, precio);
                });

                fila.querySelector('.eliminar').addEventListener('click', () => {
                    delete productosAgregados[id];
                    fila.remove();
                    actualizarTotalGeneral();
                });
            }
            actualizarTotalGeneral();
        });
    });

    function actualizarTotalFila(fila, precio) {
        const cantidad = parseInt(fila.querySelector('.cantidad').value);
        const total = cantidad * precio;
        fila.querySelector('.total').textContent = `$${total.toFixed(2)}`;
        actualizarTotalGeneral();
    }

    function actualizarTotalGeneral() {
        let total = 0;
        document.querySelectorAll('#tabla-carrito tbody tr').forEach(fila => {
            const valor = parseFloat(fila.querySelector('.total').textContent.replace('$', ''));
            total += valor;
        });
        totalGeneralEl.textContent = `$${total.toFixed(2)}`;
    }
});
</script>
@endsection
