<?php

namespace App\Http\Controllers;

use App\Models\Reserva;
use App\Models\User;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = User::where('doc_id', '<>', null)->get()
            ->map(function ($item) {
                $reservas = Reserva::where('user_id', $item->id)
                    ->where('fin', null)->with('libro')->get();
                $item->reservas = $reservas;
                return $item;
            });
        return view('cliente.index', compact('clientes'));
    }
}
