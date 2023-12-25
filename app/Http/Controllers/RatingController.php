<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $ratings = Rating::all();
        return view('rating', compact('ratings', 'user'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'assessment' => 'required|numeric|min:1|max:5',
            'review' => 'required|string',
        ]);
        
        $rating = new Rating;
        $rating->assessment = intval($request->input('assessment'));
        $rating->review = $request->input('review');
        $rating->users_id = auth()->id(); // Asigna el ID del usuario autenticado
        $rating->statuses_id = 1;
        $rating->save(); 
    
        // Redirigir o mostrar un mensaje después de guardar
        return redirect()->back()->with('creado', 'ok'); 
    }
    public function update(Request $request, $id)
    {
        $rating = Rating::find($id);
        if ($request->filled('eliminar')) {
            $rating->statuses_id = 2;
            $rating->save();

            return redirect()->back()->with('eliminado', 'ok'); 
        }
    }
}