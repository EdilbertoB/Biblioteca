<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use App\Models\Reserva;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->doc_id) {
            $reservas = $this->getReservas(true);
            $libros = Libro::where('baja','0')->get();
            foreach ($reservas as $key => $value) {
                $libros = collect($libros)
                    ->reject(function ($current_libro) use ($value) {
                        return $current_libro->id == $value->libro_id;
                    });
            }
            return view('libro.index', compact('libros', 'reservas'));
        } else {
            $reservas = $this->getReservas();
            // $libros = Libro::paginate(10);
            $libros = Libro::where('baja','0')->get();
            return view('libro.index', compact('libros', 'reservas'));
        }
    }

    private function getReservas($cliente = false)
    {
        $reservas = Reserva::where('fin', null)->with('libro')
            ->orderBy('libro_id', 'ASC')->get()
            ->map(function ($item) {
                $fecha = Date::createFromDate($item->inicio);
                $fecha->day += 3;
                $fecha->hour = 0;
                $fecha->minute = 0;
                $fecha->second = 0;
                $ahora = Date::now();
                if ($fecha <= $ahora) {
                    $item->plazo_entrega = 0;
                } else
                    $item->plazo_entrega = $ahora->diffInRealHours($fecha, false);
                return $item;
            });
        if ($cliente) {
            $id_cliente = auth()->user()->id;
            $reservas = collect($reservas)
                ->reject(function ($current_reserva) use ($id_cliente) {
                    return $current_reserva->user_id != $id_cliente;
                });
        }

        return $reservas;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('libro.crear');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $libro = new Libro();
        $libro->titulo = $request->titulo;
        $libro->descripcion = $request->descripcion;
        $libro->save();
        return redirect()->route('libros.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $libro = Libro::find($id);
        $reserva = Reserva::where('libro_id', $id)
        ->where('fin', null)->with('user')->first();
        $libro->reserva = $reserva;
        return view('libro.detalles', compact('libro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $libro = Libro::find($id);
        return view('libro.editar', compact('libro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $libro = Libro::find($id);
        $libro->titulo = $request->titulo;
        $libro->descripcion = $request->descripcion;
        $libro->save();
        return redirect()->route('libros.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $libro = Libro::find($id);
        $libro->baja = 1;
        $libro->save();
        return redirect()->route('libros.index');
    }
}
