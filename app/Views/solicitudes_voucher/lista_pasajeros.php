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
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Solicitudes</h1>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
            <li class="breadcrumb-item active">Solicitudes</li>
        </ol>
    </div>
</div>
<div class="container-fluid">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-md-12">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Cargar archivo de excel</h3>

                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form method="post" action="<?php echo base_url(session('group_name').'/UploadVoucher')?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
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
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista Pasajeros <span style='color:red;'>(Busque el pasajaro y solicite el servicio)</span></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableUsers" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!--th>Id</th-->
                                        <th>Cliente</th>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Celular</th>
                                        <th>Id Nacional</th>
                                        <th>Centro Costo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($pasajeros as $pasajero): ?>
                                    <tr>
                                        <!--td><?php echo $pasajero['id_pasajero']?></td-->
                                        <td>
                                            <?php 
                                                if($pasajero['id_cliente'] == 1){echo "Avianca";}
                                                if($pasajero['id_cliente'] == 2){echo "Avianca";}
                                            ?>
                                        </td>
                                        <td><?php echo $pasajero['primer_nombre']?><?php echo "  ".$pasajero['segundo_nombre']?>
                                        </td>
                                        <td><?php echo $pasajero['primer_apellido']?><?php echo "  ".$pasajero['segundo_apellido']?>
                                        </td>
                                        <td><?php echo $pasajero['celular']?></td>
                                        <td><?php echo $pasajero['id_nacional']?></td>
                                        <td><?php echo $pasajero['centro_costo']?></td>
                                        <td>
                                            <a href="<?=site_url('admin/SolicitudesVoucher/'.$pasajero['id_pasajero']);?>"
                                                class="btn btn-success" type="button">Solicitar Servicio</a>
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
    </section>
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

<script>
$(function() {
    $("#tableUsers").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');
});
</script>
<?= $this->endSection();?>