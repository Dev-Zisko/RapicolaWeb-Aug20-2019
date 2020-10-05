<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Exception;
use App\Ticket;
use App\Customer;
use App\User;
use App\Subsidiary;
use App\Queue;
use App\Time;
use App\Http\Requests\CustomerRequest;

class CustomerController extends Controller
{
    public function r_customer(CustomerRequest $request){
    	try{
    		$user = \DB::table('customers')->where('email', $request->email)->orWhere('cedula', $request->cedula)->orWhere('telefono', $request->telefono)->first();
	    	if($user == null){
	    		$customer = new Customer;
		    	$customer->cedula = $request->cedula;
		    	$customer->nombre = $request->nombre;
		    	$customer->apellido = $request->apellido;
		    	$customer->telefono = $request->telefono;
		    	$customer->email = $request->email;
		    	$customer->direccion = $request->direccion;
		    	$customer->status = null;
		    	$customer->puesto = null;
		    	$customer->id_queue = null;
		    	$customer->password = Hash::make($request->password);
		    	$customer->save();
		    	return response()->json(['respuesta' => 'true']);
	    	}
	    	else{
	    		return response()->json(['respuesta' => 'false']);
	    	}
    	}catch(Exception $ex){
            return response()->json(['respuesta' => 'false']);
    	}
    }

    public function sr_customer(CustomerRequest $request){
    	try{
            $customer = new Customer;
            $customer->cedula = $request->cedula;
            $customer->nombre = $request->nombre;
            $customer->apellido = $request->apellido;
            $customer->telefono = $request->telefono;
            $customer->email = $request->email;
            $customer->direccion = $request->direccion;
            $customer->status = null;
            $customer->puesto = null;
            $customer->id_queue = null;
            $customer->password = Hash::make($request->password);
            $customer->save();
            return redirect('index');
        }catch(Exception $ex){
    		$mensaje = "Ocurrió un error inesperado registrando al usuario. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
    	}
    }

    public function check_login(Request $request){
    	try{
    		$customer = \DB::table('customers')->where('email', $request->email)->first();
	    	if($customer == null){
	    		return response()->json(['respuesta' => 'false']);
	    	}
	    	else{
	    		$result = Hash::check($request->password, $customer->password);
	    		if($result){
	                $id = Crypt::encrypt($customer->email);
	    			$ticket = new Ticket;
	    			$ticket->ticket = $id;
	    			$ticket->save();
	    			return response()->json(['respuesta' => 'true', 'ticket' => $id]);
	    		}
	    		else{
	    			return response()->json(['respuesta' => 'false']);
	    		}
	    	}
    	}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
    }

    public function get_data(Request $request){
    	try{
			$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$business = User::all();
				$subsidiaries = Subsidiary::all();
				$queues = Queue::all();
				$customers = Customer::all();
				$arraybusiness = $business->toArray();
				$arraysubsidiaries = $subsidiaries->toArray();
				$arrayqueues = $queues->toArray();
				foreach ($arrayqueues as $queue) {
					$i = 0;
					foreach ($arraysubsidiaries as $subsidiary) {
						if($queue['id_subsidiary'] == $subsidiary['id']){
							$customers = \DB::table('customers')->where('id_queue', $queue['id_subsidiary'])->get();
							$totalqueue = count($customers);
							array_push($arraysubsidiaries[$i], $totalqueue);
						}
						$i++;
					}
				}
				foreach ($arraysubsidiaries as $subsidiary) {
					$i = 0;
					$tiempo = \DB::table('times')->where('id_queue', $subsidiary['id'])->avg('tiempo'); 
					$tiempo = (int) $tiempo;
					array_push($arraysubsidiaries[$i], $tiempo);
					$i++;
				}
				$customer = \DB::table('customers')->where('email', $request->email)->first();
				foreach ($arraysubsidiaries as $subsidiary) {
					$i = 0;
					$tiempocustomer = \DB::table('times')->where('id_queue', $subsidiary['id'])
					->where('id_customer', $customer->id)->avg('tiempo');
					$tiempocustomer = (int) $tiempocustomer;
					array_push($arraysubsidiaries[$i], $tiempocustomer);
					$i++;
				}
				return response()->json(['business' => $arraybusiness, 'subsidiaries' => $arraysubsidiaries, 'queues' => $arrayqueues]);
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
    }

    public function search_profile(Request $request){
    	try{
			$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$customer = \DB::table('customers')->where('email', $request->email)->first();
				return response()->json(['customer' => $customer]);
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
	}

	public function edit_profile(Request $request){
		try{
			$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				\DB::table('customers')->where('email', $request->email)->update(['nombre'=>$request->nombre]);
				\DB::table('customers')->where('email', $request->email)->update(['apellido'=>$request->apellido]);
				\DB::table('customers')->where('email', $request->email)->update(['direccion'=>$request->direccion]);
				\DB::table('customers')->where('email', $request->email)->update(['password'=>Hash::make($request->password)]);
				return response()->json(['respuesta' => 'true']);
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
	}
	
	public function logout(Request $request){
		try{
	    	$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				\DB::table('tickets')->where('ticket', $request->ticket)->delete();
				return response()->json(['respuesta' => 'true']);
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
	}
	
	public function enterqueue(Request $request){
		try{
			$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$queue = \DB::table('queues')->where('id_subsidiary', $request->id)->first();
				$customer = \DB::table('customers')->where('email', $request->email)->first();
				$tiempo = \DB::table('times')->where('id_queue', $request->id)->avg('tiempo');
				$tiempocustomer = \DB::table('times')->where('id_queue', $request->id)
				->where('id_customer', $customer->id)->avg('tiempo');
				$tiempo = (int) $tiempo;
				$tiempocustomer = (int) $tiempocustomer;
				if($customer->id_queue == null){
					$numero = $queue->ultimo + 1;
					\DB::table('queues')->where('id', $queue->id)->update(['ultimo'=>$numero]);
					\DB::table('customers')->where('email', $request->email)->update(['puesto'=>$numero]);
					\DB::table('customers')->where('email', $request->email)->update(['status'=>'Ocupado']);
					\DB::table('customers')->where('email', $request->email)->update(['id_queue'=>$queue->id]);
					return response()->json(['respuesta' => 'true', 'puesto' => $numero, 'status' => 'Ocupado', 'tiempo' => $tiempo, 
					'cliente' => $tiempocustomer]);
				}
				else{
					return response()->json(['respuesta' => 'repeat', 'mensaje' => 'Usted ya esta se encuentra en una cola.']);
				}
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
	}

	public function changestatus(Request $request){
		try{
			$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$queue = \DB::table('queues')->where('id_subsidiary', $request->id)->first();
				$customer = \DB::table('customers')->where('email', $request->email)->first();
				if($customer->id_queue == null){
					return response()->json(['respuesta' => 'false']);
				}
				else if($customer->id_queue == $queue->id){
					if($customer->status == 'Ocupado'){
						\DB::table('customers')->where('email', $request->email)->update(['status'=>'Disponible']);
						return response()->json(['respuesta' => 'true', 'status' => 'Disponible']);
					}
					else if($customer->status == 'Disponible'){
						if($request->flag == 0){
							\DB::table('customers')->where('email', $request->email)->update(['status'=>'Ocupado']);
							return response()->json(['respuesta' => 'true', 'status' => 'Ocupado']);
						}
						else{
							\DB::table('customers')->where('email', $request->email)->update(['status'=>'Ocupado']);
							\DB::table('cashiers')->where('id_subsidiary', $customer->id_queue)
							->where('puesto', $customer->puesto)->update(['puesto'=>null]);
							return response()->json(['respuesta' => 'true', 'status' => 'Ocupado']);
						}
					}
				}
				else{
					return response()->json(['respuesta' => 'false']);
				}
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}	
	}

	public function exitqueue(Request $request){
		try{
			$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$queue = \DB::table('queues')->where('id_subsidiary', $request->id)->first();
				$customer = \DB::table('customers')->where('email', $request->email)->first();
				if($queue->ultimo == $customer->puesto){
					\DB::table('queues')->where('id', $queue->id)->update(['ultimo'=>$queue->ultimo-1]);
				}
				\DB::table('customers')->where('email', $request->email)->update(['puesto'=>null]);
				\DB::table('customers')->where('email', $request->email)->update(['status'=>null]);
				\DB::table('customers')->where('email', $request->email)->update(['id_queue'=>null]);
				return response()->json(['respuesta' => 'true']);
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
	}

	public function get_position(Request $request){
		try{
			$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$customer = \DB::table('customers')->where('email', $request->email)->first();
				if($customer->id_queue == $request->id){
					$cashier = \DB::table('cashiers')->where('id_subsidiary', $request->id)->where('puesto', '=', $request->puesto)->first();
					$customers = \DB::table('customers')->where('id_queue', $request->id)->where('status', 'Disponible')
					->where('puesto', '<' , $customer->puesto)->get();
					$cashiers = \DB::table('cashiers')->where('id_subsidiary', $request->id)->get();
					$arraycash = array();
					$arraycashiers = $cashiers->toArray();
					foreach ($arraycashiers as $cashier1) {
						if($cashier1->puesto != null){
							array_push($arraycash, $cashier1->puesto);
						}	
					}
					$people = count($customers);
					if($cashier != null){
						return response()->json(['respuesta' => 'true', 'mensaje' => 'Es tu turno. Pasa por la caja que veas vacía.', 'clientes' => $people, 'puestos' => $arraycash]);
					}
					else{
						return response()->json(['respuesta' => 'not', 'clientes' => $people, 'puestos' => $arraycash]);
					}
				}
				else{
					return response()->json(['respuesta' => 'not_queue']);
				}
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
	}

	public function get_queue(Request $request){
		try{
			$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$customer = \DB::table('customers')->where('email', $request->email)->first();
				$tiempo = \DB::table('times')->where('id_queue', $request->id)->avg('tiempo');
				$tiempocustomer = \DB::table('times')->where('id_queue', $request->id)
				->where('id_customer', $customer->id)->avg('tiempo');
				$tiempo = (int) $tiempo;
				$tiempocustomer = (int) $tiempocustomer; 
				if($customer->id_queue == $request->id){
					return response()->json(['respuesta' => 'true', 'puesto' => $customer->puesto, 'status' => $customer->status, 'tiempo' => $tiempo,
					'cliente' => $tiempocustomer]);	
				}
				else{
					return response()->json(['respuesta' => 'not', 'cliente' => $tiempocustomer]);
				}	
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
	}

	public function check_ticket(Request $request){
		try{
	    	$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				return response()->json(['respuesta' => 'true']);	
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
    }

    public function check_storage(Request $request){
    	try{
	    	$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$email = \DB::table('customers')->where('email', $request->email)->first();
				if($email == null){
					return response()->json(['respuesta' => 'false']);
				}
				else{
					return response()->json(['respuesta' => 'true']);
				}	
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
    }


    public function save_times(Request $request){
    	try{
	    	$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$time = new Time;
		    	$time->tiempo = $request->tiempo;
				$time->id_queue = $request->id;
				$customer = \DB::table('customers')->where('email', $request->email)->first();
				$time->id_customer = $customer->id;
		    	$time->save();
		    	return response()->json(['respuesta' => 'true']);	
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
    }

    public function geolocation(Request $request){
    	try{
	    	$ticket = \DB::table('tickets')->where('ticket', $request->ticket)->first();
			if($ticket == null){
				return response()->json(['respuesta' => 'false']);
			}
			else{
				$subsidiary = \DB::table('subsidiaries')->where('id', $request->id)->first();
				return response()->json(['respuesta' => 'true', 'latitud' => $subsidiary->latitud, 'longitud' => $subsidiary->longitud]);	
			}
		}catch(Exception $ex){
    		return response()->json(['respuesta' => 'false']);
    	}
    }

}
