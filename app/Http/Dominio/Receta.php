<?php
namespace App\Http\Dominio;
class Receta{

    private $Medicamentos=[];

    public function agregarMedicamento($request){
        $Medicamento = (object)[
            'id' => $request->id,
            'nombre' => $request->nombre,
            'cantidad' => $request->cantidad,
            'precioUnitario' => $request->precioUnitario,
        ];
        foreach ($this->Medicamentos as $existingMedicamento) {
            if ($existingMedicamento->id === $Medicamento->id) {
                $existingMedicamento->cantidad += 1;
                return;
            }
        }
        $this->Medicamentos[] = $Medicamento;
    }

    public function obtenerMedicamentos()
    {
        return $this->Medicamentos ?? [];
    }
    public function limpiarReceta(){
        $this->Medicamentos = [];
    }
    public function obtenerTotal(){
        $total = 0;
        foreach ($this->Medicamentos as $Medicamento) {
            $total += $Medicamento->precioUnitario * $Medicamento->cantidad;
        }
        return $total;
    }
}