<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Ticket;
use App\Cashier;

class PageController extends Controller
{
    public function view_index(){
        try{
            return view('index');
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar la página principal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_error(){
        return view('error');
    }

    public function view_sublogin(){
        try{
    	   return view('sublogin');
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar la página de logeo. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_subregister(){
        try{
            return view('subregister');
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar la página de registro. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function check_login(Request $request){
        try{
            $cashier = \DB::table('cashiers')->where('email', $request->email)->first();
            if($cashier == null){
                $subsidiary = \DB::table('subsidiaries')->where('email', $request->email)->first();
                $result = Hash::check($request->password, $subsidiary->password);
                if($result){
                    $id = Crypt::encrypt($subsidiary->email);
                    $ticket = new Ticket;
                    $ticket->ticket = $id;
                    $ticket->save();
                    return redirect()->route('subdashboard', ['id' => $id]);
                }
                else{
                    return redirect("/");
                }
            }
            else{
                $result = Hash::check($request->password, $cashier->password);
                if($result){
                    $id = Crypt::encrypt($cashier->email);
                    $ticket = new Ticket;
                    $ticket->ticket = $id;
                    $ticket->save();
                    return redirect()->route('subcashierq', ['id' => $id]);
                }
                else{
                    return redirect("/");
                }
            }
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al logearse. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_subdashboard($id){
        try{
    		$ticket = \DB::table('tickets')->where('ticket', $id)->first();
    		if($ticket == null){
    			return redirect("/");
    		}
    		else{
    			$newid = Crypt::decrypt($id);
	            $subsidiary = \DB::table('subsidiaries')->where('email', $newid)->first();
                $atendidos = \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->sum('atendidos');
                $mayor = \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->max('atendidos');
                $maxcashier = \DB::table('cashiers')->where('atendidos', $mayor)->where('id_subsidiary', $subsidiary->id)->first();
                if($maxcashier != null){
                    $maxcashier = $maxcashier->nombre . " " . $maxcashier->apellido;
                }
                else{
                    $maxcashier = "No hay cajeros";
                }
                $promedio = \DB::table('times')->where('id_queue', $subsidiary->id)->avg('tiempo');
                $promedio = round($promedio);
                $cashiers = \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->orderBy('atendidos', 'DESC')->paginate(10);
    			return view('subdashboard.subdashboard', ['id' => $id], compact('subsidiary', 'id', 'atendidos', 'mayor', 'maxcashier', 'promedio', 'cashiers'));
    		}
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_subdashboardc($id){
        try{
    		$ticket = \DB::table('tickets')->where('ticket', $id)->first();
    		if($ticket == null){
    			return redirect("/");
    		}
    		else{
    			$newid = Crypt::decrypt($id);
	            $subsidiary = \DB::table('subsidiaries')->where('email', $newid)->first();
	            $cashiers = \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->paginate(10);
	            return view('subdashboard.subdashboardc', ['id' => $id], compact('cashiers', 'subsidiary', 'id'));
    		}
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_subdashboardrc($id){
        try{
    		$ticket = \DB::table('tickets')->where('ticket', $id)->first();
    		if($ticket == null){
    			return redirect("/");
    		}
    		else{
	            return view('subdashboard.subdashboardrc', ['id' => $id]);
    		}
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }   
    }

    public function view_subdashboarduc($id, $uid){
        try{
    		$ticket = \DB::table('tickets')->where('ticket', $id)->first();
    		if($ticket == null){
    			return redirect("/");
    		}
    		else{
    			$newid = Crypt::decrypt($uid);
	            $cashier = Cashier::find($newid);
	            return view('subdashboard.subdashboarduc', ['id' => $id], compact('cashier'));
    		}
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_subdashboarddc($id, $uid){
        try{
            $ticket = \DB::table('tickets')->where('ticket', $id)->first();
    		if($ticket == null){
    			return redirect("/");
    		}
    		else{
    			$newid = Crypt::decrypt($uid);
	            $cashier = Cashier::find($newid);
	            return view('subdashboard.subdashboarddc', ['id' => $id], compact('cashier'));
    		}
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_subdashboardq($id){
        try{
    		$ticket = \DB::table('tickets')->where('ticket', $id)->first();
    		if($ticket == null){
    			return redirect("/");
    		}
    		else{
                $newid = Crypt::decrypt($id);
                $subsidiary = \DB::table('subsidiaries')->where('email', $newid)->first();
                $cashier = \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->first();
                $queue = \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->first();
                $people = $queue->ultimo - $queue->actual;
                $disponibles = \DB::table('customers')->where('id_queue', $queue->id)
                ->where('status', "Disponible")->count();
                return view('subdashboard.subdashboardq', ['id' => $id], compact('subsidiary', 'people', 'disponibles'));
    		}
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard de sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function view_subcashierq($id){
        try{
            $ticket = \DB::table('tickets')->where('ticket', $id)->first();
    		if($ticket == null){
    			return redirect("/");
    		}
            else{
                $newid = Crypt::decrypt($id);
                $cashier = \DB::table('cashiers')->where('email', $newid)->first();
                $subsidiary = \DB::table('subsidiaries')->where('id', $cashier->id_subsidiary)->first();
                $queue = \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->first();
                $people = $queue->ultimo - $queue->actual;
                $disponibles = \DB::table('customers')->where('id_queue', $queue->id)
                ->where('status', "Disponible")->count();
                return view('subcashier.subcashierq', ['id' => $id], compact('people', 'subsidiary', 'cashier', 'disponibles'));
            }
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al mostrar el dashboard del cajero. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

}
