<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</script>
<?= $this->endSection();?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Sub zonas</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Sub zonas</li>
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
                    <h3 class="card-title">Datos Sub Zona</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url(session('group_name').'/UpdateSubZona')?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" name="id_sub_zona" value="<?= $sub_zona['id_sub_zona']?>">
                                    <label for="nombre">Zona </label>
                                    <select id="id_zona" class="form-control select2 select2bs4" name="id_zona" required>
                                    <?php
                                        //dd(ZONAS);
                                        $zonas = ZONAS;
                                        $selected = '';
                                        foreach($zonas as $zona){
                                            if($zona['id_zona'] == $sub_zona['id_zona']){
                                                $selected = 'selected';
                                            }
                                            echo "<option value='".$zona['id_zona']."' ".$selected.">".$zona['nombre']."</option>";
                                    ?>                                        
                                    <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Nombre Sub Zona</label>
                                    <input id="nombre" class="form-control" type="text" name="nombre" value="<?= $sub_zona['nombre']?>"required>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="descripcion">Descripción Sub Zona</label>
                                    <textarea class="form-control" name="descripcion" id="" cols="5" rows="3"><?= $sub_zona['descripcion']?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->




        </div>
    </div>
</div>
<?= $this->endSection();?>
<?= $this->section('scripts');?>

<!-- Select2 -->
<script src="<?=base_url()?>/public/plugins/select2/js/select2.full.min.js"></script>

<?= $this->endSection();?>