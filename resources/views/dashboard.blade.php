<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SocialBook - Panel de Control - {{$user_inst->nombre}}</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="{{asset('assets/css/sb-admin.css')}}" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="{{asset('assets/css/plugins/morris.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('assets/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- jQuery -->
    <script src="{{asset('assets/js/jquery.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">SocialBook</a>
            </div>
                <ul class="nav navbar-nav">
                    <li>
                        <a href="/institucion/{{$user_inst->nom_institucion}}">{{$user_inst->nombre}}</a>
                    </li>
                </ul>

            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{ Auth::user()->name }} <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ url('/logout') }}"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
            <div class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav navbar-nav side-nav">
                    <li id="informacionInstitucional">
                        <a href="/dashboard/informacionInstitucional"><i class="fa fa-fw fa-dashboard"></i> Información Institucional</a>
                    </li>
                    <li>
                        <a id="eventos" href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-calendar"></i> Avisos <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="demo" class="collapse">
                            <li id="nuevoEvento">
                                <a href="/dashboard/nuevoAviso">Nuevo Aviso</a>
                            </li>
                            <li id="listaEventos">
                                <a href="/dashboard/listaAvisos">Lista de Avisos</a>
                            </li>
                        </ul>
                    </li>
                    <li id="estadisticas">
                        <a href="/dashboard/estadisticas"><i class="fa fa-fw fa-bar-chart-o"></i> Estadísticas de Eventos</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            {{$user_inst->nombre}} <small>Panel de Control</small>
                        </h1>
                        <ol class="breadcrumb">
                            <li class="active">
                                @yield('lugar')
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->

                @yield('content')

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- POPUP MODAL -->
    <!-- Modal -->
    <div id="popupConfirmacion" class="modal fade" role="dialog" style="show:false;">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">ATENCIÓN</h4>
          </div>
          <div class="modal-body" id="textoPopup">
          </div>
          <div class="modal-footer" id="confirmarPopup">
          </div>
        </div>

      </div>
    </div>


    <script type="text/javascript">
        /**
         * Marca como seleccionada la pestaña correspondiente del menú lateral
         */
        var activo = (window.location.pathname).substring(11);
        if (activo=="nuevoEvento" || activo=="listaEventos"){
            $("#eventos").removeClass();
            $("#eventos").attr("aria-expanded","true");
            $("#demo").attr("aria-expanded","true");
            $("#demo").removeClass();
            $("#demo").addClass("collapse in");
            $("#"+activo).css("background-color","#080808");
            $("#"+activo).css("color","#fff");
        }
        $("#"+activo).addClass("active");
    </script>

<!-- Enviar Formularios por AJAX -->
    <style type="text/css">
    .help-block{display: none;}
    </style>

    <script type="text/javascript">

    /**
     * Recibe el 'id' de un formulario
     * Lo eńvía por AJAX a la ruta que corresponde
     * Si resulta bien, entrega la respuesta en un popup
     * Si tiene errores de validación, los muestra en los campos correspondientes
     * Si hay algún error desde el servidor, muestra la respuesta en un popup
     *
     * @param      {string}  operacion  La 'id' del formulario que se envía
     */
    function enviarFormulario(operacion){
        var url = window.location.pathname;
        $.ajax({
            url: url,
            type: "POST",
            dataType: 'json',
            data: $("#"+operacion).serialize(),
            success: function(response){
                $(".form-group").removeClass("has-error");
                $(".help-block").css("display","none");
                $("strong").remove();

                $('#popupConfirmacion').modal('show');
                $("#textoPopup").empty();
                $("#textoPopup").append("<p>"+response.msg+"</p>");
            },
            error: function(response){
                $(".form-group").removeClass("has-error");
                $(".help-block").css("display","none");
                $("strong").remove();
                var data = response.responseJSON;
                if (data['errors']) {
                    for (var i in data['errors']) {
                        $("#"+i+"Group").addClass("has-error");
                        $("#"+i+"Helpblock").append("<strong>"+data['errors'][i][0]+"</strong>")
                        $("#"+i+"Helpblock").css("display","inline");
                    }
                }
                else{
                    $('#popupConfirmacion').modal('show');
                    $("#textoPopup").empty();
                    $("#textoPopup").append("<p>"+data['msg']+"</p>");
                }
                
            },
        });     
    }
    </script>
<!-- FIN Enviar Formularios por AJAX -->

</body>

</html>
