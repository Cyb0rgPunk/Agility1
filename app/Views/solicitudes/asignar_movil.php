<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->

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
            <h1>Solicitudes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo base_url('/')?>">Home</a></li>
                <li class="breadcrumb-item active">Solicitudes</li>
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

            <!-- general form elements pasajero -->
            <div class="card card-primary"
                <?php if(session('group_name')=='solicitud'){ echo "style='display: none;'";}?>>
                <div class="card-header">
                    <h3 class="card-title">Datos Solicitante</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="id_cliente">Cliente</label>
                                <select id="id_cliente" class="form-control" name="id_cliente" disabled>
                                    <option value="1" <?php if($solicitud[0]['id_cliente'] == '1'){ echo "selected"; }?>
                                        class="">
                                        Compensar</option>
                                    <option value="2" <?php if($solicitud[0]['id_cliente'] == '2'){ echo "selected"; }?>
                                        class="">
                                        Avianca</option>
                                </select>
                                <input type="hidden" name="id_cliente" value='<?= $solicitud[0]['id_cliente'] ?>'>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_documento">Grupo</label>
                                <select id="tipo_documento" class="form-control" name="tipo_documento" disabled>
                                    <option value="1"
                                        <?php if($solicitud[0]['tipo_documento'] == '1'){ echo "selected"; }?> class="">
                                        Cedula cidudadania</option>
                                    <option value="2"
                                        <?php if($solicitud[0]['tipo_documento'] == '2'){ echo "selected"; }?> class="">
                                        Cedula extranjera</option>
                                    <option value="3"
                                        <?php if($solicitud[0]['tipo_documento'] == '3'){ echo "selected"; }?> class="">
                                        NIT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="primer_nombre">Primer Nombre</label>
                                <input id="primer_nombre" class="form-control" type="text" name="primer_nombre"
                                    value="<?= $solicitud[0]['primer_nombre'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="primer_apellido">Primer Apellido</label>
                                <input id="primer_apellido" class="form-control" type="text" name="primer_apellido"
                                    value="<?= $solicitud[0]['primer_apellido'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electronico</label>
                                <input id="email" class="form-control" type="text" name="email"
                                    value="<?= $solicitud[0]['email'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="centro_costo">Centro de costo</label>
                                <input id="centro_costo" class="form-control" type="text" name="centro_costo"
                                    value="<?= $solicitud[0]['centro_costo'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="sucursal">Sucursal</label>
                                <input id="sucursal" class="form-control" type="text" name="sucursal"
                                    value="<?= $solicitud[0]['sucursal'] ?>" disabled>
                            </div>


                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="documento">Documento / Identifiación </label>
                                <input id="documento" class="form-control" type="text" name="documento"
                                    value="<?= $solicitud[0]['documento'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="segundo_nombre">Segundo Nombre</label>
                                <input id="segundo_nombre" class="form-control" type="text" name="segundo_nombre"
                                    value="<?= $solicitud[0]['segundo_nombre'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="segundo_apellido">Segundo Apellido</label>
                                <input id="segundo_apellido" class="form-control" type="text" name="segundo_apellido"
                                    value="<?= $solicitud[0]['segundo_apellido'] ?>" disabled>
                            </div>

                            <div class="form-group">
                                <label for="cargo">Cargo</label>
                                <input id="cargo" class="form-control" type="text" name="cargo"
                                    value="<?= $solicitud[0]['cargo'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="area">Area</label>
                                <input id="area" class="form-control" type="text" name="area"
                                    value="<?= $solicitud[0]['area'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="observaciones">Observaciones</label>
                                <input id="observaciones" class="form-control" type="text" name="observaciones"
                                    value="<?= $solicitud[0]['observaciones'] ?>" disabled>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

            <!-- general form elements servicio-->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Datos Servicio</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo_vehiculo">Tipo vehiculo</label>
                                <select id="tipo_vehiculo" class="form-control" name="tipo_vehiculo" required>
                                    <option value="1" class="">Camioneta</option>
                                    <option value="2" class="">Doble Cabina</option>
                                    <option value="3" class="">Minivan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_operacion">Operación</label>
                                <select id="id_operacion" class="form-control" name="id_operacion" disabled>
                                    <option value="1" class="">Individual</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="origen">Dirección Orgien</label>
                                <input type="text" class="form-control" name='origen'
                                    value="<?= $solicitud[0]['origen'] ?>" disabled
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="form-group">
                                <label for="destino">Dirección Destino</label>
                                <input type="text" class="form-control" name='destino'
                                    value="<?= $solicitud[0]['destino'] ?>" disabled
                                    onkeyup="javascript:this.value=this.value.toUpperCase();">
                            </div>
                            <div class="form-group">
                                <label for="id_tipo_servicio">Tipo Servicio</label>
                                <select class="form-control " data-val="true" data-val-required="(*)Campo requerido"
                                    id="ddlServiceType" name="id_tipo_servicio" disabled>
                                    <option value="1"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '1'){ echo "selected"; }?>
                                        class="">
                                        1 Hora - Bogotá
                                    </option>
                                    <option value="2"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '2'){ echo "selected"; }?>
                                        class="">
                                        4 Horas de Espera - Bogotá
                                    </option>
                                    <option value="3"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '3'){ echo "selected"; }?>
                                        class="">
                                        4 Horas Disponible - Bogotá
                                    </option>
                                    <option value="4"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '4'){ echo "selected"; }?>
                                        class="">
                                        6 Horas de Espera - Bogotá
                                    </option>
                                    <option value="5"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '5'){ echo "selected"; }?>
                                        class="">
                                        6 Horas Disponible - Bogotá
                                    </option>
                                    <option value="6"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '6'){ echo "selected"; }?>
                                        class="">
                                        12 Horas de Espera - Bogotá
                                    </option>
                                    <option value="7"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '7'){ echo "selected"; }?>
                                        class="">
                                        12 Horas Disponible - Bogotá
                                    </option>
                                    <option value="8"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '8'){ echo "selected"; }?>
                                        class="">
                                        12 Horas de Espera - Sumapaz
                                    </option>
                                    <option value="9"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '9'){ echo "selected"; }?>
                                        class="">
                                        12 Horas Disponible - Sumapaz
                                    </option>
                                    <option value="10"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '10'){ echo "selected"; }?>
                                        class="">
                                        4 Horas de Espera - Zona 1
                                    </option>
                                    <option value="11"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '11'){ echo "selected"; }?>
                                        class="">
                                        4 Horas Disponible - Zona 1
                                    </option>
                                    <option value="12"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '12'){ echo "selected"; }?>
                                        class="">
                                        6 Horas de Espera - Zona 1
                                    </option>
                                    <option value="13"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '13'){ echo "selected"; }?>
                                        class="">
                                        6 Horas Disponible - Zona 1
                                    </option>
                                    <option value="14"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '14'){ echo "selected"; }?>
                                        class="">
                                        12 Horas de Espera - Zona 1
                                    </option>
                                    <option value="15"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '15'){ echo "selected"; }?>
                                        class="">
                                        12 Horas Disponible - Zona 1
                                    </option>
                                    <option value="16"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '16'){ echo "selected"; }?>
                                        class="">
                                        12 Horas de Espera - Zona 2
                                    </option>
                                    <option value="17"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '17'){ echo "selected"; }?>
                                        class="">
                                        12 Horas Disponible - Zona 2
                                    </option>
                                    <option value="18"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '18'){ echo "selected"; }?>
                                        class="">
                                        12 Horas de Espera - Zona 3
                                    </option>
                                    <option value="19"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '19'){ echo "selected"; }?>
                                        class="">
                                        12 Horas Disponible - Zona 3
                                    </option>
                                    <option value="20"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '20'){ echo "selected"; }?>
                                        class="">
                                        1 trayecto – Zona 1
                                    </option>
                                    <option value="21"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '21'){ echo "selected"; }?>
                                        class="">
                                        1 sin espera – Zona 2
                                    </option>
                                    <option value="22"
                                        <?php if($solicitud[0]['id_tipo_servicio'] == '22'){ echo "selected"; }?>
                                        class="">
                                        1 sin espera – Zona 3
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="evento">Evento</label>
                                <input type="text" class="form-control" name='evento'
                                    value="<?= $solicitud[0]['evento']?>" disabled>
                            </div>
                            <div class="form-group">
                                <label for="origen">Cantidad Pasajeros</label>
                                <input type="number" class="form-control" name='cantidad_personas' max="100"
                                    value="<?= $solicitud[0]['cantidad_personas']?>" disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_ciudad">Ciudad</label>
                                <select id="id_ciudad" class="form-control" name="id_ciudad" disabled>
                                    <option value="1" <?php if($solicitud[0]['id_ciudad'] == '1'){ echo "selected"; }?>
                                        class="">
                                        Bogotá</option>
                                    <option value="2" <?php if($solicitud[0]['id_ciudad'] == '2'){ echo "selected"; }?>
                                        class="">
                                        Medellin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Fecha y Hora del Servicio</label><br>
                                <input type="text" class="form-control"
                                    value="<?= $timestamp = date('m/d/Y g:i A',strtotime($solicitud[0]['fecha_hora'])); ?>"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label for="id_zona_origen">Zona Origen</label>
                                <select id="id_zona_origen" class="form-control" name="id_zona_origen" disabled>
                                    <option value="1"
                                        <?php if($solicitud[0]['id_zona_origen'] == '1'){ echo "selected"; }?> class="">
                                        Bogotá
                                    </option>
                                    <option value="2"
                                        <?php if($solicitud[0]['id_zona_origen'] == '2'){ echo "selected"; }?> class="">
                                        Zona 1
                                    </option>
                                    <option value="3"
                                        <?php if($solicitud[0]['id_zona_origen'] == '3'){ echo "selected"; }?> class="">
                                        Zona 2
                                    </option>

                                    <option value="4"
                                        <?php if($solicitud[0]['id_zona_origen'] == '4'){ echo "selected"; }?> class="">
                                        Zona 3
                                    </option>
                                    <option value="5"
                                        <?php if($solicitud[0]['id_zona_origen'] == '5'){ echo "selected"; }?> class="">
                                        Sumapaz
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="id_zona_destino">Zona Destino</label>
                                <select id="id_zona_destino" class="form-control" name="id_zona_destino" disabled>
                                    <option value="1"
                                        <?php if($solicitud[0]['id_zona_destino'] == '1'){ echo "selected"; }?>
                                        class="">
                                        Bogotá
                                    </option>
                                    <option value="2"
                                        <?php if($solicitud[0]['id_zona_destino'] == '2'){ echo "selected"; }?>
                                        class="">
                                        Zona 1
                                    </option>
                                    <option value="3"
                                        <?php if($solicitud[0]['id_zona_destino'] == '3'){ echo "selected"; }?>
                                        class="">
                                        Zona 2
                                    </option>

                                    <option value="4"
                                        <?php if($solicitud[0]['id_zona_destino'] == '4'){ echo "selected"; }?>
                                        class="">
                                        Zona 3
                                    </option>
                                    <option value="5"
                                        <?php if($solicitud[0]['id_zona_origen'] == '5'){ echo "selected"; }?> class="">
                                        Sumapaz
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="observacion">Observacion</label>
                                    <textarea id="observacion" class="form-control" name="observacion" rows="5"
                                        disabled><?= $solicitud[0]['observacion']?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="centro_costo">Centro de costo</label>
                                <input type="text" class="form-control" name='centro_costo'
                                    value="<?= $solicitud[0]['centro_costo']?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- general form elements movil-->
            <!-- form start -->
            <form method="POST" action="<?= site_url(session('group_name').'/ConfirmaAsignarMovil')?>">
                <div class="card card-primary">

                    <div class="card-header">
                        <h3 class="card-title">Asignar Movil</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->


                    <div class="card-body">
                        <input type="hidden" name="id_solicitud" value="<?= $solicitud[0]['id_solicitud']?>">
                        <div class="row">

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

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_conductor">Conductor</label>
                                    <select id="id_conductor" class="form-control select2 select2bs4" name="id_conductor"
                                        required>
                                        <?php foreach ($conductores as $conductor): ?>
                                        <?php echo '<option value='.$conductor['id_conductor'].'>'.$conductor['nombre'].' - '.$conductor['identification'].'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_tarifa">Tarifa</label>
                                    <select id="id_tarifa" class="form-control select2 select2bs4" name="id_tarifa"
                                        required>
                                        <?php foreach ($tarifas as $tarifa): ?>
                                        <?php
                                            setlocale(LC_MONETARY, 'co_CO');

                                            echo '<option value='.$tarifa['id_tarifa'].'>'.$tarifa['codigo'].' - '.$tarifa['descripcion'].' - $'.number_format($tarifa['tarifa'],0).'</option>' ?>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>


                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Asignar movil</button>
                    </div>

                </div>


        </div>
        <!-- /.card -->
        </form>
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

    //Initialize Select2 Elements
    $('.select2').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })

    var dateToday = new Date();
    $('#reservationdatetime').datetimepicker({

        setDate: '<?= $timestamp = date('m/d/Y g:i A',strtotime($solicitud[0]['fecha_hora'])); ?>',
        icons: {
            time: 'far fa-clock'
        },
        inline: true,
        sideBySide: true

    });



    $("#tableUsers").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');
});
</script>
<?= $this->endSection();?>