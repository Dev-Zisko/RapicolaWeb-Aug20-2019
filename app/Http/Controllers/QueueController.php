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
use App\Ticket;

class QueueController extends Controller
{
    public function srestart_queue($id){
        try{
            $ticket = \DB::table('tickets')->where('ticket', $id)->first();
            if($ticket == null){
                return redirect("/");
            }
            else{
                $newid = Crypt::decrypt($id);
                $subsidiary = \DB::table('subsidiaries')->where('email', $newid)->first();
                \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->update(['actual'=>0]);
                \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->update(['ultimo'=>0]);
                \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->update(['puesto'=>null]);
                \DB::table('customers')->where('id_queue', $subsidiary->id)->update(['puesto'=>null]);
                \DB::table('customers')->where('id_queue', $subsidiary->id)->update(['status'=>null]);
                \DB::table('customers')->where('id_queue', $subsidiary->id)->update(['id_queue'=>null]);
                $queues = \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->paginate(10);
                return redirect()->route('subdashboardq', ['id' => $id]);
            }
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al reiniciar el estado de la cola. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function crestart_queue($id){
        try{
            $ticket = \DB::table('tickets')->where('ticket', $id)->first();
            if($ticket == null){
                return redirect("/");
            }
            else{
                $newid = Crypt::decrypt($id);
                $cashier = \DB::table('cashiers')->where('email', $newid)->first();
                $subsidiary = \DB::table('subsidiaries')->where('id', $cashier->id_subsidiary)->first();
                \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->update(['actual'=>0]);
                \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->update(['ultimo'=>0]);
                \DB::table('cashiers')->where('id_subsidiary', $subsidiary->id)->update(['puesto'=>null]);
                \DB::table('customers')->where('id_queue', $subsidiary->id)->update(['puesto'=>null]);
                \DB::table('customers')->where('id_queue', $subsidiary->id)->update(['status'=>null]);
                \DB::table('customers')->where('id_queue', $subsidiary->id)->update(['id_queue'=>null]);
                $queues = \DB::table('queues')->where('id_subsidiary', $subsidiary->id)->paginate(10);
                return redirect()->route('subcashierq', ['id' => $id]);
            }
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al reiniciar el estado de la cola. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }
}
