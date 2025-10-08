<?php

namespace App\Http\Controllers;
use App\Http\Dominio\Modelo;
use Illuminate\Http\Request;

class Controlador extends Controller
{
    private $modelo;
    public function __construct(){
        $this->modelo = new Modelo(); 
    }

    public function index(){
        return view("vista",['medicamentos'=>$this->modelo->obtenerInventario(),'receta'=>$this->modelo->obtenerReceta()]);
    }
    public function agregarMedicamento(Request $request){
        $this->modelo->agregarMedicamentoEnReceta($request);
        return redirect()->route('index');
    }
    public function limpiarReceta(){
        $this->modelo->limpiarReceta();
        return redirect()->route('index');
    }
    public function checkout(){
        $msj=$this->modelo->generarPedido();
        return redirect()->route('index')->with('alert_msg', $msj);
    }
}
