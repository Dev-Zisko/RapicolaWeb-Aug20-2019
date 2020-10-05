<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Exception;

class TicketController extends Controller
{
    public function logout($id){
    	try{
    		$ticket = \DB::table('tickets')->where('ticket', $id)->first();
			if($ticket == null){
				return redirect("/");
			}
			else{
				\DB::table('tickets')->where('ticket', $id)->delete();
				return redirect("index");
			}
    	}catch(Exception $ex){
    		$mensaje = "Ocurrió un error inesperado al salir de la cuenta. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
    	}
    }
}
