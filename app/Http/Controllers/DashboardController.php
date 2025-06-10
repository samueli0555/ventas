<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\User;
use App\Models\DetalleVenta;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller

{
    public function dashboard()
{
    // Cantidad total de productos vendidos (suma de cantidades en DetalleVenta)
    $productosVendidos = DetalleVenta::sum('cantidad');

    // Cantidad total de clientes
    $clientes = User::count();

    // Ventas por mes (últimos 12 meses)
    $ventasPorMes = Venta::selectRaw('MONTH(fecha_registro) as mes, COUNT(*) as total')
        ->groupBy('mes')
        ->orderBy('mes')
        ->pluck('total', 'mes')
        ->toArray();

    $meses = ['1' => 'Ene', '2' => 'Feb', '3' => 'Mar', '4' => 'Abr', '5' => 'May', '6' => 'Jun', '7' => 'Jul', '8' => 'Ago', '9' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dic'];
    $labelsMes = [];
    $dataMes = [];
    foreach (range(1, 12) as $i) {
        $labelsMes[] = $meses[$i];
        $dataMes[] = isset($ventasPorMes[$i]) ? $ventasPorMes[$i] : 0;
    }

    // Ventas por día de la semana (1 = lunes, ..., 7 = domingo)
    $ventasPorDiaSemana = Venta::selectRaw('DAYOFWEEK(fecha_registro) as dia_semana, COUNT(*) as total')
        ->groupBy('dia_semana')
        ->orderBy('dia_semana')
        ->pluck('total', 'dia_semana')
        ->toArray();

    // Mapear DAYOFWEEK MySQL a nombres en español, recordando que:
    // DAYOFWEEK devuelve 1=Domingo, 2=Lunes, ..., 7=Sábado
    $diasSemana = [
        2 => 'Lun',
        3 => 'Mar',
        4 => 'Mié',
        5 => 'Jue',
        6 => 'Vie',
        7 => 'Sáb',
        1 => 'Dom',
    ];

    $labelsDiaSemana = [];
    $dataDiaSemana = [];
    // Queremos que empiece desde lunes (2) hasta domingo (1)
    foreach ([2,3,4,5,6,7,1] as $dia) {
        $labelsDiaSemana[] = $diasSemana[$dia];
        $dataDiaSemana[] = isset($ventasPorDiaSemana[$dia]) ? $ventasPorDiaSemana[$dia] : 0;
    }

    return Inertia::render('Dashboard', [
        'productosVendidos' => $productosVendidos,
        'clientes' => $clientes,
        'ventasPorMesLabels' => $labelsMes,
        'ventasPorMesData' => $dataMes,
        'ventasPorDiaLabels' => $labelsDiaSemana,  // Cambiado aquí
        'ventasPorDiaData' => $dataDiaSemana,      // Cambiado aquí
    ]);
}


}