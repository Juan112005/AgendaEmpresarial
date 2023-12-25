<?php

namespace App\Http\Controllers;

use App\Models\Agends;
use App\Models\User;
use App\Models\UsersHasAgends;
use App\Models\UxA;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AgendsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $userlog = Auth::id();
        $usuarios = UsersHasAgends::all();
        $usuariologued = User::find($userlog);
        $esadmin=$usuariologued->hasRole('admin');
        if ($esadmin) {
            $agends = Agends::where('statuses_id',1)->paginate(9);
        } else {
            // $usuarios = UsersHasAgends::join('users','users.id','users_has_agends.users_id')->get();

            $usuariosagend = UsersHasAgends::where('users_id', '=', $userlog)->get();
            $numerouser = $usuariosagend->count();
            for ($i = 0; $i < $numerouser; $i++) {
                $agendas[$i] = $usuariosagend[$i]->agends_id;
            }if (!empty($agendas)) {
                $agends = Agends::whereIn('id', $agendas)->where('statuses_id',1)->paginate(9);
            }else {
                $agends= collect();
            }
            
        }
        return view('agends', compact('agends', 'users', 'usuarios', 'userlog','esadmin'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('agendscreate');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pruebas = $request->input('users');

        $img = $request->file('img');
        // Validar el tipo de archivo
        $request->validate([
            'img' => 'mimes:jpeg,png,jpg,gif|max:10240', // MAX 2MB
        ]);

        $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
        $img->move(public_path('img/agenda'), $imgName);


        $agends = new Agends();
        $agends->name = $request->input('name');
        $agends->description = $request->input('description');
        $agends->img = 'img/agenda/' . $imgName;
        $agends->statuses_id = 1;
        $agends->owner_id = Auth::user()->id;
        $agends->save();
        $UxA = new UsersHasAgends;
        $UxA->agends_id = $agends->id;
        $UxA->users_id = Auth::id();
        $UxA->save();
        if($request->filled('users')){
        foreach ($pruebas as $prueba) {
            $UxA = new UsersHasAgends;
            $UxA->agends_id = $agends->id;
            $UxA->users_id = $prueba;
            $UxA->save();
        }}
        return redirect()->route('admin.agends.store')->with('success', 'agendacreada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Agends $agends)
    {
        // Recuperar todas las agendas de la base de datos
        $agends = Agends::all();

        // Pasar los datos a una vista llamada 'agendas'
        return view('agends', compact('agends'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $agend = Agends::find($id);
        return view('agendsedit', compact('agend'));
    }

    public function update(Request $request, $id)
    {
        $agend = Agends::find($id);
        $UxA = UsersHasAgends::where('agends_id', '=', $agend->id)->delete();



        if ($agend) {
            $usuarioschuleados = $request->input('usuarios');
            $UxAcreateowner = new UsersHasAgends();
            $UxAcreateowner->agends_id = $id;
            $UxAcreateowner->users_id = Auth::id();
            $UxAcreateowner->save();
            if($request->filled('usuarios')){
            foreach ($usuarioschuleados as $usuarioschuleado) {
                $UxAcreate = new UsersHasAgends;
                $UxAcreate->agends_id = $id;
                $UxAcreate->users_id = $usuarioschuleado;
                $UxAcreate->save();
            }}

            if ($request->hasFile('img')) {
                $img = $request->file('img');
                // Validar el tipo de archivo
                $request->validate([
                    'img' => 'mimes:jpeg,png,jpg,gif|max:10240', // MAX 2MB
                ]);

                $imgName = uniqid() . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('img/agenda'), $imgName);
                $agend->img = '/img/agenda/' . $imgName;
            }


            $agend->name = $request->input('name');
            $agend->description = $request->input('description');
            $agend->save();


            return redirect()->route('admin.agends.index')->with('success', 'agendaeditada');
        } else {
            return redirect()->route('admin.agends.index')->with('error', 'Agenda no encontrada');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $agend = Agends::find($id);

        if ($agend) {
            // Cambiar statuses_id a 2 para "eliminado"
            $agend->statuses_id = 2;
            $agend->save();


            return redirect()->route('admin.agends.index')->with('success', 'Agenda eliminada exitosamente.');
        } else {
            return redirect()->route('admin.agends.index')->with('error', 'Agenda no encontrada.');
        }
    }
}
