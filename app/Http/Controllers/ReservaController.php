<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Reserva;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $reserva = new Reserva();
        $reserva->inicio = now();
        $reserva->libro_id = $request->libro_id;
        $reserva->user_id = auth()->user()->id;
        $reserva->save();
        $libro = Libro::find($request->libro_id);
        $libro->disponible = 0;
        $libro->save();
        return redirect()->route('libros.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $reserva = Reserva::find($id);
        $reserva->fin = now();
        $reserva->save();
        $libro = Libro::find($reserva->libro_id);
        $libro->disponible = 1;
        $libro->save();
        return redirect()->route('libros.index');
    }
}
