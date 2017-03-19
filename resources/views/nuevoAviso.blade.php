@extends('dashboard')
@section('lugar') <i class="fa fa-fw fa-calendar"></i> Avisos -> Nuevo Aviso @endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Nuevo Aviso</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" id="nuevoAviso">
            {{ csrf_field() }}

            <div id="tituloGroup" class="form-group">
                <label for="titulo" class="col-md-4 control-label">Título</label>

                <div class="col-md-6">
                    <input id="titulo" type="text" class="form-control" name="titulo" value="">

                        <span id="tituloHelpblock" class="help-block"></span>
                </div>
            </div>

            <div id="descripcionGroup" class="form-group">
                <label for="descripcion" class="col-md-4 control-label">Descripción</label>

                <div class="col-md-6">
                    <textarea id="descripcion" class="form-control" rows="5" name="descripcion" value=""></textarea>

                        <span id="descripcionHelpblock" class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <input type="button" onclick="enviarFormulario('nuevoAviso')" class="btn btn-primary" value=" Guardar">
                    </input>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection