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
            <h1>Tarifa Adicional</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Tarifa Adicional</li>
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
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tarifa Adicional</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="<?= site_url('admin/SaveTarifaAdicional')?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id_solicitud" value="<?= $id_solicitud?>">
                                <input type="hidden" name="solicita" value="<?= $solicita?>">
                                <div class="form-group">
                                    <label for="id_tarifa">Tarifa</label>
                                    <select id="id_tarifa" class="form-control select2 select2bs4" name="id_tarifa"
                                        required>
                                        <?php foreach ($tarifas as $tarifa): ?>
                                        <?php
                                            echo '<option value='.$tarifa['id_tarifa'].'>'.$tarifa['codigo'].' - '.$tarifa['descripcion'].' - $'.number_format($tarifa['tarifa'],0).'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Motivo</label>
                                    <textarea class='form-control' name="motivo" id="" rows="5"></textarea>
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
        <div class="col-md-3"></div>
    </div>
</div>
<div class="container-fluid">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Tarifas adicionales de las solicitud</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="tableUsers" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <!--th>Id</th-->
                                        <th>Codigo</th>
                                        <th>Descripcion</th>
                                        <th>Motivo</th>
                                        <th>Valor</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($tarifas_adicionales as $tarifa_a): ?>
                                    <tr>
                                        <!--td><?php echo $tarifa_a['id_tarifa_adicional']?></td-->
                                        <td><?php echo $tarifa_a['codigo']?></td>
                                        <td><?php echo $tarifa_a['descripcion']?></td>
                                        <td><?php echo $tarifa_a['motivo']?></td>
                                        <td><?php echo '$'.number_format($tarifa_a['tarifa'])?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <!-- /.card-footer -->
                        <div class="card-footer">
                            <h3 class="card-title">Total:  <b>$ <?= number_format($tarifa_total[0]['tarifa'])?></b></h3>
                        </div>
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
            //"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');
    });
    </script>
<?= $this->endSection();?>