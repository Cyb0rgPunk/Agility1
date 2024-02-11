<?= $this->extend('templates/admin_templates');?>
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
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Usuarios</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
            </ol>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Datos Usuario</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableUsers" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!--th>Id</th-->
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Grupo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($users as $user): ?>
                                    <tr>
                                        <!--td><?php echo $user['id_user']?></td-->
                                        <td><?php echo $user['user']?></td>
                                        <td><?php echo $user['email']?></td>
                                        <td><?php echo $user['description']?></td>
                                        <td>
                                            <a href="<?=site_url('EditProjetcs/'.$user['id_user']);?>"
                                                class="btn btn-primary" type="button">Editar</a>
                                            <a href="<?=site_url('DeleteProjects/'.$user['id_user']);?>"
                                                class="btn btn-danger" type="button">Eliminar</a>
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
  $(function () {
    $("#tableUsers").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');
  });
</script>
<?= $this->endSection();?>