<?php
namespace App\Http\Servicios;
use Illuminate\Support\Facades\DB;

class Bd
{
    public function obtenerMedicamentos()
    {
        return Inventario::all();
    }
    public function obtenerMedicamentosConUpdate()
    {
        return Inventario::all()->lockForUpdate();
    }

    public function checkOut($inventario, $receta)
    {
        foreach ($receta as $medicamento) {
            $med = Invetario::where('id', $medicamento->id)
                ->first();

            if (!$med) {
                throw new \Exception("Producto no encontrado: " . $medicamento->name);
            }

            if ($med->cantidad >= $medicamento->cantidad) {
                $med->cantidad -= $medicamento->cantidad;
                $med->save();
            } else {
                throw new \Exception("Stock insuficiente para: " . $medicamento->name);
            }
        }
    }

    public function iniciarTransaccion()
    {
        DB::beginTransaction();
    }
    public function finalizarTransaccion()
    {
        DB::commit();
    }
    public function revertirTransaccion()
    {
        DB::rollBack();
    }
}