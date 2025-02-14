<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Turno;
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

class SolicitarTurno extends Component
{
    public $cedula;
    public $numeroTurno = null;

    public function generarTurno()
    {
        $ultimoTurno = Turno::orderBy('numero_turno', 'desc')->first();
        $nuevoNumero = $ultimoTurno ? $ultimoTurno->numero_turno + 1 : 1;
    
        // Asegurar que el número de turno no se repita
        while (Turno::where('numero_turno', $nuevoNumero)->exists()) {
            $nuevoNumero++;
        }
    
        $turno = Turno::create([
            'cedula' => $this->cedula,
            'numero_turno' => $nuevoNumero,
            'estado' => 'En Espera',
        ]);
    
        $this->numeroTurno = $nuevoNumero;

        $this->imprimirTurno($turno);

    }
    

    public function imprimirTurno($turno)
    {
        try {
            //  Conectar a la impresora térmica (reemplaza "POS-80" con el nombre real de tu impresora)
            $connector = new WindowsPrintConnector("Microsoft Print to PDF");

            $printer = new Printer($connector);

            // Establecer alineación al centro
            $printer->setJustification(Printer::JUSTIFY_CENTER);

            //  Imprimir encabezado
            $printer->text("\n");
            $printer->text("=== TURNO ===\n");
            $printer->text("-------------------\n");

            //  Número de turno
            $printer->setTextSize(2, 2); // Texto grande
            $printer->text("N°: " . $turno->numero_turno . "\n");

            //  Información adicional
            $printer->setTextSize(1, 1);
            $printer->text("Cédula: " . $turno->cedula . "\n");
            $printer->text(date("Y-m-d H:i:s") . "\n");
            $printer->text("-------------------\n");

            // Alimentar papel y cortar
            $printer->feed(3);
            $printer->cut();
            $printer->close();

        } catch (\Exception $e) {
            session()->flash('error', 'Error al imprimir: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.solicitar-turno')->layout('layouts.app'); // ✅ Corrección aquí
    }
}



