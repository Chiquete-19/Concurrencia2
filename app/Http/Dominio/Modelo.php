<?php

namespace App\Http\Dominio;
use App\Servicios\Bd;

class Modelo
{
    private $bd, $inventario, $receta;
    
    public function __construct()
    {
        $this->bd = new Bd();
        $this->inventario = new InventarioDominio($this->bd->obtenerMedicamentos());
        if (session()->has('receta')) {
            $this->receta = session('receta');
        } else {
            $this->receta = new Receta();
            session(['receta' => $this->receta]);
        }
    }

    public function obtenerInventario(){
        return $this->inventario->obtenerInventario();
    }

    public function agregarMedicamentoEnReceta($request){
        $this->receta->agregarMedicamento($request);
        session(['receta' => $this->receta]);
    }
    public function limpiarReceta(){
        $this->receta->limpiarReceta();
        session(['receta' => $this->receta]);
    }

    public function generarPedido(){
        try{
            $this->bd->iniciarTransaccion();
            $this->inventario->actualizarInventario($this->bd->obtenerMedicamentosConUpdate());
            if($this->inventario->validarStrock($this->receta)){
                $this->bd->checkout($this->receta);
                $this->bd->finalizarTransaccion();
                $this->receta->limpiarReceta();
                session(['receta' => $this->receta]);
            }
        }catch(\Throwable $e){
            $this->bd->revertirTransaccion();
            return ($e->getMessage());
        }
    }

}