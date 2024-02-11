<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

</script>
<?= $this->endSection();?>
<?= $this->section('content');?>
<div class="container-fluid">
    <!--INICIO TRIPULACION-->
    <div class="row">
        <div class="col-sm-12">
            <br><br>
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Solicitudes Tripulación</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tableTripulacion" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha y hora Solicito </th>
                                <th>Fecha y hora Servicio </th>
                                <th>Pasajero</th>
                                <th>Celular</th>
                                <th>Documento</th>
                                <th>Correo electronico</th>
                                <th>Ciudad</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Acciones</th>
                                <th>Servicio</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //dd($solicitudes_tipulacion);?>

                            <?php //foreach($solicitudes[$i]es as $solicitudes[$i]): ?>
                            <?php for($i=0; $i < count($solicitudes_tipulacion); $i++) :?>
                            <tr>
                                <input type="hidden" name="id" id='id'
                                    value="<?= $solicitudes_tipulacion[$i]['id_solicitud'] ?>">
                                <td><?php echo $solicitudes_tipulacion[$i]['id_solicitud']?></td>
                                <td><?php echo $solicitudes_tipulacion[$i]['fecha_hora_solicitud']?></td>
                                <td><?php echo $solicitudes_tipulacion[$i]['fecha_hora']?></td>
                                <td><?php echo  @$solicitudes_tipulacion[$i]['primer_nombre'].' '.@$solicitudes_tipulacion[$i]['primer_apellido']?>
                                </td>
                                <td><?php echo @$solicitudes_tipulacion[$i]['celular']?></td>
                                <td><?php echo @$solicitudes_tipulacion[$i]['id_nacional']?></td>
                                <td><?php echo @$solicitudes_tipulacion[$i]['correo']?></td>
                                <td>
                                    <?php 
                                        if(@$solicitudes_tipulacion[$i]['id_ciudad'] == 1){echo "Bogotá";}
                                        if(@$solicitudes_tipulacion[$i]['id_ciudad'] == 2){echo "Medellin";}
                                    ?>
                                </td>
                                <td><?php echo @$solicitudes_tipulacion[$i]['origen']?></td>
                                <td><?php echo @$solicitudes_tipulacion[$i]['destino']?></td>
                                <td id="">
                                    <?php if(session('group_name') != 'conductor' && session('group_name') != 'pasajero' && session('group_name') != 'requisidor' && session('group_name') != 'super'):?>
                                    <a href="<?=site_url('admin/AsignarMovilTripulacion/'.@$solicitudes_tipulacion[$i]['id_solicitud']);?>"
                                        class="btn btn-primary" type="button">Asignar movil</a>
                                    <a href="<?=site_url('admin/TarifaAdicional/'.@$solicitudes_tipulacion[$i]['id_solicitud'].'/tripulacion');?>"
                                        class="btn btn-secondary" type="button">Tarifa Adicional</a>
                                    <?php endif;?>
                                    <!--button type="button" class="btn btn-success btn-detalles" onclick="detalles()"
                                        value="<?= @$solicitudes_tipulacion[$i]['id_solicitud']?>" id="btnDetalles"
                                        name="btnDetalles" data-toggle="modal" data-target="#modal-xl">
                                        Detalles solicitud
                                    </button-->
                                    <?php if(session('group_name') == 'pasajero' || session('group_name') == 'requisidor' || session('group_name') == 'admin' ):?>
                                    <a href="<?=site_url('admin/CancelarSolicitudTripulacion/'.@$solicitudes_tipulacion[$i]['id_solicitud']);?>"
                                        class="btn btn-danger" type="button">Cancelar servicio</a>
                                    <?php endif;?>
                                    <?php if(session('group_name') == 'conductor'):?>
                                    <a href="<?=site_url(session('group_name').'/ActualizarEstado/tripulacion/2/'.@$solicitudes_tipulacion[$i]['id_solicitud']);?>"
                                        class="btn btn-primary" type="button" name="btn_aceptar">Aceptar servicio</a>
                                    <a href="<?=site_url(session('group_name').'/ActualizarEstado/tripulacion/3/'.@$solicitudes_tipulacion[$i]['id_solicitud']);?>"
                                        class="btn btn-danger" type="button" name="btn_rechazar">Rechazar servicio</a>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if(session('group_name') == 'conductor'):?>
                                    <a style="display: <?php if($solicitudes_tipulacion[$i]['estado_conductor'] == 0 || $solicitudes_tipulacion[$i]['estado_conductor'] == 3 ){echo 'none'; }?>;" href="<?=site_url(session('group_name').'/IniciarServicio/tripulacion/'.@$solicitudes_tipulacion[$i]['id_solicitud']);?>"
                                        class="btn btn-success" type="button" name="btn_aceptar">Iniciar servicio</a>
                                    <!--a style="display: <?php if($solicitudes_tipulacion[$i]['estado_conductor'] == 0 || $solicitudes_tipulacion[$i]['estado_conductor'] == 3){echo 'none'; }?>;" href="<?=site_url(session('group_name').'/FinalizarServicion/tripulacion/'.@$solicitudes_tipulacion[$i]['id_solicitud']);?>"
                                        class="btn btn-danger" type="button" name="btn_rechazar">Finalizar servicio</a-->
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endfor; ?>
                            <?php //endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!--FIN TRIPULACION-->
    <!--INICIO VOUCHER-->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Solicitudes voucher</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tableVoucher" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha y hora Solicito </th>
                                <th>Fecha y hora Servicio </th>
                                <th>Pasajero</th>
                                <th>Celular</th>
                                <th>Documento</th>
                                <th>Correo electronico</th>
                                <th>Ciudad</th>
                                <th>Origen</th>
                                <th>Destino</th>
                                <th>Acciones</th>
                                <th>Servicio</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php //foreach($solicitudes[$i]es as $solicitudes[$i]): ?>
                            <?php for($i=0; $i < count($solicitudes_voucher); $i++) :?>
                            <?php 
                            $color = '';
                            if($solicitudes_voucher[$i]['cancelada_pasajero'] == 1){
                                $color = 'red';        
                            }

                            if($solicitudes_voucher[$i]['estado_conductor'] == 0){ $color_conductor = 'red';}
                            if($solicitudes_voucher[$i]['estado_asignado'] == 1){ $color_conductor = 'yellow';}
                            if($solicitudes_voucher[$i]['estado_conductor'] == 1){ $color_conductor = 'yellow';}
                            if($solicitudes_voucher[$i]['estado_conductor'] == 2){ $color_conductor = 'green';}
                            if($solicitudes_voucher[$i]['estado_conductor'] == 3){ $color_conductor = 'red';}

                            if($solicitudes_voucher[$i]['estado_conductor'] == 0){ $color_pasajero = 'green';}    
                            
                            ?>
                            <tr style="background-color:<?= $color;?>;">
                                <input type="hidden" name="id" id='id'
                                    value="<?= $solicitudes_voucher[$i]['id_solicitud'] ?>">
                                <td><?php echo $solicitudes_voucher[$i]['id_solicitud']?></td>
                                <td><?php echo $solicitudes_voucher[$i]['fecha_hora_solicitud']?></td>
                                <td><?php echo $solicitudes_voucher[$i]['fecha_hora']?></td>

                                <td><?php echo $solicitudes_voucher[$i]['primer_nombre'].' '.$solicitudes_voucher[$i]['primer_apellido']?>
                                </td>
                                <td><?php echo $solicitudes_voucher[$i]['celular']?></td>
                                <td><?php echo $solicitudes_voucher[$i]['id_nacional']?></td>
                                <td><?php echo $solicitudes_voucher[$i]['correo']?></td>
                                <td>
                                    <?php 
                                    if($solicitudes_voucher[$i]['id_ciudad'] == 1){echo "Bogotá";}
                                    if($solicitudes_voucher[$i]['id_ciudad'] == 2){echo "Medellin";}
                                ?>
                                </td>
                                <td><?php echo $solicitudes_voucher[$i]['origen']?></td>
                                <td><?php echo $solicitudes_voucher[$i]['destino']?></td>
                                <td id="evaluate">
                                    <?php if(session('group_name') != 'conductor' && session('group_name') != 'pasajero' && session('group_name') != 'requisidor' && session('group_name') != 'super'):?>
                                    <a href="<?=site_url('admin/AsignarMovilTripulacion/'.$solicitudes_voucher[$i]['id_solicitud']);?>"
                                        class="btn btn-primary" type="button">Asignar movil</a>
                                    <a href="<?=site_url('admin/TarifaAdicional/'.$solicitudes_voucher[$i]['id_solicitud'].'/tripulacion');?>"
                                        class="btn btn-secondary" type="button">Tarifa Adicional</a>
                                    <?php endif;?>
                                    <?php if(session('group_name') == 'pasajero' || session('group_name') == 'requisidor' || session('group_name') == 'admin' ):?>
                                    <a href="<?=site_url('admin/CancelarSolicitudTripulacion/'.$solicitudes_voucher[$i]['id_solicitud']);?>"
                                        class="btn btn-danger" type="button">Cancelar servicio</a>
                                    <?php endif;?>
                                    <?php if(session('group_name') == 'conductor'):?>
                                    <a href="<?=site_url(session('group_name').'/ActualizarEstado/voucher/2/'.@$solicitudes_voucher[$i]['id_solicitud']);?>"
                                        class="btn btn-primary" type="button">Aceptar servicio</a>

                                    <a href="<?=site_url(session('group_name').'/ActualizarEstado/voucher/3/'.@$solicitudes_voucher[$i]['id_solicitud']);?>"
                                        class="btn btn-danger" type="button">Rechazar servicio</a>
                                    <?php endif;?>
                                </td>
                                <td style="display: none;">
                                    <?php if(session('group_name') == 'conductor'):?>
                                    <a style="display: <?php if($solicitudes_voucher[$i]['estado_conductor'] == 0){echo 'none'; }?>;" href="<?=site_url(session('group_name').'/IniciarServicio/voucher/'.@$solicitudes_voucher[$i]['id_solicitud']);?>"
                                        class="btn btn-success" type="button" name="btn_aceptar">Iniciar servicio</a>
                                    <!--a style="display: <?php if($solicitudes_voucher[$i]['estado_conductor'] == 0){echo 'none'; }?>;" href="<?=site_url(session('group_name').'/FinalizarServicion/voucher/'.@$solicitudes_voucher[$i]['id_solicitud']);?>"
                                        class="btn btn-danger" type="button" name="btn_rechazar">Finalizar servicio</a-->
                                    <?php endif;?>
                                </td>
                            </tr>
                            <?php endfor; ?>
                            <?php //endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!--FIN Voucher-->
    <!--INICIO RECOGIDAS-->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rutas Recogida</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tablaRutasRecogidas" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora Inicio</th>
                                <th>Cantidad Padajeros</th>
                                <th>Asigandos</th>
                                <th>Ruta</th>
                                <th>Confirmación <br> conductor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        if(session('group_name') == 'condcutor'){
                            $ocultar = 'hiden';
                        }
                        
                        $color = "";
                        $texto = "";
                        foreach($rutas_recogidas as $solicitud):
                            if($solicitud['confirmacion'] == 0){
                                $color="red";
                                $texto = "Rechazado";
                            }
                            if($solicitud['confirmacion'] == 1){
                                $color="green";
                                $texto = "Aceptado";
                            } 
                            if($solicitud['confirmacion'] == null){
                                $color="orange";
                                $texto = "Sin confirmar";
                            }                                
                            if($solicitud['conductor'] == ""){
                                $color="yellow";
                                $texto = "Sin asignar";
                            }
                            if(@$solicitud['confirmados'] == @$solicitud['cantidad']){
                                $color_asiganados="green";
                            }else{
                                $color_asiganados="yellow";
                            }


                        ?>

                            <tr>
                                <td><?php echo date('Y-m-d', strtotime($solicitud['fecha']))?></td>

                                <td><?php echo $solicitud['hora_llegada']?></td>
                                <td><?php echo $solicitud['cantidad']?></td>
                                <td bgcolor="<?=@$color_asiganados;?>"><?php echo @$solicitud['confirmados']?></td>
                                <td><?php echo $solicitud['szname']?></td>
                                <td bgcolor="<?=$color;?>"><?php echo $texto?></td>
                                <td>
                                    <a style="display: <?php if($solicitud['confirmacion'] == 1){echo 'none'; }?>;" href="<?=base_url(session('group_name').'/PasajerosRuta/'.$solicitud['ruta'].'/'.$solicitud['hora_llegada'].'/'.date('Y-m-d', strtotime($solicitud['fecha'])));?>"
                                        class="btn btn-success" type="button">Gestionar ruta</a>
                                    <?php
                                    if(session('group_name') == 'conductor'){
                                ?>
                                    <a href="<?=base_url(session('group_name').'/IniciarRutaRecogida/'.$solicitud['ruta'].'/'.$solicitud['hora_llegada'].'/'.date('Y-m-d', strtotime($solicitud['fecha'])));?>"
                                        class="btn btn-primary" type="button">Iniciar Ruta</a>
                                    <?php        
                                    }
                                ?>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!--FIN RECOGIDAS-->
    <!--INICIO REPARTO-->
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Rutas Reparto</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tablaRutasRecogidas" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora Recogida</th>
                                <th>Cantidad Padajeros</th>
                                <th>Asigandos</th>
                                <th>Ruta</th>
                                <th>Confirmación <br> conductor</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        if(session('group_name') == 'condcutor'){
                            $ocultar = 'hiden';
                        }
                        
                        $color = "";
                        $texto = "";
                        foreach($rutas_reparto as $solicitud):
                            if($solicitud['confirmacion'] == 0){
                                $color="red";
                                $texto = "Rechazado";
                            }
                            if($solicitud['confirmacion'] == 1){
                                $color="green";
                                $texto = "Aceptado";
                            } 
                            if($solicitud['confirmacion'] == null){
                                $color="orange";
                                $texto = "Sin confirmar";
                            }                                
                            if($solicitud['conductor'] == ""){
                                $color="yellow";
                                $texto = "Sin asignar";
                            }
                            if(@$solicitud['confirmados'] == @$solicitud['cantidad']){
                                $color_asiganados="green";
                            }else{
                                $color_asiganados="yellow";
                            }




                        ?>

                            <tr>
                                <td><?php echo date('Y-m-d', strtotime($solicitud['fecha']))?></td>

                                <td><?php echo $solicitud['hora_recogida']?></td>
                                <td><?php echo $solicitud['cantidad']?></td>
                                <td bgcolor="<?=@$color_asiganados;?>"><?php echo @$solicitud['confirmados']?></td>
                                <td><?php echo $solicitud['szname']?></td>
                                <td bgcolor="<?=$color;?>"><?php echo $texto?></td>
                                <td>
                                    <a style="display: <?php if($solicitud['confirmacion'] == 1){echo 'none'; }?>;" href="<?=base_url(session('group_name').'/PasajerosRutaReparto/'.$solicitud['ruta'].'/'.$solicitud['hora_recogida'].'/'.date('Y-m-d', strtotime($solicitud['fecha'])));?>"
                                        class="btn btn-success" type="button">Gestionar ruta</a>
                                    <?php
                                    if(session('group_name') == 'conductor'){
                                ?>
                                    <a href="<?=base_url(session('group_name').'/IniciarRutaReparto/'.$solicitud['ruta'].'/'.$solicitud['hora_recogida'].'/'.date('Y-m-d', strtotime($solicitud['fecha'])));?>"
                                        class="btn btn-primary" type="button">Iniciar Ruta</a>
                                    <?php        
                                    }
                                ?>
                                </td>

                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!--FIN REPARTO-->

</div>
<?= $this->endSection();?>
<?= $this->section('scripts');?>
<script src="<?=base_url()?>/public/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url()?>/public/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url()?>/public/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url()?>/public/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url()?>/public/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Select2 -->
<script src="<?=base_url()?>/public/plugins/select2/js/select2.full.min.js"></script>

<script>
$(function() {
    var hoy = new Date();
    var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
    //alert(hoy.getHours());

    var nextDay = new Date(hoy)
    nextDay.setDate(hoy.getDate() + 1);
    availableDate = nextDay
    disableDate = []

    if (hoy.getHours() >= 15) {
        //$('#modal-danger').modal('show');
        disableDate = [hoy]
        availableDate = nextDay
    }

    var dateToday = new Date();
    $('#reservationdatetime').datetimepicker({
        minDate: nextDay.setHours(0),
        icons: {
            time: 'far fa-clock'
        },
        inline: true,
        sideBySide: true,
        disabledDates: disableDate
    });

    /*$("#tableUsers").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');*/

    $("#tableTripulacion").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
    });

    $("#tableVoucher").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tablaVoucher_wrapper .col-md-6:eq(0)');

    $("#tablaRutasRecogidas").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tablaRutasRecogidas_wrapper .col-md-6:eq(0)');




    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
});
</script>
<?= $this->endSection();?>