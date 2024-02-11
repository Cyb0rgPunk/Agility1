<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection();?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Pasajero</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Pasajero</li>
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
                <form method="post" action="<?php echo base_url(session('group_name').'/CargaPasajeros')?>"
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
                    <h3 class="card-title">Agregar un pasajero - Datos Pasajero</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url('admin/SavePasajero')?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="id_cliente">Cliente</label>
                                    <select id="id_cliente" class="form-control" name="id_cliente" disabled>
                                        <option value="1" class="">Avianca</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_documento">Tipo Documento</label>
                                    <select id="tipo_documento" class="form-control" name="tipo_documento" required>
                                        <option value="1" class="">Cedula cidudadania</option>
                                        <option value="2" class="">Cedula extranjera</option>
                                        <option value="3" class="">NIT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="primer_nombre">Primer Nombre</label>
                                    <input id="primer_nombre" class="form-control" type="text" name="primer_nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="primer_apellido">Primer Apellido</label>
                                    <input id="primer_apellido" class="form-control" type="text" name="primer_apellido" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico</label>
                                    <input id="email" class="form-control" type="text" name="email" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="centro_costo">Centro de costo</label>
                                    <select id="centro_costo" class="form-control select2 select2bs4" style="width: 100%;" name="centro_costo" required>
                                        <?php foreach ($centros_costos as $centro_costo): ?>
                                        <?php echo '<option value='.$centro_costo['codigo'].'>'.$centro_costo['codigo'].' - '.$centro_costo['nombre'].'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="direccion">Dirección</label>
                                        <input id="direccion" class="form-control" type="text" name="direccion" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="celular">Celular</label>
                                        <input id="celular" class="form-control" type="number" name="celular" required>
                                    </div>
                                </div>                              

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documento">Documento / Identifiación </label>
                                    <input id="documento" class="form-control" type="number" name="id_nacional" required>
                                </div>
                                <div class="form-group">
                                    <label for="segundo_nombre">Segundo Nombre</label>
                                    <input id="segundo_nombre" class="form-control" type="text" name="segundo_nombre" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="segundo_apellido">Segundo Apellido</label>
                                    <input id="segundo_apellido" class="form-control" type="text" name="segundo_apellido" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" class="form-control" type="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="cargo">Cargo</label>
                                    <input id="cargo" class="form-control" type="text" name="cargo" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="observaciones">Observaciones</label>
                                    <textarea name="observaciones" rows="5" class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer ">
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
                            <h3 class="card-title">Lista Pasajeros</h3>
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
                                        <th>ID Nacional</th>
                                        <th>Celular</th>
                                        <th>Dirección</th>
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
                                                echo "Avianca"
                                            ?>
                                        </td>
                                        <td><?php echo $pasajero['primer_nombre']?><?php echo "  ".$pasajero['segundo_nombre']?>
                                        </td>
                                        <td><?php echo $pasajero['primer_apellido']?><?php echo "  ".$pasajero['segundo_apellido']?>
                                        </td>
                                        <td><?php echo $pasajero['id_nacional']?></td>
                                        <td><?php echo $pasajero['celular']?></td>
                                        <td><?php echo $pasajero['direccion']?></td>
                                        <td><?php echo $pasajero['centro_costo']?></td>
                                        <td>
                                            <a href="<?=site_url(session('group_name').'/EditPasajero/'.$pasajero['id_pasajero']);?>"
                                                class="btn btn-primary" type="button">Editar</a>
                                            <a href="<?=site_url(session('group_name').'/DeletePasajero/'.$pasajero['id_pasajero']);?>"
                                                class="btn btn-danger" type="button">Eliminar</a>
                                            <!--a href="<?=site_url(session('group_name').'/BlockPasajero/'.$pasajero['id_pasajero']);?>"
                                                class="btn btn-danger" type="button">Bloquear</a-->
                                            
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
    <!-- Select2 -->
    <script src="<?=base_url()?>/public/plugins/select2/js/select2.full.min.js"></script>                               
    
    <script>
               
        $(function() {            
             //Initialize Select2 Elements
            $('.select2').select2()
            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        

            var input = document.getElementById('celular');
            input.addEventListener('input', function() {
                if (this.value.length > 10)
                    this.value = this.value.slice(0, 10);
            })

            var input2 = document.getElementById('documento');
            input2.addEventListener('input', function() {
                if (this.value.length > 10)
                    this.value = this.value.slice(0, 10);
            })

            $("#tableUsers").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');
        });
    </script>
<?= $this->endSection();?>