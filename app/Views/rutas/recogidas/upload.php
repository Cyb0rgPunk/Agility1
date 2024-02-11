<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</script>
<?= $this->endSection();?>
<?PHP
$display = '';
if(session('group_name') == 'conductor'){
    $display = 'none';
}
?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Gestion rutas recogidas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Gestion rutas recogidas</li>
            </ol>
        </div>
    </div>
    <div class="row" style="display:<?=$display;?>">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cargar archivo de excel</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="<?php echo base_url(session('group_name').'/CargaRutas')?>"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="my-input">Seleccionar archivo: </label>
                                    <input id="my-input" class="form-control" type="file" name="upload_file"
                                        id="upload_file" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Cargar archivo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row" style="display:<?=$display;?>">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Filtros</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="<?php echo base_url(session('group_name').'/FiltroFechas')?>"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-8">
                                <button type="button" class="btn btn-block btn-success" onclick="location.href='<?= site_url(session('group_name').'/RutasRecogidas/1')?>'" >Todos los registros</button>
                            </div> 
                            <div class="col-sm-2"></div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Fecha Inicio</label><br>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#reservationdatetime" name="fecha_inicio" required>
                                        <div class="input-group-append" data-target="#reservationdatetime"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Fecha Fin</label><br>
                                    <div class="input-group date" id="reservationdatetime2" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#reservationdatetime2" name="fecha_fin" required>
                                        <div class="input-group-append" data-target="#reservationdatetime2"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Filtrar rutas</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tablaRutas" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora Inicio</th>
                                <th>Cantidad Pasajeros</th>
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
                            foreach($solicitudes as $solicitud):
                                $porcentaje_completado = 0;
                                $aceptados = 0;




                                if($solicitud['confirmacion'] == 0){
                                    $color="red";
                                    $texto = "Rechazado";
                                }
                                

                                if(@$solicitud['cantidad'] == @$solicitud['confirmados']){
                                    $color="green";
                                    $texto = "Aceptado";
                                } 
                                if(@$solicitud['rechazados'] != 0){
                                    $color="red";
                                    $texto = "Rechazado";
                                }

                                if($solicitud['confirmacion'] == null){
                                    $color="orange";
                                    $texto = "Sin confirmar";
                                }                                
                                if($solicitud['conductor'] == ""){
                                    $color="yellow";
                                    $texto = "Sin asignar";
                                }
                                if(@$solicitud['confirmados'] == $solicitud['cantidad']){
                                    $color_asiganados="green";
                                }else{
                                    $color_asiganados="yellow";
                                }                                
                               

                            ?>

                            <tr>
                                <td><?php echo date('Y-m-d', strtotime($solicitud['fecha']))?></td>

                                <td><?php echo $solicitud['hora_llegada']?></td>
                                <td><?php echo $solicitud['cantidad']?></td>
                                <td bgcolor="<?=@$color_asiganados;?>" class="text-center">
                                    <?php 
                                            
                                    if(@$solicitud['confirmados'] >= 1){
                                       
                                        $porcentaje_completado = ((@$solicitud['confirmados']) / @$solicitud['cantidad']) * 100;
                                    }                                      
                                    ?>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar progress-bar-danger" style="width: <?=@$porcentaje_completado?>%"></div>
                                        
                                    </div>
                                    <div><span class="badge bg-danger"><?=@$porcentaje_completado?>%</span></div>
                                </td>
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

    $('#reservationdatetime').datetimepicker({
        icons: {
            time: 'far fa-clock'
        },
        format: 'L',
        //inline: true,
        //sideBySide: true,
    });

    $('#reservationdatetime2').datetimepicker({
        icons: {
            time: 'far fa-clock'
        },
        format: 'L',
        useCurrent: false
        //inline: true,
        //sideBySide: true,
    });

    $("#reservationdatetime").on("change.datetimepicker", function (e) {
            $('#reservationdatetime2').datetimepicker('minDate', e.date);
    });
    $("#reservationdatetime2").on("change.datetimepicker", function (e) {
        $('#reservationdatetime').datetimepicker('maxDate', e.date);
    });
  
});

$(document).ready(function() {

    $("#tablaRutas").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tablaRutas_wrapper .col-md-6:eq(0)');
});
</script>
<?= $this->endSection();?>