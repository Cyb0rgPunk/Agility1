<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/select/1.3.4/css/select.dataTables.min.css">
</script>
<?= $this->endSection();?>
<?= $this->section('content');?>
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <?php 
                //dd($pasajeroes);
            ?>
            <h1>Gestion de la ruta
                #<?php echo $sub_zona[0]['nombre'].'<br> Dia: '. date('Y-m-d', strtotime($pasajeros[0]['fecha']));?>
            </h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                <li class="breadcrumb-item active">Aceptar o rechazar servicio</li>
            </ol>
        </div>
    </div>
    <div class="col-md-12">
        <?php if(session('msg')):?>
        <div class="alert alert-<?=session('msg.type')?> alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h5><i class="icon fas fa-<?=session('msg.icon')?>"></i> Alert!</h5>
            <?=session('msg.body')?>
        </div>
        <?php endif;?>
    </div>
    <div class="row">
        <?php //dd($ruta)?>
        <form action="<?= site_url(session('group_name').'/AsignarMovilRuta'); ?>" method="POST">

            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table id="tablaRutas" class="table table-bordered tablaRutas">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Hora llegada</th>
                                    <th>Nombre</th>
                                    <th>Cedula</th>
                                    <th>Dirección</th>
                                    <th>Barrio</th>
                                    <th>Movil</th>
                                    <th>Conductor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $i = 1;
                                foreach($pasajeros as $pasajero): 
                                    if($pasajero['movil'] == ''){ 
                                        $gb_color = 'red';
                                    }else{
                                        $bg_color = 'green';
                                    }
                                
                                    $db = \Config\Database::connect();
                                    $builder = $db->table('t_moviles m');
                                    $builder->select('m.placa');
                                    $builder->where(['m.id_movil'=>$pasajero['movil']]);
                                    $placa = $builder->get()->getResultArray();
                                    //dd($placa);
                                    if(isset($placa[0]['placa']))
                                        $pasajero['movil_placa'] = $placa[0]['placa'];

                                    $builder = $db->table('t_conductores c');
                                    $builder->select('c.nombre');
                                    $builder->where(['c.id_conductor'=>$pasajero['conductor']]);
                                    $conductor = $builder->get()->getResultArray();
                                    
                                    if(isset($conductor[0]['nombre']))
                                        $pasajero['conductor_nombre'] = $conductor[0]['nombre'];


                            ?>
                                <tr>
                                    <td><?php echo $i?></td>
                                    <td><?php echo $pasajero['hora_llegada']?></td>
                                    <td><?php echo $pasajero['nombre']?></td>
                                    <td><?php echo $pasajero['numero_cc']?></td>
                                    <td><?php echo $pasajero['direccion']?></td>
                                    <td><?php echo $pasajero['barrio']?></td>
                                    <td><?php echo $pasajero['movil'].' - '.@$pasajero['movil_placa']?></td>
                                    <td><?php echo $pasajero['conductor'].' - '. @$pasajero['conductor_nombre']?></td>
                                </tr>
                                <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <input type="hidden" name="pasajeros[]" id="cc_pasajeros">
                        <input type="hidden" name="id_ruta" value="<?= $id_ruta;?>">
                        <input type="hidden" name="hora_llegada" value="<?= $hora_llegada;?>">
                        <input type="hidden" name="fecha" value="<?= $fecha;?>">
                        <button id="send" type="" class="btn btn-success" name="btn_aceptar">Aceptar servicio</button>
                        <button id="send" type="" class="btn btn-danger" name="btn_rechazar">Rechazar servicio</button>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </form>

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
<script src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>
<script>
$(document).ready(function() {
    const myArray = [];
    //use class here
    $('.checkRule').change(function() {
        //use `this` to get refernce of current checkbox change
        if ($(this).is(':checked')) {
            myArray.push($(this).val()); //put that value
        } else {
            const index = myArray.indexOf($(this).val());
            if (index > -1) {
                myArray.splice(index, 1);
            }
        }

    });

    $('#send').click(function() {

        var result = myArray;
        console.log('Import result >>>>> ', result);
        document.getElementById("cc_pasajeros").value = result;
        //your ajax call..

    });

    var table1 = $('#tablaRutas').DataTable({
        "select": true,
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tablaRutas_wrapper .col-md-6:eq(0)');


});
</script>
<?= $this->endSection();?>