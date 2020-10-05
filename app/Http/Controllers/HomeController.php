<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Exception;
use Auth;
use App\User;
use App\Subsidiary;
use App\Cashier;
use App\Queue;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function view_dashboard(){
        try{
            $id_business = Auth::user()->id;
            $atendidos = \DB::table('cashiers')->where('id_business', $id_business)->sum('atendidos');
            $cashiers = \DB::table('cashiers')->where('id_business', $id_business)->orderBy('atendidos', 'DESC')->paginate(10);
            $subsidiaries = \DB::table('subsidiaries')->where('id_business', $id_business)->paginate(10);
            $cashiers1 = \DB::table('cashiers')->where('id_business', $id_business)->get();
            $subsidiaries1 = \DB::table('subsidiaries')->where('id_business', $id_business)->get();
            $arraycashiers = $cashiers1->toArray();
            $arraysubsidiaries = $subsidiaries1->toArray();
            $arrayatendidos = array();
            foreach ($arraysubsidiaries as $subsidiary) {
                $suma = 0;
                foreach ($arraycashiers as $cashier) {
                    if($subsidiary->id == $cashier->id_subsidiary){
                        $suma = $suma + $cashier->atendidos;
                    }
                }
                array_push($arrayatendidos, $suma);
            }
            $mayor = 0;
            $position = 0;
            $i = 0;
            $sucursal = "No hay Sucursales";
            foreach ($arrayatendidos as $atendido) {
                if($atendido > $mayor){
                    $mayor = $atendido;
                    $position = $i + 1;
                }
                $i++;
            }
            $j = 0;
            $id = 0;
            foreach ($arraysubsidiaries as $subsidiary) {
                if($j == $position){
                    $sucursal = $subsidiary->nombre;
                    $id = $subsidiary->id;
                }
                $j++;
            }
            $queues1 = \DB::table('queues')->get();
            $arrayqueues = $queues1->toArray();
            $times1 = \DB::table('times')->get();
            $arraytimes = $times1->toArray();
            $tiempo = 0;
            $contador = 0;
            $promedio = 0;
            foreach ($arraysubsidiaries as $subsidiary) {
                foreach ($arrayqueues as $queue) {
                    foreach ($arraytimes as $time) {
                        if($subsidiary->id == $queue->id_subsidiary 
                            && $queue->id == $time->id_queue){
                            $tiempo = $tiempo + $time->tiempo;
                            $contador++;
                        }
                    }
                }
            }
            if(count($arraysubsidiaries) != 0 && count($arrayqueues) != 0 && count($arraytimes) != 0 && $contador != 0){
                $promedio = $tiempo/$contador;
            }
            $promedio = round($promedio);
            $arrayprom = array();
            $prom = 0;
            foreach ($arraysubsidiaries as $subsidiary) {
                $tiempo1 = 0;
                $cont = 0;
                foreach ($arrayqueues as $queue) {
                    foreach ($arraytimes as $time) {
                        if($subsidiary->id == $queue->id_subsidiary && $queue->id == $time->id_queue){
                            $tiempo1 = $tiempo1 + $time->tiempo;
                            $cont++;
                        }
                    }
                }
                if(count($arraysubsidiaries) != 0 && count($arrayqueues) != 0 && count($arraytimes) != 0 && $cont != 0){
                    $prom = $tiempo1/$cont;
                }
                $promtime = round($prom);
                array_push($arrayprom, $promtime);
            }
            return view('dashboard.dashboard', compact('id', 'atendidos', 'cashiers', 'subsidiaries', 'arrayatendidos', 'position', 'mayor', 'promedio', 'sucursal', 'arrayprom'));
        }catch(Exception $ex){
            dd($ex);
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_dashboards(){
        try{
            $id_business = Auth::user()->id;
            $subsidiaries = \DB::table('subsidiaries')->where('id_business', $id_business)->paginate(10);
            return view('dashboard.dashboards', compact('subsidiaries'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_dashboardrs(){
        try{
            return view('dashboard.dashboardrs');
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_dashboardus($id){
        try{
            $newid = Crypt::decrypt($id);
            $subsidiary = Subsidiary::find($newid);
            return view('dashboard.dashboardus', compact('subsidiary'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_dashboardds($id){
        try{
            $newid = Crypt::decrypt($id);
            $subsidiary = Subsidiary::find($newid);
            return view('dashboard.dashboardds', compact('subsidiary'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_dashboardlc(){
        try{
            $id_business = Auth::user()->id;
            $subsidiaries = \DB::table('subsidiaries')->where('id_business', $id_business)->paginate(10);
            return view('dashboard.dashboardlc', compact('subsidiaries'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_dashboardc($id){
        try{
            $newid = Crypt::decrypt($id);
            $subsidiary = Subsidiary::find($newid);
            $cashiers = \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->paginate(10);
            return view('dashboard.dashboardc', compact('cashiers'), compact('subsidiary'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_dashboardrc($id){
        try{
            $newid = Crypt::decrypt($id);
            $subsidiary = Subsidiary::find($newid);
            return view('dashboard.dashboardrc', compact('subsidiary'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_dashboarduc($id){
        try{
            $newid = Crypt::decrypt($id);
            $cashier = Cashier::find($newid);
            return view('dashboard.dashboarduc', compact('cashier'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_dashboarddc($id){
        try{
            $newid = Crypt::decrypt($id);
            $cashier = Cashier::find($newid);
            return view('dashboard.dashboarddc', compact('cashier'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_dashboardlq(){
        try{
            $id_business = Auth::user()->id;
            $subsidiaries = \DB::table('subsidiaries')->where('id_business', $id_business)->paginate(10);
            return view('dashboard.dashboardlq', compact('subsidiaries'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_dashboardq($id){
        try{
            $newid = Crypt::decrypt($id);
            $subsidiary = Subsidiary::find($newid);
            $cashier = \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->first();
            $queue = \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->first();
            $people = $queue->ultimo - $queue->actual;
            $disponibles = \DB::table('customers')->where('id_queue', $queue->id)
                ->where('status', "Disponible")->count();
            return view('dashboard.dashboardq', compact('queue', 'subsidiary', 'people','disponibles'));
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de empresa. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }
}
