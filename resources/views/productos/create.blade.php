@extends('layouts.admin')

@section('title', 'Crear Producto')

@section('admin-content')
    <h1>Crear Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
    </div>
    <div>
        <label for="descripcion">Descripción:</label>
        <textarea id="descripcion" name="descripcion" required></textarea>
    </div>
    <div>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" required>
    </div>
    <div>
        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" min="0" required>
    </div>
    <div>
        <label for="marca_id">Marca:</label>
        <select id="marca_id" name="marca_id" required>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="categoria_id">Categoría:</label>
        <select id="categoria_id" name="categoria_id" required>
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="imagen">Imagen:</label>
        <input type="file" id="imagen" name="imagen">
    </div>
    <button type="submit">Crear Producto</button>
</form>
@endsection