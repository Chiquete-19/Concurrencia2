<?php




class InventarioDominio{

    private $inventario=[];

    public function __construct($datos){
        $this->actualizarInventario($datos);
    }

    public function actualizarInventario($datos){
        $inventario=[];
        foreach ($medicamentos as $medicamento) {
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
    
    public function obtenerInventario(){
        return $this->inventario;
    }

}