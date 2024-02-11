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
            <h1>Usuarios</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Usuarios</li>
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
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos Usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url('admin/SaveUser')?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input id="user" class="form-control" type="text" name="user"  onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Celular</label>
                                    <input id="phone" class="form-control" type="number" name="phone" required>
                                </div>
                                <div class="form-group">
                                    <label for="group">Grupo</label>
                                    <select id="group" class="form-control" name="group" required>
                                        <?php foreach ($grupos as $grupo): 
                                        if($grupo['id_group'] == 4  OR $grupo['id_group'] == 5){
                                            continue;
                                        }
                                        
                                        ?>

                                        <?php echo '<option value='.$grupo['id_group'].'>'.$grupo['description'].'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input id="email" class="form-control" type="email" name="email" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" class="form-control" type="text" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="identification">Cedula</label>
                                    <input id="identification" class="form-control" type="number" name="identification" required>
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
                            <h3 class="card-title">Lista Usuarios</h3>
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
                                            <a href="<?=site_url('admin/EditUser/'.$user['id_user']);?>"
                                                class="btn btn-primary" type="button">Editar</a>
                                            <a href="<?=site_url('admin/DeleteUser/'.$user['id_user']);?>"
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