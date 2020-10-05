<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Exception;
use Auth;
use App\Subsidiary;
use App\Queue;
use App\Http\Requests\SubsidiaryRequest;

class SubsidiaryController extends Controller
{
    public function r_subsidiary(SubsidiaryRequest $request){
        try{
    		$subsidiary = new Subsidiary;
    		$subsidiary->rif = Auth::user()->rif;
    		$subsidiary->nombre = $request->nombre;
    		$subsidiary->telefono = $request->telefono;
    		$subsidiary->direccion = $request->direccion;
    		$subsidiary->email = $request->email;
    		$subsidiary->password = Hash::make($request->password);
            if ($request->hasFile('logo'))
            {
                $nuevoLogo = $request->file('logo')->store('public');
                $logo = substr($nuevoLogo, 7);
                $subsidiary->logo = $logo;
            }
    		$subsidiary->id_business = Auth::user()->id;
    		$subsidiary->save();
    		$subsidiaries = Subsidiary::All();
    		$sub = $subsidiaries->last();
    		$queue = new Queue;
    		$queue->actual = 0;
    		$queue->ultimo = 0;
    		$queue->id_subsidiary = $sub->id;
    		$queue->save();
            return redirect('dashboards');
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al registrar la sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function u_subsidiary(SubsidiaryRequest $request, $id){
		try{
            $newid = Crypt::decrypt($id);
            \DB::table('subsidiaries')->where('id', $newid)->update(['nombre'=>$request->nombre]);
            \DB::table('subsidiaries')->where('id', $newid)->update(['telefono'=>$request->telefono]);
            \DB::table('subsidiaries')->where('id', $newid)->update(['email'=>$request->email]);
            \DB::table('subsidiaries')->where('id', $newid)->update(['direccion'=>$request->direccion]);
            if ($request->hasFile('logo'))
            {
                $nuevoLogo = $request->file('logo')->store('public');
                $logo = substr($nuevoLogo, 7);
                \DB::table('subsidiaries')->where('id', $newid)->update(['logo' => $logo]);
            }
            $encrypass = Hash::make($request->password);
            \DB::table('users')->where('id', $newid)->update(['password'=>$encrypass]);
            return redirect('dashboards');
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al actualizar la sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }

    public function d_subsidiary($id){
    	try{
            $newid = Crypt::decrypt($id);
            \DB::table('customers')->where('id_queue', $newid)->update(['puesto'=>null]);
            \DB::table('customers')->where('id_queue', $newid)->update(['status'=>null]);
            \DB::table('customers')->where('id_queue', $newid)->update(['id_queue'=>null]);
            \DB::table('queues')->where('id_subsidiary', $newid)->delete();
            \DB::table('cashiers')->where('id_subsidiary', $newid)->delete();
            \DB::table('subsidiaries')->where('id', $newid)->delete();
            return redirect('dashboards');
        }catch(Exception $ex){
            $mensaje = "Ocurrió un error inesperado al eliminar la sucursal. Intentelo nuevamente.";
            return view('error', compact('mensaje'));
        }
    }
}
