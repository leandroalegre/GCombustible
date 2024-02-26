<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Control de tickets de nafta </title>
   <link rel="shortcut icon" href="<?php echo base_url(); ?>favicon.ico"/>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   
      <link rel="stylesheet" href="<?php echo base_url();?>public/bootstrap/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="<?php echo base_url();?>public/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
      <link rel="stylesheet" href="<?php echo base_url()?>libs/css/main.css" />
      <link rel="stylesheet" href="<?php echo base_url();?>public/datatables.net-bs/css/dataTables.bootstrap.min.css">
      <script src="<?php echo base_url();?>public/jquery/jquery-3.4.1.min.js"></script>
      <script src="<?php echo base_url();?>public/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="<?php echo base_url();?>public/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script>
        $(document).ready(function(){

          $("#tabla1").DataTable({
            "language": {
              "lengthMenu": "Mostrar _MENU_ registros por pagina",
              "zeroRecords": "No se encontraron resultados en su busqueda",
              "searchPlaceholder": "Buscar registros",
              "info": "Mostrando registros de _START_ al _END_ de un total de  _TOTAL_ registros",
              "infoEmpty": "No existen registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "search": "Buscar:",
              "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
              },
            }
          });

          

        })
      </script>
    </head>

    <nav class="navbar navbar-inverse" style="border-radius: 35px; background-color: black">
      <div class="container-fluid">

        <!-- BRAND -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#alignment-example" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a href="<?php echo base_url();?>Login"><img src="<?php echo base_url()?>public/images/vcpgob.png" style='height: 55px; border: 2px solid black; border-radius: 35px'></a>
        </div>

        <!-- COLLAPSIBLE NAVBAR -->
        <div class="collapse navbar-collapse" id="alignment-example">
          <ul class="nav navbar-nav">  


            <?php 
            switch ($this->session->userdata("rol")) {
              case '1':
              ?>
              <li><a href="<?php echo base_url()?>Personas/listausuarios">Usuarios</a></li>
              <li><a href="<?php echo base_url()?>Ticket/verMovimientosSoli">Movimientos solicitudes</a></li>
              <li><a href="<?php echo base_url()?>Personas/listapersonas">Personas</a></li>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Tickets <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Ticket/verMovimientosTickets">Movimientos tickets</a></li>
              <li><a href="<?php echo base_url()?>Ticket/listEmitidos">Listado de tickets sin cargar</a></li>
              <li><a href="<?php echo base_url()?>Ticket/listRendidos">Listado de tickets rendidos</a></li>
              <li><a href="<?php echo base_url()?>Ticket/reintegroSaldo">Reintegro de saldo</a></li>
              </ul>
              </li>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Vehiculos <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Vehiculos/listSolicitudes">Solicitudes de saldo</a></li>
              <li><a href="<?php echo base_url()?>Vehiculos/Solicitudes">Lista de solicitudes</a></li>
                <li><a href="<?php echo base_url()?>Vehiculos/index">Lista de vehiculos</a></li>
                <li><a href="<?php echo base_url()?>Vehiculos/detalleVehiculos">Detalle de vehiculos</a></li>
                <li><a href="<?php echo base_url()?>Vehiculos/nuevadependencia">Nueva dependencia</a></li>
              </ul>
              </li>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Licencias <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Personas/actualizarLicencia">Actualizar licencia</a></li>
              <li><a href="<?php echo base_url()?>Personas/historicoLicencias">Historico licencias</a></li>
              </ul>
              </li>
                  
                  <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Reportes <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Reportes/porSecretaria">Reporte por secretaria</a></li>
                <li><a href="<?php echo base_url()?>Reportes/TicketsPorPersona">Reporte por persona</a></li>
                     <li><a href="<?php echo base_url()?>Reportes/TicketsPorVehiculo">Reporte por Vehiculo</a></li>
                     <li><a href="<?php echo base_url()?>Reportes/TicketsPorVehiculoLitros">Reporte por Vehiculo por litros</a></li>
                     <li><a href="<?php echo base_url()?>Reportes/TicketsPorTipoComb">Reporte por Tipo combustible</a></li>
                     <li><a href="<?php echo base_url()?>Reportes/TicketsPorDevolucion">Reporte por Devolucion de saldo</a></li>
										 <li><a href="<?php echo base_url()?>Ticket/cargadoPorPersona">Cargado por persona</a></li>
										 <li><a href="<?php echo base_url()?>Ticket/litrosPorSec">Grafico por litros</a></li>
										 <li><a href="<?php echo base_url()?>Ticket/getLitrosMes">Por mes por vehiculo</a></li>
										 
              </ul>
            
              <?php
              break;
              case '2':
              ?>
              <li><a href="<?php echo base_url()?>Ticket/index">Emitir ticket</a></li>
               <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Tickets <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
                            <li><a href="<?php echo base_url()?>Ticket/listEmitidos">Listado de tickets sin cargar</a></li>
              <li><a href="<?php echo base_url()?>Ticket/reintegroSaldo">Reintegro de saldo</a></li>
              </ul>
              </li>
              <li><a href="<?php echo base_url()?>Ticket/listSolicitudes">Solicitudes</a></li>
              <li><a href="<?php echo base_url()?>Personas/listapersonas">Personas</a></li>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Vehiculos <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
                <li><a href="<?php echo base_url()?>Vehiculos/index">Lista de vehiculos</a></li>
                <li><a href="<?php echo base_url()?>Vehiculos/solicitarSaldo">Solicitar saldo</a></li>
								<li><a href="<?php echo base_url()?>Vehiculos/solicitudesEmitidas">Listado de solicitudes emitidas</a></li>
                     <?php if ($this->session->userdata('rol') == 8 || $this->session->userdata('rol') == 1) { ?>
                     <li><a href="<?php echo base_url()?>Vehiculos/detalleVehiculos">Detalle de vehiculos</a></li>
                     <?php }else if($this->session->userdata('rol') == 2) { ?>
                     <li><a href="<?php echo base_url()?>Vehiculos/detallesfiltradosxsec">Detalle de vehiculos</a></li>
                     <?php } ?>
              </ul>
              </li>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Licencias <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Personas/actualizarLicencia">Actualizar licencia</a></li>
              </ul>
              </li>
               <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Reportes <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Ticket/cargadoPorVehiculos">Cargado por vehiculos</a></li>
                     <li><a href="<?php echo base_url()?>Reportes/TicketsPorVehiculoSec">Reporte por Vehiculo</a></li>
                     <li><a href="<?php echo base_url()?>Reportes/TicketsPorPersonaSec">Reporte por Persona</a></li>
                     <?php 
                      if ($this->session->userdata("nombre_secretaria") == "SECRETARIA DE DESARROLLO URBANO AMBIENTAL") {
                        ?>
                        <li><a href="<?php echo base_url()?>Reportes/tabla_precios">Tabla de precios por combustible</a></li>
                        <?php
                      }
                     ?>
              </ul>
            </li>

              <?php
               if ($this->session->userdata("nombre_secretaria") == "INTENDENCIA") {
                 ?>
                <li class="dropdown">
          <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Reportes <span class="caret"></span></a>
          <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
                  <li><a href="<?php echo base_url()?>Reportes/TicketsPorPersona">Reporte por persona</a></li>
                 <li><a href="<?php echo base_url()?>Reportes/TicketsPorVehiculo">Reporte por Vehiculo</a></li>
                 <li><a href="<?php echo base_url()?>Reportes/TicketsPorVehiculoLitros">Reporte por Vehiculo por litros</a></li>
                 <li><a href="<?php echo base_url()?>Reportes/TicketsPorTipoComb">Reporte por Tipo combustible</a></li>
                 <li><a href="<?php echo base_url()?>Reportes/TicketsPorDevolucion">Reporte por Devolucion de saldo</a></li>
          </ul>
        </li>
               </li>
                 <?php
               }
              break;

              case '3':
              ?>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Tickets <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Ticket/index">Emitir ticket</a></li>
              <li><a href="<?php echo base_url()?>Ticket/listEmitidos">Listado de tickets sin cargar</a></li>
              </ul>
              </li>
              <li><a href="<?php echo base_url()?>Personas/listapersonas">Personas</a></li>
              <li><a href="<?php echo base_url()?>Vehiculos/index">Vehiculos</a></li>
              <?php  
              break;

              case '4':
              ?>
              <li><a href="<?php echo base_url()?>Ticket/rendir">Rendir ticket</a></li>
              <li><a href="<?php echo base_url()?>Ticket/listRendidos">Listado de tickets rendidos</a></li>
              <li><a href="<?php echo base_url()?>Ticket/listEmitidos">Listado de tickets sin cargar</a></li>
              <?php 
              break;

              case '5':
              ?>
              <li><a href="<?php echo base_url()?>Ticket/listSolicitudesForSecretario">Confirmacion de solicitudes</a></li>
              <li><a href="<?php echo base_url()?>Ticket/verMovimientosSoli">Listado de movimientos solicitudes</a></li>
              <li><a href="<?php echo base_url()?>Ticket/verMovimientosTickets">Movimientos tickets</a></li>
              <li><a href="<?php echo base_url()?>Personas/listapersonas">Personas</a></li>
              <li><a href="<?php echo base_url()?>Vehiculos/index">Lista de vehiculos</a></li>
              <?php
              break;

              case '6':
              ?>
               <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Tickets <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Ticket/rendir">Rendir ticket</a></li>
              <li><a href="<?php echo base_url()?>Ticket/verMovimientosTickets">Movimientos tickets</a></li>
               <li><a href="<?php echo base_url()?>Ticket/listRendidos">Listado de tickets rendidos</a></li>
              <li><a href="<?php echo base_url()?>Ticket/listEmitidos">Listado de tickets sin cargar</a></li>
              </ul>
              </li>
              <li><a href="<?php echo base_url()?>Ticket/listSolicitudesContaduria">Solicitudes</a></li>
              <li><a href="<?php echo base_url()?>Ticket/verMovimientosSoli">Movimientos solicitudes</a></li>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Reportes <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
              <li><a href="<?php echo base_url()?>Reportes/reportePorExpediente">Reporte por expediente</a></li>
              </ul>
            </li>
              <?php
              break;

              case '8':
              ?>
              <li><a href="<?php echo base_url()?>Reportes/dashboard">Licencias</a></li>
              <li><a href="<?php echo base_url()?>Personas/listapersonas">Personas</a></li>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Vehiculos <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">

                <li><a href="<?php echo base_url()?>Vehiculos/index">Lista de vehiculos</a></li>
                <li><a href="<?php echo base_url()?>Vehiculos/detalleVehiculos">Detalle de vehiculos</a></li>
              </ul>
              </li>
              <?php
              break;

              case '9':
              ?>
              <li class="dropdown">
              <a class="dropdown-toggle hvr-underline-from-center" data-toggle="dropdown" href="#">Vehiculos <span class="caret"></span></a>
              <ul class="dropdown-menu" style="box-shadow: 5px 4px 4px grey">
                <li><a href="<?php echo base_url()?>Vehiculos/index">Lista de vehiculos</a></li>
                <li><a href="<?php echo base_url()?>Vehiculos/detalleVehiculos">Detalle de vehiculos</a></li>
              </ul>
              </li>
              <?php
              break;

							case '10':
								?>
								<li><a href="<?php echo base_url()?>Personas/listapersonas">Personas</a></li>
								<li><a href="<?php echo base_url()?>Vehiculos/index">Lista de vehiculos</a></li>
								<?php
								break;

            }
            ?>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li style="vertical-align: middle;">
              <a style="color: white;">
                <?php if ($this->session->userdata('rol') == 9) {
                  echo $this->session->userdata('dependencia');
                }else{ ?>
                  <?php 
                  if ($this->session->userdata("nombre_direccion") == "SIN DIRECCION") { 
                    echo $this->session->userdata("nombre_secretaria");
                  }else{
                    echo $this->session->userdata("nombre_direccion");
                  }
                }
                ?>
              </a>
            </li> 
            <?php if($this->session->userdata("nombre_apellido")!=null){ ?>
            <li style="vertical-align: middle;"><a style="color: white;"><?php echo $this->session->userdata("nombre_apellido");?></a></li>
            <?php }else{ ?>
              <li style="vertical-align: middle;"><a style="color: white;"><?php echo $this->session->userdata("username");?></a></li>

            <?php } ?>
            <li><a class="hvr-underline-from-center" href="<?php echo base_url(); ?>Login/logout"><span class="fa fa-power-off"></span> Cerrar sesión</a></li>
          </ul>
        </div>
      </div>
    </nav>




