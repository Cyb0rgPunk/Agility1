<?= $this->extend('templates/session');?>
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
                    <h3 class="card-title">Editar Datos Usuario</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url('admin/UpdateUser')?>">
                    <input id="id_user" class="form-control" type="hidden" name="id_user" value="<?=$user['id_user']?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input id="user" class="form-control" type="text" name="user"
                                        value="<?=$user['user']?>" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Celular</label>
                                    <input id="phone" class="form-control" type="number" name="phone"
                                        value="<?=$user['phone']?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="group">Grupo</label>
                                    <select id="group" class="form-control" name="group">
                                        <?php foreach ($grupos as $grupo): 
                                            if($grupo['id_group'] == $user['group'] ){
                                                $selected='selected';
                                            }else{
                                                $selected = '';    
                                            }      
                                        ?>
                                        <?php echo '<option value='.$grupo['id_group'].'" '.$selected.'  >'.$grupo['description'].'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Correo</label>
                                    <input id="email" class="form-control" type="text" name="email" onkeyup="javascript:this.value=this.value.toUpperCase();" value="<?=$user['email']?>">
                                </div>
                                <div class="form-group">
                                    <label for="password">Contraseña</label>
                                    <input id="password" class="form-control" type="text" name="password">
                                    <input id="password" class="form-control" type="hidden" name="old_password"  value="<?=$user['password']?>">
                                </div>
                                <div class="form-group">
                                    <label for="identification">Cedula</label>
                                    <input id="identification" class="form-control" type="text" name="identification" value="<?=$user['identification']?>" required>
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
    <script>

    var input=  document.getElementById('phone');
    input.addEventListener('input',function(){
    if (this.value.length > 10) 
        this.value = this.value.slice(0,10); 
    })

    </script>
<?= $this->endSection();?>