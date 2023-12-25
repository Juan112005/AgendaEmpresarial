<?php

namespace App\Http\Controllers;

use App\Models\Coments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coments = Coments::where('statuses_id',1)->paginate(15);
        return view('coments', compact('coments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $coments = new Coments;
        if ($request->filled('eventocomentario')) {
            $coments->users_id = auth()->id();
            $coments->statuses_id=1;
            $coments->events_id=$request->input('event');
            if ($request->filled('content')) {
                $coments->content = $request->input('content');
            }
            $coments->save();
            return redirect()->route('admin.events.index')->with('comentario','comencreate');
        }
        // $coments->statuses_id=1;
        // $coments->users_id = auth()->id();
        // $coments->events_id = 9;
        // if ($request->filled('content')) {
        //     $coments->content = $request->input('content');
        // }
        // $coments->save();
        // return redirect()->route('admin.coments.index')->with('success','create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Coments $coments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Coments $coments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $coment = Coments::find($id);
        if ($request->filled('validacion')) {
            $coment->statuses_id =2;
            $coment->save();
            return redirect()->route('admin.coments.index')->with('success','delete');
        }
        
        if ($request->filled('content')) {
            $coment->content=$request->input('content');
        }
        $coment->save();

        return redirect()->route('admin.coments.index')->with('edit','ok');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coments $coments)
    {
        //
    }
}
