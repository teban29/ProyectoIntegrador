@extends('layouts.admin')

@section('title', 'Detalles de la Categoría')

@section('admin-content')
    <h1>{{ $categoria->nombre }}</h1>
    <a href="{{ route('categorias.index') }}">Volver a la lista de categorías</a>
@endsection