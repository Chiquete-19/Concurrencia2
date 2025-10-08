<?php

namespace App\Http\Dominio;
use App\Http\Servicios\Bd;
use App\Http\Dominio\Receta;
use App\Http\Dominio\InventarioDominio;

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
    public function obtenerReceta(){
        return $this->receta->obtenerMedicamentos();
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
            if($this->inventario->validarStock($this->receta)){
                $this->bd->checkout($this->receta->obtenerMedicamentos());
                $this->bd->finalizarTransaccion();
                $this->receta->limpiarReceta();
                session(['receta' => $this->receta]);
            }
            return("Pedido realizado con exito");
        }catch(\Throwable $e){
            $this->bd->revertirTransaccion();
            return ($e->getMessage());
        }
    }

}