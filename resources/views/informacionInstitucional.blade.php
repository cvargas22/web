@extends('dashboard')
@section('lugar') <i class="fa fa-fw fa-dashboard"></i> Información Institucional @endsection
@section('content')

<div class="panel panel-default">
    <div class="panel-heading">Información Institucional</div>
    <div class="panel-body">
        <form class="form-horizontal" role="form" method="POST" id="editarInformacionInstitucional">
            {{ csrf_field() }}

            <div id="nombreGroup" class="form-group">
                <label for="nombre" class="col-md-4 control-label">Nombre</label>

                <div class="col-md-6">
                    <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $user_inst->nombre }}">

                        <span id="nombreHelpblock" class="help-block"></span>
                </div>
            </div>

            <div id="direccionGroup" class="form-group">
                <label for="direccion" class="col-md-4 control-label">Dirección</label>

                <div class="col-md-6">
                    <input id="direccion" type="text" class="form-control" name="direccion" value="{{ $user_inst->direccion }}">

                        <span id="direccionHelpblock" class="help-block"></span>
                </div>
            </div>

            <div id="misionGroup" class="form-group">
                <label for="mision" class="col-md-4 control-label">Misión</label>

                <div class="col-md-6">
                    <textarea id="mision" class="form-control" rows="5" name="mision">{{ $user_inst->mision }}</textarea>

                        <span id="misionHelpblock" class="help-block"></span>
                </div>
            </div>

            <div id="visionGroup" class="form-group">
                <label for="vision" class="col-md-4 control-label">Visión</label>

                <div class="col-md-6">
                    <textarea id="vision" class="form-control" rows="5" name="vision">{{ $user_inst->vision }}</textarea>

                        <span id="visionHelpblock" class="help-block"></span>
                </div>
            </div>

            <div id="telefonoGroup" class="form-group">
                <label for="telefono" class="col-md-4 control-label">Teléfono</label>

                <div class="col-md-6">
                    <input id="telefono" type="text" class="form-control" name="telefono" value="{{ $user_inst->telefono }}">

                        <span id="telefonoHelpblock" class="help-block"></span>
                </div>
            </div>

            <div id="mailGroup" class="form-group">
                <label for="mail" class="col-md-4 control-label">E-Mail</label>

                <div class="col-md-6">
                    <input id="mail" type="email" class="form-control" name="mail" value="{{ $user_inst->mail }}">

                        <span id="mailHelpblock" class="help-block"></span>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <input type="button" onclick="enviarFormulario('editarInformacionInstitucional')" class="btn btn-primary" value=" Guardar">
                    </input>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection