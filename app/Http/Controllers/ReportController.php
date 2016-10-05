<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests;
use App\Log;
use App\User;
use App\Grado;
use App\Asignacione;

class ReportController extends Controller
{
    public function logs()
    {
        Excel::create('logs', function($excel) {
            $excel->sheet('Logs', function($sheet) {
                $logs = Log::all();
                $sheet->fromArray($logs);
            });
        })->export('xls');
    }

    public function docentes()
    {
       Excel::create('usuarios', function($excel) {
            $excel->sheet('usuarios', function($sheet) {
                $usuarios = User::where('role_id','=',2)->get();
                $sheet->fromArray($usuarios);
            });
        })->export('xls');
    }
        
    public function grados()
    {
        Excel::create('grado', function($excel) {
            $excel->sheet('grados', function($sheet) {
                $grados = Grado::all();
                $sheet->fromArray($grados);
            });
        })->export('xls');
    }

    public function asignacion()
    {
        Excel::create('Asignacione', function($excel) {
            $excel->sheet('Asignacione', function($sheet) {
                $asignacion = Asignacione::all();
                $sheet->fromArray($asignacion);
            });
        })->export('xls');
    }


}
