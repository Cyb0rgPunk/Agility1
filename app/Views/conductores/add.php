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
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Conductores</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Conductores</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php if(session('msg')):?>
            <div class="alert alert-<?=session('msg.type')?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <h5><i class="icon fas fa-<?=session('msg.icon')?>"></i> Alert!</h5>
                <?=session('msg.body')?>
            </div>
            <?php endif;?>
        </div>
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Cargar archivo de excel</h3>
                    
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="post" action="<?php echo base_url(session('group_name').'/UploadConductores')?>"
                    enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="my-input">Seleccionar archivo: </label>
                                    <input id="my-input" class="form-control" type="file" name="upload_file" id="upload_file" required>
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
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos Conductor</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url('admin/SaveConductor')?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" class="form-control" type="text" name="nombre"  onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Celular</label>
                                    <input id="phone" class="form-control" type="number" name="phone" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input id="email" class="form-control" type="email" name="email" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="identification">Cedula</label>
                                    <input id="identification" class="form-control" type="number" name="identification" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_movil">Movil</label>
                                    <select id="id_movil" class="form-control select2 select2bs4" name="id_movil"
                                        required>
                                        <?php foreach ($moviles as $movil): ?>
                                        <?php echo '<option value='.$movil['id_movil'].'>'.$movil['movil'].' - '.$movil['placa'].'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->




        </div>
    </div>
</div>
<div class="container-fluid">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Lista Condcutores</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableUsers" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Nombre</th>
                                        <th>Cedula</th>
                                        <th>Celular</th>
                                        <th>Correo</th>
                                        <th>Movil asignado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($conductores as $conductor): ?>
                                    <tr>
                                        <td><?php echo $conductor['id_conductor']?></td>
                                        <td><?php echo $conductor['nombre']?></td>
                                        <td><?php echo $conductor['identification']?></td>
                                        <td><?php echo $conductor['phone']?></td>
                                        <td><?php echo $conductor['email']?></td>
                                        <td><?php echo $conductor['placa']?></td>
                                        <td>
                                            <a href="<?=site_url('admin/EditConductor/'.$conductor['id_conductor']);?>"
                                                class="btn btn-primary" type="button">Editar</a>
                                            <a href="<?=site_url('admin/DeleteConductor/'.$conductor['id_conductor']);?>"
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

    var input=  document.getElementById('phone');
    input.addEventListener('input',function(){
    if (this.value.length > 10) 
        this.value = this.value.slice(0,10); 
    })

    var input2=  document.getElementById('identification');
    input2.addEventListener('input',function(){
    if (this.value.length > 10) 
        this.value = this.value.slice(0,10); 
    })

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