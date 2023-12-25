<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::where('statuses_id', '!=', 2)->paginate(8);
        return view('users', compact('users'));
    }

    public function create()
    {
        return view('createusers');
    }

    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:8',
        'document' => 'required|string|max:20|unique:users',
        'age' => 'required|integer',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    $imageName = uniqid() . '.' . $request->file('img')->getClientOriginalExtension();
    $request->file('img')->move(public_path('img/users'), $imageName);

    $user = new User;
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->document = $request->input('document');
    $user->img = '/img/users/' . $imageName;
    $user->age = $request->input('age');
    $user->statuses_id = 1;
    $user->assignRole('admin');   

    if ($user->save()) {
        return redirect()->route('admin.users.index')->with('success', 'Usuario creado');
    } else {
        return redirect()->route('admin.users.index')->with('error', 'Error al crear el usuario');
    }
}

    public function edit($id)
    {
        
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $rutaimge = $user->img;
    $permitido = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'tif', 'svg', 'webp', 'ico', 'webp'];

    if ($request->hasFile('img')) {
        $tipoArchivo = $request->file('img')->getClientOriginalExtension();
        if (!in_array($tipoArchivo, $permitido)) {
            return back()->with('error', 'Tipo de archivo no válido. Por favor, sube un archivo jpeg, jpg, png, gif, bmp, tif, svg, webp o ico');
        }

        $imageName = uniqid() . '.' . $tipoArchivo;
        $request->file('img')->move(public_path('img/users'), $imageName);

        if ($rutaimge && file_exists(public_path($rutaimge))) {
            unlink(public_path($rutaimge));
        }

        $user->img = '/img/users/' . $imageName;
    }

    if ($request->filled('name')) {
        $user->name = $request->input('name');
    }

    if ($request->filled('email')) {
        $user->email = $request->input('email');
    }

    if ($request->filled('document')) {
        $user->document = $request->input('document');
    }

    if ($request->filled('age')) {
        $user->age = $request->input('age');
    }

    if ($request->filled('validacion')) {
        $user->statuses_id = 2;
    }
    if ($request->filled('admin')) {
        $user->removeRole('empleado'); 
        $user->assignRole('admin');   
    }
    if ($request->filled('empleado')) {
        $user->removeRole('admin'); 
        $user->assignRole('empleado');   
    }
    

    if ($user->save()) {
        if ($request->filled('validacion')) {
            return redirect()->route('admin.users.index')->with('success', 'Usuario deshabilitado');
        } else {
            return redirect()->route('admin.users.index')->with('success', 'Perfil actualizado con éxito');
        }
    } else {
        return redirect()->route('admin.users.index')->with('error', 'No se pudo actualizar el perfil');
    }
}
    public function updateStatus(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->input('status') == 1) {
            $user->statuses_id = 2; 
        } else {
            $user->statuses_id = 1; 
        }

        $user->save();

        return back();
    }
}
