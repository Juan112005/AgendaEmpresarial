<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfileController extends Controller
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
        $user = Auth::user();
        return view('profile')->with('user', $user);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // ...
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ...
    }

    /**
     * Display the specified resource.
     */
    public function show(user $profile)
    {
        // ...
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user $profile)
    {
        // ...
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
    
        $rutaimge = $user->img;
    
        $permitido = ['jpeg', 'jpg', 'png', 'gif', 'bmp', 'tif', 'svg', 'webp', 'ico'];
    
        if ($request->hasFile('image')) {
            $tipoArchivo = $request->file('image')->getClientOriginalExtension();
            if (!in_array($tipoArchivo, $permitido)) {
                return back()->with('error', 'Tipo de archivo no válido. Por favor, sube un archivo jpeg, jpg, png, gif, bmp, tif, svg, webp o ico');
            }
        }
    
        if ($request->filled('email')) {
            $request->validate([
                'email' => 'email', // Asegura que el email tenga un formato válido
            ], [
                'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            ]);
        
            $existingUser = User::where('email', $request->input('email'))
                ->where('id', '!=', $user->id)
                ->first();
        
            if ($existingUser) {
                // Agrega el mensaje de error directamente a la vista actual
                return back()->withErrors(['email' => 'El correo electrónico ya está registrado.']);
            }
        
            $user->email = $request->input('email');
        }
        
    
        if ($request->filled('name')) {
            $user->name = $request->input('name');
        }
    
        if ($request->filled('document')) {
            $user->document = $request->input('document');
        }
    
        if ($request->filled('age')) {
            $user->age = $request->input('age');
        }
    
        if ($request->hasFile('image')) {
            $image = $request->file('image');
    
            $imageName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img/users'), $imageName);
    
            $user->img = '/img/users/' . $imageName;
    
            if ($rutaimge && file_exists(public_path($rutaimge))) {
                unlink(public_path($rutaimge));
            }
        }
    
        if ($request->filled('name') || $request->filled('email') || $request->filled('document') || $request->filled('age') || $request->hasFile('image')) {
            if ($user->save()) {
                return back()->with('actualizar_perfil', 'ok');
            } else {
                return back()->with('No se pudo actualizar el perfil');
            }
        } else {
            return back()->with('error', 'Por favor llene mínimo un campo');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user $profile)
    {
        // ...
    }
}
