<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</script>
<?= $this->endSection();?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <?php 
                //dd($pasajeroes);
            ?>
            <h1>Asignar movil pasajeros
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Asignar movil</li>
            </ol>
        </div>
    </div>

    <div class="row">
        <?php //dd($ruta)?>

        <input type="hidden" name="id_sub_zona" value="<?php echo $pasajeros[0]['id_sub_zona'];?>">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Datos</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tablaRutas" class="table table-bordered tablaRutas">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Hora recogida</th>
                                <th>Nombre</th>
                                <th>Cedula</th>
                                <th>Dirección</th>
                                <th>Barrio</th>
                                <th>Registrado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                                $i = 1;
                                foreach($pasajeros as $pasajero): 
                            ?>
                            <tr>
                                <td><?php echo $i?></td>
                                <td><?php echo $pasajero['hora_recogida']?></td>
                                <td><?php echo $pasajero['nombre']?></td>
                                <td><?php echo $pasajero['numero_cc']?></td>
                                <td><?php echo $pasajero['direccion']?></td>
                                <td><?php echo $pasajero['barrio']?></td>
                                <td bgcolor="<?= $pasajero['color_existe'] ?>"><?php echo $pasajero['existe']?></td>
                            </tr>
                            <?php $i++; endforeach; ?>
                        </tbody>
                    </table>
                </div>


                <!-- /.card-body -->
            </div>
        </div>


    </div>
    <div class="row">
        <div class="col-md-12">
            <form method="POST" action="<?= site_url(session('group_name').'/UpdateMovilRutaReparto')?>">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Asignar Movil</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>



                    <div class="card-body">
                        <input type="hidden" name="ruta" value="<?= $pasajeros[0]['id_ruta']?>">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_movil">Movil </label>
                                    <select id="id_movil" class="form-control select2 select2bs4" name="id_movil"
                                        required>
                                        <?php foreach ($moviles as $movil): ?>
                                        <?php echo '<option value='.$movil['id_movil'].'>'.$movil['movil'].' - '.$movil['placa'].'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_conductor">Conductor </label>
                                    <select id="id_conductor" class="form-control select2 select2bs4"
                                        name="id_conductor" required>
                                        <?php foreach ($conductores as $conductor): ?>
                                        <?php echo '<option value='.$conductor['id_conductor'].'>'.$conductor['nombre'].' - '.$conductor['identification'].'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                        </div>

                    </div>


                    <div class="card-footer">
                        <input type="hidden" name="rutas_asignar" value='<?= $rutas_asignar?>'>
                        <input type="hidden" name="id_ruta" value="<?= $id_ruta;?>">
                        <input type="hidden" name="hora_recogida" value="<?= $hora_recogida;?>">            
                        <input type="hidden" name="fecha" value="<?= $fecha;?>"> 
                        <button type="submit" class="btn btn-primary">Asignar movil</button>
                    </div>

                </div>



            </form>
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
        $('.select2').select2()
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        })
    });
    $(document).ready(function() {
        

        var table1 = $('#tablaRutas').DataTable({
            "select": false,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tablaRutas_wrapper .col-md-6:eq(0)');

    });
</script>
<?= $this->endSection();?>