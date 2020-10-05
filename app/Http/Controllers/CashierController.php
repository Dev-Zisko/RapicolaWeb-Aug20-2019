<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Auth;
use App\Subsidiary;
use App\User;
use App\Customer;
use App\Cashier;
use App\Queue;
use App\Http\Requests\CashierRequest;

class CashierController extends Controller
{
    public function r_cashier(CashierRequest $request, $id){
    	try{
    	 	$newid = Crypt::decrypt($id);
	        $cashier = new Cashier;
	        $cashier->cedula = $request->cedula;
			$cashier->nombre = $request->nombre;
			$cashier->apellido = $request->apellido;
			$cashier->telefono = $request->telefono;
			$cashier->direccion = $request->direccion;
			$cashier->email = $request->email;
			$cashier->password = Hash::make($request->password);
			$cashier->id_business = Auth::user()->id;
			$cashier->id_subsidiary = $newid;
			$cashier->save();
	        return redirect()->route('dashboardc', ['id' => $id]);
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado registrando al cajero. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function sr_cashier(CashierRequest $request, $id){
        try{
            $ticket = \DB::table('tickets')->where('ticket', $id)->first();
            if($ticket == null){
                return redirect("/");
            }
            else{
                $newid = Crypt::decrypt($id);
                $subsidiary = \DB::table('subsidiaries')->where('email', $newid)->first();
                $cashier = new Cashier;
                $cashier->cedula = $request->cedula;
                $cashier->nombre = $request->nombre;
                $cashier->apellido = $request->apellido;
                $cashier->telefono = $request->telefono;
                $cashier->direccion = $request->direccion;
                $cashier->email = $request->email;
                $cashier->password = Hash::make($request->password);
                $cashier->id_business = $subsidiary->id_business;
                $cashier->id_subsidiary = $subsidiary->id;
                $cashier->save();
                return redirect()->route('subdashboardc', ['id' => $id]);
            }
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado registrando al cajero. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function u_cashier(CashierRequest $request, $id){
		try{
            $newid = Crypt::decrypt($id);
            \DB::table('cashiers')->where('id', $newid)->update(['cedula'=>$request->cedula]);
            \DB::table('cashiers')->where('id', $newid)->update(['nombre'=>$request->nombre]);
            \DB::table('cashiers')->where('id', $newid)->update(['apellido'=>$request->apellido]);
            \DB::table('cashiers')->where('id', $newid)->update(['telefono'=>$request->telefono]);
            \DB::table('cashiers')->where('id', $newid)->update(['direccion'=>$request->direccion]);
            \DB::table('cashiers')->where('id', $newid)->update(['email'=>$request->email]);
            $encrypass = Hash::make($request->password);
            \DB::table('cashiers')->where('id', $newid)->update(['password'=>$encrypass]);
            $cashier = Cashier::find($newid);
            $idsubsidiary = Crypt::encrypt($cashier->id_subsidiary);
            return redirect()->route('dashboardc', ['id' => $idsubsidiary]);
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado actualizando al cajero. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function su_cashier(CashierRequest $request, $id, $uid){
        try{
            $ticket = \DB::table('tickets')->where('ticket', $id)->first();
            if($ticket == null){
                return redirect("/");
            }
            else{
                $newuid = Crypt::decrypt($uid);
                \DB::table('cashiers')->where('id', $newuid)->update(['cedula'=>$request->cedula]);
                \DB::table('cashiers')->where('id', $newuid)->update(['nombre'=>$request->nombre]);
                \DB::table('cashiers')->where('id', $newuid)->update(['apellido'=>$request->apellido]);
                \DB::table('cashiers')->where('id', $newuid)->update(['telefono'=>$request->telefono]);
                \DB::table('cashiers')->where('id', $newuid)->update(['direccion'=>$request->direccion]);
                \DB::table('cashiers')->where('id', $newuid)->update(['email'=>$request->email]);
                $encrypass = Hash::make($request->password);
                \DB::table('cashiers')->where('id', $newuid)->update(['password'=>$encrypass]);
                return redirect()->route('subdashboardc', ['id' => $id]);
            }
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado actualizando al cajero. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function d_cashier($id){
    	try{
            $newid = Crypt::decrypt($id);
            $cashier = Cashier::find($newid);
            $idsubsidiary = Crypt::encrypt($cashier->id_subsidiary);
            \DB::table('cashiers')->where('id', $newid)->delete();
            return redirect()->route('dashboardc', ['id' => $idsubsidiary]);
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado eliminando al cajero. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function sd_cashier($id, $uid){
        try{
            $ticket = \DB::table('tickets')->where('ticket', $id)->first();
            if($ticket == null){
                return redirect("/");
            }
            else{
                $newuid = Crypt::decrypt($uid);
                $cashier = Cashier::find($newuid);
                \DB::table('cashiers')->where('id', $newuid)->delete();
                return redirect()->route('subdashboardc', ['id' => $id]);
            }
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado eliminando al cajero. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function next_queue($id)
    {
        try{
            $newid = Crypt::decrypt($id); //Desencriptamos el id del cajero
            $cashier = \DB::table('cashiers')->where('email', $newid)->first();
            $queue = Queue::find($cashier->id_subsidiary); //Busca la cola de la subcursal
            $puestonext = $queue->actual + 1; //Le suma uno para pasar al siguiente en cola
            if($puestonext <= $queue->ultimo){ //Si el que sigue es menor o igual al ultimo en cola
                if($puestonext == 1000){ //Si el puesto pasa de 1000 se coloca en 1 para empezar
                    $puestonext = 1; //Se pone en 1 el puesto
                } //Fin condicion
                $validate = true;
                while($validate){
                    $customer = \DB::table('customers') //En la tabla de usuarios
                    ->where('id_queue', $queue->id) //busca el usuario que pertenezca a esa cola
                    ->Where('puesto', $puestonext)->first(); //y tenga el puesto que le toca ser atendido
                    if($customer == null){
                        $puestonext = $puestonext + 1; //Le suma uno para pasar al siguiente en cola
                    }
                    else if($customer != null){
                        if($customer->status == "Ocupado"){
                            if($puestonext == $queue->ultimo){
                                $validate = false;
                            }
                            else{
                                $puestonext = $puestonext + 1; //Le suma uno para pasar al siguiente en cola
                            }                        
                        }
                        else{
                            $valcash = \DB::table('cashiers') //En la tabla usuarios
                            ->where('puesto', $puestonext)->get();
                            if(count($valcash) != 0){
                                $validate = false;
                            }else{
                                \DB::table('cashiers') //En la tabla usuarios
                                ->where('email', $newid) //se busca el usuario
                                ->update(['puesto'=>$puestonext]); //se le asigna el puesto en nulo
                                $validate = false;
                            }
                        }
                    }
                }
                return redirect()->route('subcashierq', ['id' => $id]);
            }
            else{
                return redirect()->route('subcashierq', ['id' => $id]); // Aqui redireccionar a no gente en cola
            }
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al buscar al siguiente en la cola. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function now_queue($id)
    {
        try{
            $newid = Crypt::decrypt($id); //Desencriptamos el id del cajero
            $cashier = \DB::table('cashiers')->where('email', $newid)->first();
            $queue = Queue::find($cashier->id_subsidiary); //Busca la cola de la subcursal
            $customer = \DB::table('customers') //En la tabla de usuarios
            ->where('id_queue', $queue->id) //busca el usuario que pertenezca a esa cola
            ->Where('puesto', $cashier->puesto)->first(); //y tenga el puesto que le toca ser atendido
            $atendidos = $cashier->atendidos + 1;
            \DB::table('customers') //En la tabla usuarios
            ->where('id', $customer->id) //se busca el usuario
            ->update(['status'=>null]); //se le asigna el status en nulo
            \DB::table('customers') //En la tabla usuarios
            ->where('id', $customer->id) //se busca el usuario
            ->update(['puesto'=>null]); //se le asigna el puesto en nulo
            \DB::table('customers') //En la tabla usuarios
            ->where('id', $customer->id) //se busca al usuario
            ->update(['id_queue'=>null]); //se le asigna la cola en nulo
            \DB::table('cashiers') //En la tabla usuarios
            ->where('id', $cashier->id) //se busca al usuario
            ->update(['puesto'=>null]); //se le asigna la cola en nulo
            \DB::table('cashiers') //En la tabla usuarios
            ->where('id', $cashier->id) //se busca al usuario
            ->update(['atendidos'=>$atendidos]); //se le asigna la cola en nulo
            $puestomenor = \DB::table('customers')->where('id_queue', $queue->id) //En la tabla usuarios
            ->min('puesto');
            if($puestomenor-1 > $queue->actual){
                \DB::table('queues') //En la tabla de colas
                ->where('id', $queue->id) //se busca la cola
                ->update(['actual'=>$puestomenor-1]); //Y se cambia el valor del ultimo
            }
            else if($puestomenor == null){
                \DB::table('queues') //En la tabla de colas
                ->where('id', $queue->id) //se busca la cola
                ->update(['actual'=>$queue->ultimo]); //Y se cambia el valor del ultimo
            }
            return redirect()->route('subcashierq', ['id' => $id]);
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al intentar atender al usuario actual. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function realtime($id){
        $customers = \DB::table('customers')->where('id_queue', $id)->get();
		$people = count($customers);
        $disponibles = \DB::table('customers')->where('id_queue', $id)
        ->where('status', "Disponible")->count();
        return response()->json(['people' => $people, 'disponibles' => $disponibles]);
    }
}