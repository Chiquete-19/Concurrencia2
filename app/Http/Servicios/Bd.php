<?php
namespace App\Http\Servicios;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class Bd
{
    public function obtenerProductos()
    {
        return Product::all();
    }

    public function checkOut($cartItems)
    {
        DB::transaction(function () use ($cartItems) {
            foreach ($cartItems as $item) {
                $med = Product::where('id', $item->id)
                    ->lockForUpdate()
                    ->first();

                if (!$med) {
                    throw new \Exception("Producto no encontrado: " . $item->name);
                }

                if ($med->cantidad >= $item->cantidad) {
                    $med->cantidad -= $item->cantidad;
                    $med->save();
                } else {
                    throw new \Exception("Stock insuficiente para: " . $item->name);
                }
            }
        });
        
    }
}