<?= $this->extend('templates/session');?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar datos pasajero</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Editar datos pasajero</li>
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
                    <h3 class="card-title">Datos Pasajero</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url('admin/UpdatePasajero')?>">
                    <input type="hidden" name="id_pasajero" value="<?= $pasajero['id_pasajero']?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="id_cliente">Cliente</label>
                                    <select id="id_cliente" class="form-control" name="id_cliente" disabled>
                                        <option value="1" <?php if($pasajero['id_cliente'] == '1'){ echo "selected"; }?> class="">Avianca</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_documento">Tipo Documento</label>
                                    <select id="tipo_documento" class="form-control" name="tipo_documento">
                                        <option value="1" <?php if($pasajero['tipo_documento'] == '1'){ echo "selected"; }?> class="">Cedula cidudadania</option>
                                        <option value="2" <?php if($pasajero['tipo_documento'] == '2'){ echo "selected"; }?> class="">Cedula extranjera</option>
                                        <option value="3" <?php if($pasajero['tipo_documento'] == '3'){ echo "selected"; }?> class="">NIT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="primer_nombre">Primer Nombre</label>
                                    <input id="primer_nombre" class="form-control" type="text" name="primer_nombre" value="<?= $pasajero['primer_nombre'] ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                <div class="form-group">
                                    <label for="primer_apellido">Primer Apellido</label>
                                    <input id="primer_apellido" class="form-control" type="text" name="primer_apellido" value="<?= $pasajero['primer_apellido'] ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                <div class="form-group">
                                    <label for="correo">Correo Electronico</label>
                                    <input id="correo" class="form-control" type="text" name="correo" value="<?= $pasajero['correo'] ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                <div class="form-group">
                                    <label for="centro_costo">Centro de costo</label>
                                    <input id="centro_costo" class="form-control" type="text" name="centro_costo" value="<?= $pasajero['centro_costo'] ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documento">Id Nacional </label>
                                    <input id="documento" class="form-control" type="number" name="id_nacional" value="<?= $pasajero['id_nacional'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="segundo_nombre">Segundo Nombre</label>
                                    <input id="segundo_nombre" class="form-control" type="text" name="segundo_nombre" value="<?= $pasajero['segundo_nombre'] ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                <div class="form-group">
                                    <label for="segundo_apellido">Segundo Apellido</label>
                                    <input id="segundo_apellido" class="form-control" type="text" name="segundo_apellido" value="<?= $pasajero['segundo_apellido'] ?>" onkeyup="javascript:this.value=this.value.toUpperCase();">
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" class="form-control" type="text" name="password">
                                    <input id="password" class="form-control" type="hidden" name="old_password"  value="<?=$pasajero['password']?>">
                                </div>
                                <div class="form-group">
                                    <label for="celular">Celular</label>
                                    <input id="celular" class="form-control" type="number" name="celular" value="<?= $pasajero['celular'] ?>">
                                </div> 
                                    
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                                    <label for="direccion">Direccion</label>
                                    <input id="direccion" class="form-control" type="text" name="direccion" value="<?= $pasajero['direccion'] ?>">
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer ">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<?= $this->endSection();?>
