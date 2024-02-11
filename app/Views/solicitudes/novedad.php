<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
</script>
<?= $this->endSection();?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Finalizacion y novedades del servicio.</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Finalizacion y novedades</li>
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
            <form method="POST" action="<?= site_url(session('group_name').'/UpdateNovedad')?>">
                <!-- general form elements pasajero -->
                <div class="card card-primary"
                    <?php if(session('group_name')=='pasajero'){ echo "style='display: none;'";}?>>
                    <div class="card-header">
                        <h3 class="card-title">Novedades del viaje</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <input type="hidden" name="tipo_solicitud" value="<?= @$tipo_solicitud?>">
                    <input type="hidden" name="id_solicitud" value="<?= @$id_solicitud?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="id_novedad">Seleccione novedad</label>
                                    <select id="id_novedad" class="form-control" name="id_novedad">
                                        <?php 
                                            foreach (NOVEDADES as $key => $value) {
                                                echo "<option value = ".$key.">".$value."</option>";
                                            }
                                        ?>
                                    </select>

                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-danger">Finalizar viaje</button>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>


            </form>
        </div>


    </div>


</div>
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
    var hoy = new Date();
    var hora = hoy.getHours() + ':' + hoy.getMinutes() + ':' + hoy.getSeconds();
    //alert(hoy.getHours());

    var nextDay = new Date(hoy)
    nextDay.setDate(hoy.getDate() + 1);
    availableDate = nextDay
    disableDate = []

    if (hoy.getHours() >= 15) {
        //$('#modal-danger').modal('show');
        disableDate = [hoy, nextDay]
        availableDate = nextDay
    }

    var dateToday = new Date();
    $('#reservationdatetime').datetimepicker({
        minDate: availableDate,
        icons: {
            time: 'far fa-clock'
        },
        inline: true,
        sideBySide: true,
        disabledDates: disableDate
    });

    $("#tableUsers").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');

    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
});
</script>
<?= $this->endSection();?>