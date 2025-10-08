<?php
namespace App\Http\Dominio;


class InventarioDominio{

    private $inventario=[];

    public function __construct($datos){
        $this->actualizarInventario($datos);
    }

    public function actualizarInventario($datos){
        $inventario=[];
        foreach ($datos as $medicamento) {
            $med=(object)[
                'id'=>$medicamento->id,
                'nombre'=>$medicamento->nombre,
                'cantidad'=>$medicamento->cantidad,
                'precioUnitario'=>$medicamento->precioUnitario,
                'minimo'=>$medicamento->minimo,
                'maximo'=>$medicamento->maximo,
                'detalles'=>$medicamento->detalles,
                'image_path'=>$medicamento->image_path
            ];
            $this->inventario[]=$med;
        }
    }

    public function validarStock($receta){
        foreach ($receta->obtenerMedicamentos() as $medicamento) {
            foreach ($this->inventario as $item) {
                if($item->id == $medicamento->id){
                    if($item->cantidad < $medicamento->cantidad){
                        throw new \Exception("Stock insuficiente para: " . $medicamento->name);
                    }
                }
            }
        }
        return true;
    }
    
    public function obtenerInventario(){
        return $this->inventario;
    }

}