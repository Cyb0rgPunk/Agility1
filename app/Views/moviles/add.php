<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
</script>
<?= $this->endSection();?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Moviles</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Moviles</li>
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
                <form method="post" action="<?php echo base_url(session('group_name').'/UploadMoviles')?>"
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
                    <h3 class="card-title">Datos Movil</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url('admin/SaveMovil')?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="movil">Movil</label>
                                    <input id="movil" class="form-control" type="number" name="movil">
                                </div>
                                <div class="form-group">
                                    <label for="tipo_vehiculo">Tipo vehiculo</label>
                                    <select id="tipo_vehiculo" class="form-control" name="tipo_vehiculo">
                                        <option value="1" class="">Microbus</option>
                                        <option value="2" class="">Van</option>
                                        <option value="3" class="">Campero</option>
                                        <option value="4" class="">Camioneta D/C</option>
                                        <option value="5" class="">Automovil</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="capacidad">Capacidad</label>
                                    <input type="number" class="form-control" name='capacidad'>
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" class="form-control" name='marca'
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="observaciones">Observacion</label>
                                    <textarea name="observaciones" class='form-control' rows="5" id="observaciones"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="placa">Placa</label>
                                    <input id="placa" class="form-control" type="text" name="placa"
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select id="estado" class="form-control" name="estado">
                                        <option value="1" class="">Activo</option>
                                        <option value="2" class="">Retirado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_flota">Tipo flota</label>
                                    <select id="tipo_flota" class="form-control" name="tipo_flota">
                                        <option value="1" class="">Propio</option>
                                        <option value="2" class="">Socio</option>
                                        <option value="3" class="">Afiliado</option>
                                        <option value="4" class="">Convenio</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_empresa">Empresa</label>
                                    <select id="id_empresa" class="form-control" name="id_empresa">
                                        <option value="1" class="">Lidertur</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="modelo">Modelo</label>
                                    <input type="text" class="form-control" name='modelo'
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input type="number" class="form-control" name='celular' id='celular' required>
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
                            <h3 class="card-title">Lista Moviles</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableUsers" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Movil</th>
                                        <th>Placa</th>
                                        <th>Tipo vehiculo</th>
                                        <th>Estado</th>
                                        <th>Capacidad</th>

                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Observacion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($moviles as $movil):
                                        
                                        //$movil['tipo_vehiculo'] = $movil['tipo_vehiculo'] ;
                                        ?>
                                         
                                    <tr>
                                        <td><?php echo $movil['id_movil']?></td>
                                        <td><?php echo $movil['movil']?></td>
                                        <td><?php echo $movil['placa']?></td>
                                        <td>
                                            <?php 
                                                //dd($movil['tipo_vehiculo']);
                                                 if(!is_int($movil['tipo_vehiculo'])){
                                                    if($movil['tipo_vehiculo'] == 1){echo "Microbus";}
                                                    if($movil['tipo_vehiculo'] == 2){echo "Van";}
                                                    if($movil['tipo_vehiculo'] == 3){echo "Campero";}
                                                    if($movil['tipo_vehiculo'] == 4){echo "Camioneta D/C";}
                                                    if($movil['tipo_vehiculo'] == 5){echo "Automovil";}
                                                 }

                                                 if(is_string($movil['tipo_vehiculo'])){
                                                    //echo $movil['tipo_vehiculo'];
                                                 }



                                                /*if($movil['tipo_vehiculo'] == 1){echo "Microbus";}
                                                if($movil['tipo_vehiculo'] == 2){echo "Van";}
                                                if($movil['tipo_vehiculo'] == 3){echo "Campero";}
                                                if($movil['tipo_vehiculo'] == 4){echo "Camioneta D/C";}
                                                if($movil['tipo_vehiculo'] == 5){echo "Automovil";}

                                                $movil['tipo_vehiculo'] = '';

                                                if($movil['tipo_vehiculo']  == ''){
                                                    $movil['tipo_vehiculo'];
                                                }*/


                                                
                                            ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if($movil['estado'] == 1){echo "Activo";}
                                                if($movil['estado'] == 2){echo "Retirado";}                                                
                                            ?>
                                        </td>
                                        <td><?php echo $movil['capacidad']?></td>

                                        <td><?php echo $movil['marca']?></td>
                                        <td><?php echo $movil['modelo']?></td>
                                        <td><?php echo $movil['observaciones']?></td>
                                        <td>
                                            <a href="<?=site_url('admin/EditMovil/'.$movil['id_movil']);?>"
                                                class="btn btn-primary" type="button">Editar</a>
                                            <a href="<?=site_url('admin/DeleteMovil/'.$movil['id_movil']);?>"
                                                class="btn btn-danger" type="button">Eliminar</a>
                                            <!--a href="<?=site_url('admin/BlockMovil/'.$movil['id_movil']);?>"
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

<script>

$(function() {
    $("#tableUsers").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');
});


    var input = document.getElementById('celular');
    input.addEventListener('input', function() {
        if (this.value.length > 10)
            this.value = this.value.slice(0, 10);
    })
    
    var input2 = document.getElementById('identification');
    input2.addEventListener('input', function() {
        if (this.value.length > 10)
            this.value = this.value.slice(0, 10);
    })

</script>
<?= $this->endSection();?>