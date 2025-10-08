<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Inventario;
use Illuminate\Database\Seeder;

class inventarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Inventario::create([
            'nombre' => 'Paracetamol',
            'minimo' => 20,
            'maximo' => 50,
            'cantidad' => 30,
            'detalles' => '10 gramos, 20 tabletas',
            'precioUnitario' => 7.50,
            'image_path' => 'paracetamol.png'
        ]);

        Inventario::create([
            'nombre' => 'Ibuprofeno',
            'minimo' => 20,
            'maximo' => 50,
            'cantidad' => 30,
            'detalles' => '200 mg, 30 tabletas',
            'precioUnitario' => 5.00,
            'image_path' => 'ibuprofeno.png'
        ]);

        Inventario::create([
            'nombre' => 'Amoxicilina',
            'minimo' => 20,
            'maximo' => 50,
            'cantidad' => 30,
            'detalles' => '500 mg, 20 cápsulas',
            'precioUnitario' => 12.00,
            'image_path' => 'amoxicilina.png'
        ]);
    }
}
