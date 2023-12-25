<?php

namespace App\Http\Controllers;

use App\Models\Agends;
use App\Models\Events;
use App\Models\User;
use App\Models\Status;
use App\Models\Coments;
use App\Models\Users;
use App\Models\UsersHasAgends;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{

    //Constructor:
    public function __construct()
    {
        $this->middleware('auth');
    }


    //Vista index de los eventos:
    public function index(Request $request)
    {

        //    $agends=Agends::all();
        $userlog = Auth::id();
        $usuariologued = User::find($userlog);
        if ($usuariologued->hasRole('admin')) {
            $events = Events::where('statuses_id',1)->paginate(12);
            $agends = Agends::all();
        } else {
            $usuariosagend = UsersHasAgends::where('users_id', '=', $userlog)->get();
            $numerouser = $usuariosagend->count();
            for ($i = 0; $i < $numerouser; $i++) {
                $agendas[$i] = $usuariosagend[$i]->agends_id;
            }
            if (!empty($agendas)) {
                $agendassinvalidar = Agends::whereIn('id', $agendas)->get();
            $contaragendas = $agendassinvalidar->count();
            for ($i = 0; $i < $contaragendas; $i++) {
                if ($agendassinvalidar[$i]->statuses_id == 1) {
                    $agendasvalidadas[$i] = $agendassinvalidar[$i]->id;
                }
            }
            // dd($agendasvalidadas);
            $agends = Agends::whereIn('id', $agendasvalidadas)->get();
            }else {
                $agendasvalidadas=collect();
                $agends=collect();
            }
            

            $events = Events::whereIn('agends_id', $agendasvalidadas)->where('statuses_id',1)->paginate(12);
        }
        $comentario = Coments::where('statuses_id',1)->get();
        $user = Users::all();
        return view('events', compact('events', 'agends', 'comentario', 'user'));
    }







    //Metodo por donde se ve la vista y se toman las agendas
    public function create()
    {
        $agends = Agends::all();
        return view('eventscreate', compact('agends'));
    }


    //Metodo de la logica para crear el usuario, usando ORM.
    public function store(Request $request)
    {


        $events = new Events;
        $events->name = $request->input('name');
        $events->description = $request->input('description');
        $events->ubication = $request->input('ubication');
        $events->fech_inicio = $request->input('fech_inicio');
        $events->fech_final = $request->input('fech_final');
        $events->agends_id = $request->input('agend');
        // $events->priorities_id = 1;
        $events->statuses_id = 1;
        $events->save();
        return redirect()->route('admin.events.index')->with('crear', "ok");
    }


    public function show($id)
    {

        $agends = Agends::all();
        $events = Events::where('agends_id', $id)->get();
        return view('agendaeventos', compact('events', 'agends'));
    }


    //Metodo por donde se pasan las vistas del formulario, 
    public function edit($id)
    {
        $event = Events::find($id);
        return view('eventsedit', ['event' => $event]);
    }


    //Metodo donde se almacena el cambio enviado por el formulario usando ORM.
    public function update(Request $request, $id)
    {
        $event = Events::find($id);
        $events = Events::all();
        if ($request->input('status') == 1) {
            $event->statuses_id = 2; // Cambia a inactivo
            $event->save();
            return redirect()->route('admin.events.index')->with('eliminar', "ok");
        } else {
            $event->statuses_id = 1; // Cambia a activo

            $event->name = $request->input('name');
            $event->description = $request->input('description');
            $event->ubication = $request->input('ubication');
            $event->fech_inicio = $request->input('fech_inicio');
            $event->fech_final = $request->input('fech_final');
            $event->save();


            $agend = Agends::all();
            return redirect()->route('admin.events.index')->with('editar', "ok");
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $events = Events::find($id);
        $events->delete();
        return view('larutaespecifica');
    }
}
