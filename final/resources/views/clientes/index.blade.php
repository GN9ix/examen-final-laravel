@extends('layout')
@section('title','Listado de Clientes')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3">Listado de clientes</h1>
    <a class="btn btn-primary" href="{{ route('clientes.create') }}">Nuevo</a>
</div>
<form method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="q" value="{{ request('q') }}"
            class="form-control" placeholder="Buscar por nombre o correo">
        <button class="btn btn-outline-secondary">Buscar</button>
    </div>
</form>

<table class="table table-striped">
    <thead><tr>
        <th>ID</th><th>Nombre</th><th>Correo</th><th>Teléfono</th><th></th>
    </tr></thead>
    <tbody>
        @forelse($clientes as $a)
        <tr>
            <td>{{ $a->id }}</td>
            <td><a href="{{ route('clientes.show',$a) }}">{{ $a->nombre }}</a></td>
            <td>{{ $a->correo }}</td>
            <td>{{ $a->telefono }}</td>
            <td class="text-end">
                <a class="btn btn-sm btn-secondary" href="{{ route('clientes.edit',$a) }}">Editar</a>
                <form action="{{ route('clientes.destroy',$a) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('¿Eliminar?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @empty
          <tr><td colspan="5">Sin registros</td></tr>
        @endforelse
    </tbody>
</table>
@endsection