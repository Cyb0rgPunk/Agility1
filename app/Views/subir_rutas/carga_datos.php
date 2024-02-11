<?= $this->extend('templates/session');?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Cargar datos</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Cargar datos</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cargar archivo de excel</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="<?php echo base_url('/Rutas/spreadsheet_import')?>"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="my-input">Seleccionar archivo: </label>
                                    <input id="my-input" class="form-control" type="file" name="upload_file"
                                        id="upload_file">
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
                                <th>Numero CC</th>
                                <th>Nombre</th>
                                <th>Direccion</th>
                                <th>Barrio</th>
                                <th>Hora llegada</th>
                                <th>Hora recogida</th>
                                <th>Ruta</th>
                                <th>Consolidado</th>
                                <th>Movil</th>
                                <th>Placa</th>
                                <th>Conductor</th>
                                <th>Avantel</th>
                                <th>Documento</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($solicitudes as $solicitud): ?>
                            <tr>
                                <td><?php echo $solicitud['fecha']?></td>
                                <td><?php echo $solicitud['numero_cc']?></td>
                                <td><?php echo $solicitud['nombre']?></td>
                                <td><?php echo $solicitud['direccion']?></td>
                                <td><?php echo $solicitud['barrio']?></td>
                                <td><?php echo $solicitud['hora_llegada']?></td>
                                <td><?php echo $solicitud['hora_recogida']?></td>
                                <td><?php echo $solicitud['ruta']?></td>
                                <td><?php echo $solicitud['consolidado']?></td>
                                <td><?php echo $solicitud['movil']?></td>
                                <td><?php echo $solicitud['placa']?></td>
                                <td><?php echo $solicitud['conductor']?></td>
                                <td><?php echo $solicitud['avantel']?></td>
                                <td><?php echo $solicitud['documento']?></td>

                                <td>
                                    <a href="<?=base_url('editarAutor/'.$solicitud['id']);?>" class="btn btn-primary"
                                        type="button">Editar</a>
                                    <a href="<?=base_url('borrarAutor/'.$solicitud['id']);?>" class="btn btn-danger"
                                        type="button">Eliminar</a>
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
<script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('#tablaRutas').DataTable();
});
</script>
<?= $this->endSection();?>