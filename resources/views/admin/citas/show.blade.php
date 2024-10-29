@extends('admin.layout')

@section('title')
    Citas
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Citas</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Id</label>
                                    <input type="text" class="form-control" value="{{ $cita->id }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" value="{{ $cita->nombre }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Apellido</label>
                                    <input type="text" class="form-control" value="{{ $cita->apellido }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" value="{{ $cita->email }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input type="text" class="form-control" value="{{ $cita->telefono }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Dirección</label>
                                    <input type="text" class="form-control" value="{{ $cita->direccion }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Ciudad</label>
                                    <input type="text" class="form-control" value="{{ $cita->ciudad }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input type="text" class="form-control" value="{{ $cita->estado }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>País</label>
                                    <input type="text" class="form-control" value="{{ $cita->pais }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Observaciones</label>
                                    <input type="text" class="form-control" value="{{ $cita->observaciones }}" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>        
@endsection