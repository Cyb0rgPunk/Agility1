<?= $this->extend('templates/session');?>
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
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos Movil</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url('admin/UpdateMovil')?>">
                    <input type="hidden" class="" name='id_movil' value='<?= $movil['id_movil']?>'>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="movil">Movil</label>
                                    <input id="movil" class="form-control" type="number" name="movil"
                                        value="<?= $movil['movil'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="tipo_vehiculo">Tipo vehiculo</label>
                                    <select id="tipo_vehiculo" class="form-control" name="tipo_vehiculo">
                                        <option value="1" <?php if($movil['tipo_vehiculo'] == '1'){ echo "selected"; }?>
                                            class="">Microbus</option>
                                        <option value="2" <?php if($movil['tipo_vehiculo'] == '2'){ echo "selected"; }?>
                                            class="">Van</option>
                                        <option value="3" <?php if($movil['tipo_vehiculo'] == '3'){ echo "selected"; }?>
                                            class="">Campero</option>
                                        <option value="4" <?php if($movil['tipo_vehiculo'] == '4'){ echo "selected"; }?>
                                            class="">Camioneta D/C</option>
                                        <option value="5" <?php if($movil['tipo_vehiculo'] == '5'){ echo "selected"; }?>
                                            class="">Automovil</option>    
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="capacidad">Capacidad</label>
                                    <input type="number" class="form-control" name='capacidad'
                                        value="<?= $movil['capacidad'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="marca">Marca</label>
                                    <input type="text" class="form-control" name='marca' value="<?= $movil['marca'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="observaciones">Observacion</label>
                                    <textarea name="observaciones" rows="5" class='form-control'
                                        id="observaciones"><?= $movil['observaciones'] ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="placa">Placa</label>
                                    <input id="placa" class="form-control" type="text" name="placa"
                                        value="<?= $movil['placa'] ?>">
                                </div>
                                <div class="form-group">
                                    <label for="estado">Estado</label>
                                    <select id="estado" class="form-control" name="estado">
                                        <option value="1" <?php if($movil['estado'] == '1'){ echo "selected"; }?>
                                            class="">Activo</option>
                                        <option value="2" <?php if($movil['estado'] == '2'){ echo "selected"; }?>
                                            class="">Retirado</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_flota">Tipo flota</label>
                                    <select id="tipo_flota" class="form-control" name="tipo_flota">
                                        <option value="1" <?php if($movil['tipo_flota'] == '1'){ echo "selected"; }?>
                                            class="">Propio</option>
                                        <option value="2" <?php if($movil['tipo_flota'] == '2'){ echo "selected"; }?>
                                            class="">Socio</option>
                                        <option value="3" <?php if($movil['tipo_flota'] == '3'){ echo "selected"; }?>
                                            class="">Afiliado</option>
                                        <option value="4" <?php if($movil['tipo_flota'] == '4'){ echo "selected"; }?>
                                            class="">Convenio</option>
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
                                        value="<?= $movil['modelo'] ?>">
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
<?= $this->endSection();?>
<?= $this->section('scripts');?>

<script>
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