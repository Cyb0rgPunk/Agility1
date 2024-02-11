<?= $this->extend('templates/session');?>
<?= $this->section('head_links');?>
<!-- DataTables-->
<link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?=base_url()?>/public/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<style>
@media screen {
    #printSection {
        display: none;
    }
}

@media print {
    body * {
        visibility: hidden;
    }

    #printSection,
    #printSection * {
        visibility: visible;
    }

    #printSection {
        position: fixed;
        /* Set the navbar to fixed position */
        top: 0;
        /* Position the navbar at the top of the page */
        width: 100%;
        font-size: 30px;
    }
}
</style>
</script>
<?= $this->endSection();?>
<?= $this->section('content');?>
<br>
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
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hisotrial Solicitudes que se les asigno un movil</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="tableUsers" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Fecha y hora Solicito </th>
                                <th>Fecha y hora Servicio </th>
                                <th>Cliente</th>
                                <th>Pasajero</th>
                                <th>Celular</th>
                                <th>Documento</th>
                                <th>Correo electronico</th>
                                <th>Ciudad</th>
                                <th>Origen</th>
                                <th>Zona Origen</th>
                                <th>Destino</th>
                                <th>Zona Detino</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php //foreach($solicitudes[$i]es as $solicitudes[$i]): ?>
                            <?php for($i=0; $i < count($solicitudes); $i++) :?>
                            <?php 
                                $color = '';
                                if($solicitudes[$i]['cancelada'] == 1){
                                    $color = 'red';        
                                }
                            ?>
                            <tr style="background-color:<?= $color;?>;">
                                <input type="hidden" name="id" id='id' value="<?= $solicitudes[$i]['id_solicitud'] ?>">
                                <td><?php echo $solicitudes[$i]['id_solicitud']?></td>
                                <td><?php echo $solicitudes[$i]['fecha_hora_solicitud']?></td>
                                <td><?php echo $solicitudes[$i]['fecha_hora']?></td>
                                <td>
                                    <?php 
                                        if($solicitudes[$i]['id_cliente'] == 1){echo "Compensar";}
                                        if($solicitudes[$i]['id_cliente'] == 2){echo "Avianca";}
                                    ?>
                                </td>

                                <td><?php echo $solicitudes[$i]['primer_nombre'].' '.$solicitudes[$i]['primer_apellido']?>
                                </td>
                                <td><?php echo $solicitudes[$i]['celularp']?></td>
                                <td><?php echo $solicitudes[$i]['documento']?></td>
                                <td><?php echo $solicitudes[$i]['email']?></td>
                                <td>
                                    <?php 
                                        if($solicitudes[$i]['id_ciudad'] == 1){echo "Bogotá";}
                                        if($solicitudes[$i]['id_ciudad'] == 2){echo "Medellin";}
                                    ?>
                                </td>
                                <td><?php echo $solicitudes[$i]['origen']?></td>
                                <td>
                                    <?php 
                                        if($solicitudes[$i]['id_zona_origen'] == 1){echo "Bogotá";}
                                        if($solicitudes[$i]['id_zona_origen'] == 2){echo "Zona 1";}
                                        if($solicitudes[$i]['id_zona_origen'] == 3){echo "Zona 2";}
                                        if($solicitudes[$i]['id_zona_origen'] == 4){echo "Zona 3";}
                                        if($solicitudes[$i]['id_zona_origen'] == 5){echo "Sumapaz";}
                                    ?>
                                </td>
                                <td><?php echo $solicitudes[$i]['destino']?></td>
                                <td>
                                    <?php 
                                        if($solicitudes[$i]['id_zona_destino'] == 1){echo "Bogotá";}
                                        if($solicitudes[$i]['id_zona_destino'] == 2){echo "Zona 1";}
                                        if($solicitudes[$i]['id_zona_destino'] == 3){echo "Zona 2";}
                                        if($solicitudes[$i]['id_zona_destino'] == 4){echo "Zona 3";}
                                        if($solicitudes[$i]['id_zona_destino'] == 5){echo "Sumapaz";}
                                    ?>
                                </td>
                                <td id="evaluate">
                                    <?php if(session('group_name') != 'conductor' && session('group_name') != 'pasajero' && session('group_name') != 'requisidor'):?>
                                    <a href="<?=site_url('admin/AsignarMovil/'.$solicitudes[$i]['id_solicitud']);?>"
                                        class="btn btn-danger" type="button">Asignar movil</a>
                                        <a href="<?=site_url('admin/TarifaAdicional/'.$solicitudes[$i]['id_solicitud']);?>"
                                        class="btn btn-primary" type="button">Tarifa Adicional</a>
                                    <?php endif;?>
                                    <button type="button" class="btn btn-success btn-detalles" onclick="detalles()"
                                        value="<?= $solicitudes[$i]['id_solicitud']?>" id="btnDetalles"
                                        name="btnDetalles" data-toggle="modal" data-target="#modal-xl">
                                        Detalles solicitud
                                    </button>
                                    <?php if(session('group_name') == 'conductor'):?>
                                    <a href="<?=site_url('admin/ActualizarEstado/'.$solicitudes[$i]['id_solicitud']);?>"
                                        class="btn btn-primary" type="button">Actualizar estado</a>
                                    <?php endif;?>
                                </td>
                            </tr>
                            <div class="modal fade" id="modal-xl">
                                <div class="modal-dialog modal-xl">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Detalles Solicitud</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body" id="printThis">
                                            <div class="card card-outline card-success rounded">

                                                <!-- /.card-header -->
                                                <div class="card-body border border-dark rounded"
                                                    style="font-size:16px;">
                                                    <div class="row border border-dark d-flex justify-content-start">
                                                        <div class="col-md-12">
                                                            <label class="text-center">Movil: </label>
                                                            <span id="detalles_nombre_movil"></span>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="text-center">Placa: </label>
                                                            <span id="detalles_placa"></span>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="text-center">Nombre conductor: </label>
                                                            <span id="detalles_nombrec"></span>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="text-center">Celular conductor: </label>
                                                            <span id="detalles_phonec"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row border border-dark ">
                                                        <div class="col-md-12">
                                                            <label class="text-center">Fecha y hora de inicio: </label>
                                                            <span id="detalles_fecha_hora"></span>
                                                        </div>

                                                    </div>
                                                    <div style="display:none;" class="row border border-dark">
                                                        <div class="col-md-6">
                                                            <label class="text-center">Fecha Fin</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span>N/A</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-center">Hora Fin</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span>N/A</span>
                                                        </div>
                                                    </div>
                                                    <div class="row border border-dark">
                                                        <div class="col-md-6">
                                                            <label class="text-center">Dirección Orgien</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span id="detalles_origen"></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-center">Dirección Destino</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span id="detalles_destino"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row border border-dark">
                                                        <div class="col-md-6">
                                                            <label class="text-center">Nombre Pasajero</label>
                                                        </div>
                                                        <div id="detalles_nombre" class="col-md-6">
                                                            <span><?=$solicitudes[$i]['primer_nombre'].' '.$solicitudes[$i]['primer_apellido']?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-center">Telefono</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span id="detalles_telefono"></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-center">Nombre evento</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span id="detalles_evento"></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-center">Centro de costo:</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span id="detalles_centro_costo"></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="text-center">Cantidad pasajeros:</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <span id="detalles_cantidad_pasajeros"></span>
                                                        </div>
                                                    </div>
                                                    <div class="row border border-dark d-flex justify-content-center">
                                                        <div class="col-md-12">
                                                            <label class="text-center">Observaciones</label>
                                                        </div>
                                                        <div class="col-md-12 text-center">
                                                            <p id="detalles_observacion" class="text-justify">

                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="row d-flex justify-content-center font-weight-light"
                                                        style="font-size:20px;">
                                                        <br>Lidertur
                                                    </div>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                            <!-- /.card -->
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Cerrar</button>
                                            <button type="button" class="btn btn-primary" id="btnPrint"
                                                name="btnPrint">Imprimir</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endfor; ?>
                            <?php //endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
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

<script>
function detalles() {
    $(document).delegate("#btnDetalles", "click", function() {
        //alert($(this).val());
        id_solicitud = $(this).val();
        ruta = "<?= base_url(session('group_name').'/GetDetallesAsignado/');?>/"
        url = ruta.concat(id_solicitud)
        // Ajax config
        $.ajax({
            type: "GET",
            url: url,
            //data: {id_solicitud:id_solicitud},
            success: function(response) {
                response = JSON.parse(response);
                console.log(response)
                //console.log(response['solicitudes'][0]['fecha_hora'])
                if (response['solicitudes'][0]['codigo_movil'] == null) {
                    $("#detalles_nombre_movil").text('Sin asignar')
                } else {
                    $("#detalles_nombre_movil").text(response['solicitudes'][0]['codigo_movil'])
                }

                if (response['solicitudes'][0]['placa'] == null) {
                    $("#detalles_placa").text('Sin asignar')
                } else {
                    $("#detalles_placa").text(response['solicitudes'][0]['placa'])
                }

                if (response['solicitudes'][0]['nombrec'] == null) {
                    $("#detalles_nombrec").text('Sin asignar')
                } else {
                    $("#detalles_nombrec").text(response['solicitudes'][0]['nombrec'])
                }

                if (response['solicitudes'][0]['phonec'] == null) {
                    $("#detalles_phonec").text('Sin asignar')
                } else {
                    $("#detalles_phonec").text(response['solicitudes'][0]['phonec'])
                }




                $("#detalles_fecha_hora").text(response['solicitudes'][0]['fecha_hora'])
                $("#detalles_origen").text(response['solicitudes'][0]['origen'])
                $("#detalles_destino").text(response['solicitudes'][0]['destino'])
                $("#detalles_nombre").text(response['solicitudes'][0]['primer_nombre'] + ' ' +
                    response['solicitudes'][0]['primer_apellido'])
                $("#detalles_telefono").text(response['solicitudes'][0]['celularp'])
                $("#detalles_evento").text(response['solicitudes'][0]['evento'])
                $("#detalles_centro_costo").text(response['solicitudes'][0]['cccs'] + ' - ' +
                    response['solicitudes'][0]['ccs'])
                $("#detalles_cantidad_pasajeros").text(response['solicitudes'][0][
                    'cantidad_personas'
                ])
                $("#detalles_observacion").text(response['solicitudes'][0]['observacion'])
            }
        });

    });
}

$(function() {
    $("#tableUsers").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#tableUsers_wrapper .col-md-6:eq(0)');
});

document.getElementById("btnPrint").onclick = function() {
    printElement(document.getElementById("printThis"));

    document.title = 'Solicitud';
    window.print();
    document.title = 'Lidertur';
}

function printElement(elem, append, delimiter) {
    var domClone = elem.cloneNode(true);

    var $printSection = document.getElementById("printSection");

    if (!$printSection) {
        var $printSection = document.createElement("div");
        $printSection.id = "printSection";
        document.body.appendChild($printSection);
    }

    if (append !== true) {
        $printSection.innerHTML = "";
    } else if (append === true) {
        if (typeof(delimiter) === "string") {
            $printSection.innerHTML += delimiter;
        } else if (typeof(delimiter) === "object") {
            $printSection.appendChlid(delimiter);
        }
    }

    $printSection.appendChild(domClone);
}
</script>
<?= $this->endSection();?>