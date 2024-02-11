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
            <form method="POST" action="<?= site_url('admin/SaveSolicitud')?>">
                <!-- general form elements pasajero -->
                <div class="card card-primary"
                    <?php if(session('group_name')=='pasajero'){ echo "style='display: none;'";}?>>
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
                    <input type="hidden" name="id_pasajero" value="<?= $pasajero['id_pasajero']?>">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="id_cliente">Cliente</label>
                                    <select id="id_cliente" class="form-control" name="id_cliente" disabled>
                                        <option value="1" <?php if($pasajero['id_cliente'] == '1'){ echo "selected"; }?>
                                            class="">Compensar</option>
                                        <option value="2" <?php if($pasajero['id_cliente'] == '2'){ echo "selected"; }?>
                                            class="">Avianca</option>
                                    </select>
                                    <input type="hidden" name="id_cliente" value='<?= $pasajero['id_cliente'] ?>'>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tipo_documento">Grupo</label>
                                    <select id="tipo_documento" class="form-control" name="tipo_documento" disabled>
                                        <option value="1"
                                            <?php if($pasajero['tipo_documento'] == '1'){ echo "selected"; }?> class="">
                                            Cedula cidudadania</option>
                                        <option value="2"
                                            <?php if($pasajero['tipo_documento'] == '2'){ echo "selected"; }?> class="">
                                            Cedula extranjera</option>
                                        <option value="3"
                                            <?php if($pasajero['tipo_documento'] == '3'){ echo "selected"; }?> class="">
                                            NIT</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="primer_nombre">Primer Nombre</label>
                                    <input id="primer_nombre" class="form-control" type="text" name="primer_nombre"
                                        value="<?= $pasajero['primer_nombre'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="primer_apellido">Primer Apellido</label>
                                    <input id="primer_apellido" class="form-control" type="text" name="primer_apellido"
                                        value="<?= $pasajero['primer_apellido'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="email">Correo Electronico</label>
                                    <input id="email" class="form-control" type="text" name="email"
                                        value="<?= $pasajero['email'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="centro_costo">Centro de costo</label>
                                    <input id="centro_costo" class="form-control" type="text" name="centro_costo"
                                        value="<?= $pasajero['centro_costo'] ?>" disabled>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="documento">Documento / Identifiación </label>
                                    <input id="documento" class="form-control" type="text" name="documento"
                                        value="<?= $pasajero['documento'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="segundo_nombre">Segundo Nombre</label>
                                    <input id="segundo_nombre" class="form-control" type="text" name="segundo_nombre"
                                        value="<?= $pasajero['segundo_nombre'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="segundo_apellido">Segundo Apellido</label>
                                    <input id="segundo_apellido" class="form-control" type="text"
                                        name="segundo_apellido" value="<?= $pasajero['segundo_apellido'] ?>" disabled>
                                </div>

                                <div class="form-group">
                                    <label for="cargo">Cargo</label>
                                    <input id="cargo" class="form-control" type="text" name="cargo"
                                        value="<?= $pasajero['cargo'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="observaciones">Observaciones</label>
                                    <input id="observaciones" class="form-control" type="text" name="observaciones"
                                        value="<?= $pasajero['observaciones'] ?>" disabled>
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
                                    <select id="id_operacion" class="form-control" name="id_operacion" required>
                                        <option value="1" class="">Individual</option>
                                        <option value="2" class="">Ruta</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="vuelo">Vuelo</label>
                                    <input type="text" class="form-control" name='vuelo'
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                
                                <div class="form-group">
                                    <label for="origen">Dirección Origen</label>
                                    <input type="text" class="form-control" name='origen'
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="destino">Dirección Destino</label>
                                    <input type="text" class="form-control" name='destino'
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <div class="form-group">
                                    <label for="id_tipo_servicio">Tipo Servicio</label>
                                    <select class="form-control " data-val="true" data-val-required="(*)Campo requerido"
                                        id="ddlServiceType" name="id_tipo_servicio" required>
                                        <option value="1">Recodiga</option>
                                        <option value="2">Reparto</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="origen">Cantidad Pasajeros</label>
                                    <input type="number" class="form-control" name='cantidad_personas' max="100"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="id_ciudad">Ciudad</label>
                                    <select id="id_ciudad" class="form-control" name="id_ciudad" required>
                                        <option value="1" class="">Bogotá</option>
                                        <option value="2" class="">Medellin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Fecha y Hora del Servicio</label><br>
                                    <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input"
                                            data-target="#reservationdatetime" name="fecha_hora" required>
                                        <div class="input-group-append" data-target="#reservationdatetime"
                                            data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="codigo">Codigo</label>
                                    <input type="text" class="form-control" name='codigo'
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                                <!--div class="form-group">
                                    <label for="id_zona_origen">Zona Origen</label>
                                    <select id="id_zona_origen" class="form-control" name="id_zona_origen" required>
                                        <option value="1" class="">Bogotá</option>
                                        <option value="2" class="">Zona 1</option>
                                        <option value="3" class="">Zona 2</option>
                                        <option value="4" class="">Zona 3</option>
                                        <option value="5" class="">Sumapaz </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="id_zona_destino">Zona Detino</label>
                                    <select id="id_zona_destino" class="form-control" name="id_zona_destino" required>
                                        <option value="1" class="">Bogotá</option>
                                        <option value="2" class="">Zona 1</option>
                                        <option value="3" class="">Zona 2</option>
                                        <option value="4" class="">Zona 3</option>
                                        <option value="5" class="">Sumapaz </option>
                                    </select>
                                </div-->
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="observacion">Observación</label>
                                        <textarea id="observacion" class="form-control" name="observacion" rows="5"
                                            onkeyup="javascript:this.value=this.value.toUpperCase();"
                                            required></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="it">IT</label>
                                    <input type="text" class="form-control" name='it'
                                        onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- /.card -->
        </form>
    </div>

    <div class="modal fade" id="modal-danger">
        <div class="modal-dialog">
            <div class="modal-content bg-danger">
                <div class="modal-header">
                    <h4 class="modal-title">Alerta</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>De acuerdo a ANS, las solicitudes se deben radicar máximo hasta las 3:00 pm del día anterior hábil, para asegurar la programación del servicio. 
                    <br>Para fines de semana, radicar solicitudes a más tardar el día viernes hasta las 3:00 pm. 
                        <br>Por favor comuníquese con su administrador</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-outline-light" data-dismiss="modal">Entendido</button>
                </div>
            </div>
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

    if (hoy.getHours() >= 15){
        //$('#modal-danger').modal('show');
        disableDate = [hoy,nextDay]
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