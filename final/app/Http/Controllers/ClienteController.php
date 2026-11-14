<?php

namespace App\Http\Controllers;

use App\Models\cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::all();
        return view('clientes.index',
            compact('clientes'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:clientes,correo',
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:100',
        ]);

        Cliente::create($data);
        return redirect()->route('clientes.index')
            ->with('ok', 'Cliente creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(cliente $cliente)
    {
        return view('clientes.show',
            compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(cliente $cliente)
    {
        return view('clientes.edit',
            compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, cliente $cliente)
    {
        $data = $request->validate([
            'nombre' => 'required|string|max:100',
            'correo' => 'required|email|unique:clientes,correo,' . $cliente->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'required|string|max:100',
        ]);
        $cliente->update($data);
        return redirect()->route('clientes.index')->with('ok', 'Cliente actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')->with('ok', 'Cliente eliminado.');
    }
}
