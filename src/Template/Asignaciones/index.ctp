<?php

$this->extend('/Common/view');
$this->assign('title', 'Asignación Descargas de Pesca');
$this->Html->addCrumb('Control Cuotas', ['controller' => 'Home', 'action' => 'index', '#' => 'cuotas']);
$this->Html->addCrumb('Asignación Descargas de Pesca');
?>
<div class="loader-page"></div>
<div class="row">
    <div class ="col-lg-12">
        <div class="widget">
            <div class="widget-header">
                <span class="widget-caption">Asignación de Descargas</span>
                <div class="widget-buttons">
                    <a href="#" data-toggle="maximize">
                        <i class="fa fa-expand"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-12 col-md-12">
                          
                            <div class="form-group input-small pull-left">
                              <select name="year" id="year-select" class="input-xs form-control" data-placeholder="Filtro: Año" lang="es">
                                <?php foreach($years as $year): ?>
                                  <option value="<?=$year?>"><?=$year?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="form-group pull-left">
                              <select name="division-select" id="division-select" class="input-xs form-control" data-placeholder="Filtro:  División" lang="es">
                                <option value></option>
                                <?php foreach($divisiones as $divisiones): ?>
                                  <option value="<?=$divisiones->id?>"><?=$divisiones->nombre?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="form-group pull-left">
                              <select name="especie" id="especie-select" class="input-xs form-control" data-placeholder="Filtro:  Especies" lang="es">
                                <option value></option>
                                <?php foreach($especies as $especie): ?>
                                  <option value="<?=$especie->Especies->id?>"><?=$especie->Especies->nombre?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="form-group pull-left">
                              <select name="regimen-select" id="regimen-select" class="input-xs form-control" data-placeholder="Filtro:  Regimen" lang="es">
                                <option value></option>
                                <?php foreach($regimenes as $regimen): ?>
                                  <option value="<?=$regimen->abreviacion?>"><?=$regimen->nombre?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <div class="form-group pull-left" id ="div-nave" style="">
                              <select name="nave" id="nave-select" class="input-xs form-control" data-placeholder="Filtro:  Nave" lang="es">
                                <option value></option>
                                <?php foreach($naves as $nave): ?>
                                  <option value="<?=$nave->nave?>"><?=$nave->nave?></option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-45" style="float: left;">
                        <div class="row">
                            <div class="col-sm-12">
                                <legend>Descargas de Pesca</legend>
                            </div>
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered dt-responsive nowrap " style ="font-size:9px;" id="descargas-table">
                                    <thead>
                                        <tr style ="font-size:9px;" role="row" > 
                                        <th style ="font-size:9px;"><?= __('id') ?></th>
                                        <th style ="font-size:9px;"><?= __('Fecha Descarga') ?> </th>
                                        <th style ="font-size:9px;"><?= __('Di/Da') ?></th>
                                        <th nowrap style ="font-size:9px;"><?= __('Nave') ?></th>
                                        <th style ="font-size:9px;"><?= __('Especie') ?></th>
                                        <th style ="font-size:9px;"><?= __('Zona') ?></th>
                                        <th style ="font-size:9px;"><?= __('Toneladas') ?></th>
                                        <th style ="font-size:9px;"><?= __('Disponible') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-1 " style="padding: 120px 64px 35px 6px;">
<!-- ASIGNACIÓN NORMAL -->
                      <?php if (array_in_array(['cuotas_asignacion_add'], $current_user['privilegios'])): ?>
                        <button style ="min-width: 120px;" class="btn btn-default" id="asignar-descarga-btn"  title="Asignar Descarga" onclick="validarToneladas()"> Asignar Descarga   <i class="fas fa-chevron-circle-right"></i></button>
                      <?php else: ?>
                        <button id="asignar-descarga-btn" onclick="return false;" class="btn btn-default"  disabled="disabled">Asignar Descarga<i class="fas fa-chevron-circle-right"></i></button>
                      <?php endif; ?>
<!--  DESCARGA PARCIAL -->
                      <?php if (array_in_array(['cuotas_asignacion_dparcial'], $current_user['privilegios'])): ?>
                        <button  style ="min-width: 120px;" id="descarga-parcial-btn" onclick="javascript:addDescargaParcial('Descarga Parcial', '/Asignaciones/addDescargaParcial/'+idDescarga + '/' + idOperacion,newDescargaParcialOptions);" style="" class="btn btn-default pull-left">
                        Descarga Parcial         <i class="fas fa-chevron-circle-right"></i>
                        </button>
                        <!-- <button id="descarga-parcial-btn" onclick="javascript:newEntity('Descarga Parcial', '/Asignaciones/addDescargaParcial/'+idDescarga + '/' + idOperacion, newDescargaParcialOptions);" style="margin-top: 20%;"class="btn btn-default pull-left">
                        Descarga Parcial         <i class="fas fa-chevron-circle-right"></i>
                        </button> -->
                      <?php else: ?>
                        <button style ="min-width: 120px;" id="asignar-descarga-btn" onclick="return false;" class="btn btn-default" style="margin-top: 20%; width:120px; text-align-last: right;" disabled="disabled">
                          Descarga Parcial
                            <i class="fas fa-chevron-circle-right"></i>
                        </button>
                      <?php endif; ?>
<!-- ASIGNACIÓN SIN CONTROL CUOTA -->
                      <?php if (array_in_array(['cuotas_asignacion_sccuota'], $current_user['privilegios'])): ?>
                      <button style ="min-width: 120px;" class="btn btn-default pull-left" id="asignar-descarga-scc-btn" title="Sin Control de Cuota" style="margin-top: 10%;  width:120px; text-align-last: right;" onclick="validarSinControlCuota()"> Sin Control Cuota
                        <i class="fas fa-chevron-circle-right"></i>
                      </button>
                      <?php else: ?>
                        <button style ="min-width: 120px;" id="asignar-descarga-btn" onclick="return false;" class="btn btn-default" style="margin-top: 10%;  width:120px; text-align-last: right;" disabled="disabled">
                          Sin Control Cuota
                            <i class="fas fa-chevron-circle-right"></i>
                        </button>       
                        <?php endif; ?>

<!-- ASIGNACIÓN DESCARGUITAS -->
                      <?php if (array_in_array(['cuotas_asignacion_descarguita'], $current_user['privilegios'])): ?>
                      <button style ="min-width: 120px;" class="btn btn-default pull-left" id="asignar-descarga-descarguita-btn" title="Descarguita" style="margin-top: 10%;  width:120px; text-align-last: right;" onclick="validarDescarguita()"> Descarguita
                        <i class="fas fa-chevron-circle-right"></i>
                      </button>
                      <?php else: ?>
                        <button style ="min-width: 120px;" id="asignar-descarga-btn" onclick="return false;" class="btn btn-default" style="margin-top: 10%;  width:120px; text-align-last: right;" disabled="disabled">
                          Descarguita
                            <i class="fas fa-chevron-circle-right"></i>
                        </button>
                        <?php endif; ?>
<!-- ASIGNACIÓN BOLSON -->
                      <?php if (array_in_array(['cuotas_asignacion_bolson'], $current_user['privilegios'])): ?>
                        <button style ="min-width: 120px;" class="btn btn-default pull-left" id="asignar-descarga-bolson-btn" title="Bolsón" style="margin-top: 10%;  width:120px; text-align-last: right;" onclick="validarBolson()"> Bolsón
                          <i class="fas fa-chevron-circle-right float-right"></i>
                        </button>
                      <?php else: ?>
                        <button style ="min-width: 120px;" id="asignar-descarga-btn" onclick="return false;" class="btn btn-default" style="" disabled="disabled">
                          Bolsón
                            <i class="fas fa-chevron-circle-right  float-right" style=""></i>
                        </button>
                      <?php endif; ?>
<!-- ASIGNACIÓN CUENTA CORRIENTE -->
                      <?php if (array_in_array(['cuotas_asignacion_ccorriente'], $current_user['privilegios'])): ?>
                        <button style ="min-width: 120px;" class="btn btn-default pull-left" id="asignar-descarga-ccorriente-btn" title="Cuenta Corriente" style="margin-top: 10%;  width:120px; text-align-last: right;" 
                        onclick="validarCcorriente()"> Cuenta Corriente
                          <i class="fas fa-chevron-circle-right"></i>
                        </button>
                      <?php else: ?>
                        <button style ="min-width: 120px;" id="asignar-descarga-btn" onclick="return false;" class="btn btn-default" style="margin-top: 10%; width:120px; text-align-last: right;" disabled="disabled">
                          Cuenta Corriente
                            <i class="fas fa-chevron-circle-right"></i>
                        </button>
                      <?php endif; ?>
<!-- DA JUREL -->
                      <?php if (array_in_array(['cuotas_asignacion_da_jurel'], $current_user['privilegios'])): ?>
                        <button style ="min-width: 120px;" class="btn btn-default pull-left" id="asignar-descarga-bolson-btn" title="Bolsón" style="margin-top: 10%;  width:120px; text-align-last: right;" onclick="validarDaJurel()"> Jurel Artesanal
                          <i class="fas fa-chevron-circle-right"></i>
                        </button>
                      <?php else: ?>
                        <button style ="min-width: 120px;" id="asignar-descarga-btn" onclick="return false;" class="btn btn-default" style="margin-top: 10%;  width:120px; text-align-last: right;" disabled="disabled">
                          DA Jurel
                            <i class="fas fa-chevron-circle-right"></i>
                        </button>
                      <?php endif; ?>
                    </div>
                    <div class="col-md-45" style="float: right;">
                         <div class="row">
                            <div class="col-sm-12">
                                <legend>Operaciones Asignables</legend>
                            </div>
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered dt-responsive nowrap" style ="font-size:9px;" id="operaciones-table" name="operaciones-table">
                                    <thead>
                                        <tr role="row">
                                            <th style ="font-size:9px;"><?= __('id') ?></th>
                                            <th nowrap style ="font-size:9px;"><?= __('Licencia') ?></th>
                                            <th style ="font-size:9px;"><?= __('Tipo Licencia') ?></th>
                                            <th style ="font-size:9px;"><?= __('Especie') ?></th>
                                            <th style ="font-size:9px;"><?= __('MacroZona') ?></th>
                                            <!-- <th><?= __('Año Inicio') ?></th>
                                            <th><?= __('Mes Inicio') ?></th> -->
                                            <th style ="font-size:9px;"><?= __('Fecha Vigente') ?></th>
                                            <th style ="font-size:9px;"><?= __('Total') ?></th>
                                            <th style ="font-size:9px;"><?= __('Saldo') ?></th>
                                            <th style ="font-size:9px;"><?= __('Bandera') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class ="col-lg-12" style="text-align: center;">
        <div class="widget">
            <div class="widget-header">
                <span class="widget-caption">Historial de Asignaciones</span>
                <div class="widget-buttons">
                    <a href="#" data-toggle="maximize">
                        <i class="fa fa-expand"></i>
                    </a>
                </div>
            </div>
            <!-- Widget Body -->
            <div class="widget-body">
                <div class="table-toolbar">
                </div>
                <div class="row">
                    <!-- Tabla Izquierda -->
                    <div class="col-md-12" >
                        <div class="row" >
                            <div class="col-sm-12">
                                <!-- <legend>Historial de Asignaciones</legend> -->
                                <?php if (array_in_array(['cuotas_asignacion_delete'], $current_user['privilegios'])): ?>
                                  <button class="btn btn-xs pull-left id="eliminar-btn" title="Eliminar" onclick="eliminarAsignacion()"> Eliminar  <i class="fa fa-trash"></i></button>
                                <?php else: ?>
                                  <button class="btn btn-xs id="eliminar-btn" onclick="return false;"  disabled="disabled"> Eliminar  <i class="fa fa-trash"></i></button>
                                <?php endif; ?>

                            </div>
                            <div class="col-sm-12">
                                <table class="table table-striped table-bordered dt-responsive nowrap" id="asignaciones-table">
                                    <thead>
                                        <tr role="row">
                                            <th><?= __('id') ?></th>
                                            <th><?= __('Licencia') ?></th>
                                            <th><?= __('Marea') ?></th>
                                            <th><?= __('Tipo Descarga') ?></th>
                                            <th><?= __('Di/Da') ?></th>
                                            <th><?= __('Especie') ?></th>
                                            <th><?= __('Nave') ?></th>
                                            <th><?= __('Ton Des') ?></th>
                                            <th><?= __('Ton Asig') ?></th>
                                            <th><?= __('Creado') ?></th>
                                            <th><?= __('Usuario') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            <div>
            <!-- Widget -->
        </div>
    </div>
</div>



<?= $this->append('jquery') ?>
<script>

$(document).ready(function() {
  // VARIABLES A USAR EN FUNCIONES JS
  $(document).ajaxStart(function() {
      $(".loader-page").show();
      
    });

    $(document).ajaxStop(function() {
      $(".loader-page").hide();
    });

  idAsignacion = null;
  selectedRowAsignacion = null;
  
  idDescarga = null;
  selectedRowDescarga = null;
  
  idOperacion = null;
  selectedRowOperacion = null;

  division_query = '';
  especie_query = '';
  regimen_query = '';
  nave_query = '';
  especies = [];

  $.ajax({
      url: '/api/especies.json',
      dataType: 'json',
      type: 'GET',
      data: {
          tieneLicencias: true
      }
  }).done(function(data) {
      $.each(data.especies, function(i, val) {
        especies.push({id: val.id, text: val.nombre});
      });

      $('#especie-select').select2({
        data: especies,
        allowClear: true,
      });
  });

  $('#year-select').on('change', function() {
      especie_query = '';
      if ($('#especie-select').val()) {
        especie_query = '&especie=' + $('#especie-select').val();
      }
      $('#descargas-table').dataTable().DataTable().ajax.reload();
      $('#operaciones-table').dataTable().DataTable().ajax.reload();
      $('#asignaciones-table').dataTable().DataTable().ajax.reload();
    });



  $('#especie-select').on('change', function() {
    especie_query = '';
    if ($('#especie-select').val()) {
      especie_query = '&especie=' + $('#especie-select').val();
    }
    $('#descargas-table').dataTable().DataTable().ajax.reload();
    $('#operaciones-table').dataTable().DataTable().ajax.reload();
    $('#asignaciones-table').dataTable().DataTable().ajax.reload();
  });

  $('#regimen-select').select2({allowClear: true});

  $('#regimen-select').on('change', function() {
      regimen_query = '';
      if ($('#regimen-select').val()) {
        regimen_query = '&regimen=' + $('#regimen-select').val();
      }
      $('#descargas-table').dataTable().DataTable().ajax.reload();
      $('#operaciones-table').dataTable().DataTable().ajax.reload();
      $('#asignaciones-table').dataTable().DataTable().ajax.reload();
    });

  $('#regimen-select').on("change", function(){
      var $regimen = $("select[name=regimen-select] option:selected").val();
      if($regimen == 'A'){
          $('#div-nave').show();
      }else{
          $('#div-nave').hide();
      }
  });

  $('#nave-select').select2({allowClear: true});
  
  $('#nave-select').on('change', function() {
      nave_query = '';
      if ($('#nave-select').val()) {
       nave_query = '&nave=' + $('#nave-select').val();
      }
      
      $('#descargas-table').dataTable().DataTable().ajax.reload();
      $('#operaciones-table').dataTable().DataTable().ajax.reload();
      $('#asignaciones-table').dataTable().DataTable().ajax.reload();

  });

  $('#division-select').select2({allowClear: true});

  $('#division-select').on('change', function() {
      division_query = '';
      if ($('#division-select').val()) {
        division_query = '&division=' + $('#division-select').val();
      }
      
      $('#descargas-table').dataTable().DataTable().ajax.reload();
      $('#operaciones-table').dataTable().DataTable().ajax.reload();
      $('#asignaciones-table').dataTable().DataTable().ajax.reload();

  });


    optionsDescargas = {
    loadUrl : '/api/asignaciones/listarDescargas',
    ajax: {
      'url': function() {return '/api/asignaciones/listarDescargas.json?year='+ $('#year-select').val()+ division_query+ especie_query + regimen_query + nave_query;},
      'type': 'POST',
      'dataType': 'json',
      'dataSrc': 'descargas'
    },
    autoWidth: true,
    dataColumns:[
      {"data": "id", "visible": false},
      // {"data": "fecha_ini_des"},
      {"data": function(row) {return moment.utc(row.fecha_ini_des).format('YYYY/MM/DD');}},
      {"data": "di_da"},
      {"data": "nave"},
      {"data": "especie"},
      {"data": "zona_pesca","className": "text-right"},
      // {"data": "ton", "className": "text-right"},
      {"data": function (row) {
          return row.ton?toggleNumberFormat(row.ton):null;
        },"className": "text-right"},
      // {"data": "saldo","className": "text-right"}
      {"data": function (row) {
          return row.saldo?toggleNumberFormat(row.saldo):null;
        },"className": "text-right"},
    ],
    
    rowCallback: function (row, data, dataindex) {
        var banderaVisual = data.di_da;
        if(banderaVisual  == null){
            $(row).addClass('danger');
            $(row).addClass('bandera');
    //         $('[id^="recursos"]').helptooltip({
    //      'title': 'Recursos a los que estará asociada la nave'
    //  });
  
        }
    },

    selectCallback: function(id, row) {
      idDescarga = id;
      console.log(idDescarga);
    }
  };

  dataTableEntityInit($('#descargas-table'), optionsDescargas);
  
  

  optionsOperaciones = {
    loadUrl : '/api/asignaciones/listarOperaciones',
    ajax: {
      // 'url': function() {return '/api/asignaciones/listarOperaciones.json?year='+ $('#year-select').val() + especie_query;},
      'url': function() {return '/api/asignaciones/listarOperaciones.json?year='+ $('#year-select').val()+ division_query+ especie_query + regimen_query + nave_query;},
      'type': 'POST',
      'dataType': 'json',
      'dataSrc': 'operaciones'
    },
    autoWidth: true,
    dataColumns:[
        {"data": 'id', "visible": false},
        {"data": 'resolucion', "visible": false},
        // {"data": 'licencia.tipo_licencia.nombre'},
        // {"data": 'licencia.display_name'},
        { "data": null, render: function ( data, type, row ) {
                
            return data.licencia.tipo_licencia.abreviacion+' : '+data.resolucion;
        } },
        {"data": 'licencia.especie.nombre'},
        // {"data": 'tipo_origen_licencia_id'},
        {"data": 'macro_zona',"className": "text-right"},
        {"data": function(row) {return moment.utc(row.fecha_inicio).format('DD-MM-YYYY');},"className": "text-right"},
        // {"data": 'annio_inicio'},
        // {"data": 'mes_estado'},
        // {"data": 'macro_zona.nombre'},
        // {"data": 'cantidad',"className": "text-right"},
        {"data": function (row) {
          return row.cantidad?toggleNumberFormat(row.cantidad):null;
        },"className": "text-right"},
        // {"data": 'saldo',"className": "text-right"},
        {"data": function (row) {
          return row.saldo?toggleNumberFormat(row.saldo):null;
        },"className": "text-right"},
        {"data": 'bandera', "visible": false},
        // {"data": function(row) {return Math.round(row.cantidad);}},
        // {"data": function (row) {return row.total?toggleNumberFormat(row.total):null}},
        // {"data": 'saldo'},
        // {"data": function(row) {return Math.round(row.saldo);}}
    ],
    // orderFixed: [
    //     [ 1, 'asc' ], [ 4, 'asc' ], [ 7, 'desc' ]
    // ],

     orderFixed: [
        [ 1, 'asc' ],[5,'asc']
    ],
    rowCallback: function (row, data, dataindex) {
        var banderaVisual = data.bandera;
        var tipoOrigenLicencia = data.tipo_origen_licencia_id;
        if(banderaVisual  == 0){
            $(row).addClass('danger');
            // $(row).addClass('bandera');
            // $('td:eq(4)', row).html( '<b>A</b>' );
        }
        else if(tipoOrigenLicencia == 12){
            $(row).addClass('danger');
            $(row).addClass('bandera');
        }
    },
    selectCallback: function(id, row) {
    idOperacion = id;
    console.log(idOperacion);
    }
  };

  dataTableEntityInit($('#operaciones-table'), optionsOperaciones);

  optionsAsignaciones = {
    loadUrl : '/api/asignaciones/listarAsignaciones',
    ajax: {
      'url': function() {return '/api/asignaciones/listarAsignaciones.json?year='+ $('#year-select').val()+ division_query + especie_query + regimen_query + nave_query;},
      'type': 'POST',
      'dataType': 'json',
      'dataSrc': 'asignaciones'
    },
    dataColumns: [
      {"data": "id"},
      {"data": "nombre_licencia","className": "text-left"},
      {"data": "marea","className": "text-left"},
      {"data": "tipo_descarga","className": "text-left"},
      {"data": "di_da","className": "text-left"},
      {"data": "especie","className": "text-left"},
      {"data": "nave","className": "text-left"},
      // {"data" : "ton_des","className": "text-right"},
      {"data": function (row) {
          return row.ton_des?toggleNumberFormat(row.ton_des):null;
        },"className": "text-right"},
      // {"data": "ton_asig","className": "text-right"},
      {"data": function (row) {
          return row.ton_asig?toggleNumberFormat(row.ton_asig):null;
        },"className": "text-right"},
      {"data": function(row) {return moment.utc(row.fecha_asignacion).format('DD-MM-YYYY HH:MM:ss ');},},
      {"data": "usuario","className": "text-left"}
    ],
    orderFixed: [
        [ 0, 'desc' ]
    ],
    rowCallback: function (row, data, dataindex) {
        var tipoDescarga = data.tipo_descarga;
        if(tipoDescarga  == 'ARTESANAL'){
            $(row).addClass('red');
        }else {
          $(row).addClass('success');
        }
    },
    
    };

  dataTableEntityInit($('#asignaciones-table'),optionsAsignaciones);

  
  newDescargaParcialOptions = {
    oTable: $('#asignaciones-table'),

    fnPreCreate: function() {
      if (!$('#descargas-table').data('selected')) {
        warningNotify('Debe seleccionar una Descarga Primero.');
        return false;
      }else if (!$('#operaciones-table').data('selected')) {
        warningNotify('Debe seleccionar una Licencia Segundo.');
        return false;
      }
      return true;
    },
    successCallback: function(data) {
      $('#descargas-table').dataTable().DataTable().ajax.reload();
      $('#operaciones-table').dataTable().DataTable().ajax.reload();
      $('#asignaciones-table').dataTable().DataTable().ajax.reload();
    }
  };

// pendiente
//   var table = $('#descargas-table').dataTable().DataTable();
 
//   table.on( 'draw', function () {
//     var sTitle;
//     var nTds = $('td', this);

//     console.log(nTds);
//  } );



  // $('#descargas-table tbody tr').each( function() {

  //   this.setAttribute( 'title', "hola" );
  //   var oTable = $('#descargas-table');
  //   oTable.$('tr').tooltip( {
  //       "delay": 0,
  //       "track": true,
  //       "fade": 250
  //   } );


  // });
});




// FUNCIONES JS
  function validarToneladas(){

    var $idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected'); 

    var $idOperacion = $('#operaciones-table').data('selected');
    var $selectedRowOperacion = $('#operaciones-table').find('tr.selected');

    if (!$selectedRowDescarga.length) {
      errorNotify("Debe seleccionar una Descarga Primero.");
      return;
    }else if (($selectedRowDescarga.length) && (!$selectedRowOperacion.length)){
      errorNotify("Debe seleccionar una Licencia Segundo.");
      return;
    }

    $.ajax({
        url: 'api/asignaciones/obtenerTonDescargas',
        type: 'POST',
        dataType: 'json',
        data: {idDescarga: $idDescarga, idOperacion: $idOperacion},
        success: function(data){
          validarAsignacion(data.di_da,data.tonD,data.codigo_resolucion,data.tonO);
        }
      });
  }

  function validarAsignacion($di_da,$tonDes, $codigo_resolucion,$tonOpe){
    var docDes = $di_da;
    var saldoDescargas = $tonDes;
    var codigo_resolucion = $codigo_resolucion;
    var saldoOperacion = $tonOpe;
    var tipoAsignacion = null;

    if(saldoDescargas > saldoOperacion){
      var diferencia = saldoDescargas - saldoOperacion;
      bootbox.confirm({
        "size": 'small',
        message: "La Licencia :  "+codigo_resolucion+ "   tiene disponible (  " + saldoOperacion +"   TON ). \n \n ¿Desea asignar solo el disponible de la Licencia?",
        buttons: {
          confirm: {
              label: 'Yes',
              className: 'btn-success'
          },
          cancel: {
              label: 'No',
              className: 'btn-danger'
          }
        },
        callback: function (result) {
          if(result){
            tipoAsignacion = 1;
            asignarDescarga(tipoAsignacion);
          }else{
            tipoAsignacion = null;
            $('#descargas-table').dataTable().DataTable().ajax.reload();
            $('#operaciones-table').dataTable().DataTable().ajax.reload();
            $('#asignaciones-table').dataTable().DataTable().ajax.reload();
          }
        }
      });
    }else if(saldoDescargas <= saldoOperacion){
      tipoAsignacion = 2;
      asignarDescarga(tipoAsignacion);
      }
  }

  function validarToneladaParciales(){

    var $idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    var $idOperacion = $('#operaciones-table').data('selected');
    var $selectedRowOperacion = $('#operaciones-table').find('tr.selected');

    if (!$selectedRowDescarga.length) {
        errorNotify("Debe seleccionar una Descarga primero.");
        return;
    }else if (($selectedRowDescarga.length) && (!$selectedRowOperacion.length)){
        errorNotify("Debe seleccionar una Licencia segundo.");
        return;
    }

    $.ajax({
      url: 'api/asignaciones/obtenerTonDescargas',
      type: 'POST',
      dataType: 'json',
      data: {idDescarga: $idDescarga, idOperacion: $idOperacion},
      success: function(data){
        validarAsignacionParcial(data.di_da,data.tonD,data.codigo_resolucion,data.tonO);
      }
    });
  }

  function asignarDescarga(tipoAsignacion){

    var idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    var idOperacion = $('#operaciones-table').data('selected');
    var $selectedRowOperacion = $('#operaciones-table').find('tr.selected');

    $.ajax({
      data:{descarga: idDescarga, operacion: idOperacion, tipoAsignacion : tipoAsignacion},
      url: 'api/asignaciones/add.json',
      dataType: 'json',
      type: 'post'
    }).done(function(data){
        if (data.status == "success") {
          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
          successNotify("Asignación Realizada.", "success");
        }
    });
  }

  function validarSinControlCuota(){
    var $idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    if (!$selectedRowDescarga.length) {
      errorNotify("Debe seleccionar una Descarga primero.");
      return;
    }

    bootbox.confirm({
      "size": 'small',
      message: "Esta a punto de Asignar una Descarga Sin Control de Cuota, ¿Desea Confirmar?",
      buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
      },
      callback: function (result) {
        if(result){
          sinControlCuota();
        }else{
          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
        }
      }
    });
  }

  function sinControlCuota(){

    var idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    $.ajax({
      data:{descarga: idDescarga},
      url: 'api/asignaciones/addSinControlCuota.json',
      dataType: 'json',
      type: 'post'
    }).done(function(data){
        if (data.status == "success") {
          $(document).ajaxStart(function() {
            $(".loader-page").show();
          });

          $(document).ajaxStop(function() {
            $(".loader-page").hide();
          });

          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
          successNotify("Asignación Realizada.", "success");
      }
    });
  }

  function validarDescarguita(){
    var $idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    if (!$selectedRowDescarga.length) {
      errorNotify("Debe seleccionar una Descarga primero.");
      return;
    }

    bootbox.confirm({
      "size": 'small',
      message: "Esta a punto de Asignar una descarga al tipo Descarguita, ¿Desea Confirmar?",
      buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
      },
      callback: function (result) {
        if(result){
          descarguita();
        }else{
          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
        }
      }
    });
  }

  function descarguita(){
    var idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    $.ajax({
      data:{descarga: idDescarga},
      url: 'api/asignaciones/addDescarguita.json',
      dataType: 'json',
      type: 'post'
    }).done(function(data){
        if (data.status == "success") {
          $(document).ajaxStart(function() {
            $(".loader-page").show();
          });

          $(document).ajaxStop(function() {
            $(".loader-page").hide();
          });

          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
          successNotify("Asignación Realizada.", "success");
      }
    });
  }
    


  function validarBolson(){
    var $idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    if (!$selectedRowDescarga.length) {
      errorNotify("Debe seleccionar una Descarga primero.");
      return;
    }

    bootbox.confirm({
      "size": 'small',
      message: "Esta a punto de Asignar una descarga al tipo Bolsón, ¿Desea Confirmar?",
      buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
      },
      callback: function (result) {
        if(result){
          bolson();
        }else{
          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
        }
      }
    });
  }

  function bolson(){
    var idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    $.ajax({
      data:{descarga: idDescarga},
      url: 'api/asignaciones/addBolson.json',
      dataType: 'json',
      type: 'post'
    }).done(function(data){
        if (data.status == "success") {
          $(document).ajaxStart(function() {
            $(".loader-page").show();
          });

          $(document).ajaxStop(function() {
            $(".loader-page").hide();
          });

          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
          successNotify("Asignación Realizada.", "success");
      }
    });
  }

  
  function validarCcorriente(){
    var $idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    if (!$selectedRowDescarga.length) {
      errorNotify("Debe seleccionar una Descarga primero.");
      return;
    }

    bootbox.confirm({
      "size": 'small',
      message: "Esta a punto de Asignar una descarga al tipo Cuenta Corriente, ¿Desea Confirmar?",
      buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
      },
      callback: function (result) {
        if(result){
           cuentaCorriente();
        }else{
          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
        }
      }
    });
  }

  function cuentaCorriente(){
    var idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    $.ajax({
      data:{descarga: idDescarga},
      url: 'api/asignaciones/addCuentaCorriente.json',
      dataType: 'json',
      type: 'post'
    }).done(function(data){
        if (data.status == "success") {
          $(document).ajaxStart(function() {
            $(".loader-page").show();
          });

          $(document).ajaxStop(function() {
            $(".loader-page").hide();
          });

          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
          successNotify("Asignación Realizada.", "success");
      }
    });
  }

  function validarDaJurel(){
    var $idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    var rowData = $('#descargas-table').dataTable().DataTable().row('.selected').data();  

    // if (!rowData.especie != "JUREL") {
    //   errorNotify("Debe seleccionar una Descarga que sea de especie Jurel.");
    //   return false;
    // }

    console.log($selectedRowDescarga);

    if (!$selectedRowDescarga.length) {
      errorNotify("Debe seleccionar una Descarga primero.");
      return;
    }

    bootbox.confirm({
      "size": 'small',
      message: "Esta a punto de Asignar una descarga al tipo DA Jurel, ¿Desea Confirmar?",
      buttons: {
        confirm: {
            label: 'Yes',
            className: 'btn-success'
        },
        cancel: {
            label: 'No',
            className: 'btn-danger'
        }
      },
      callback: function (result) {
        if(result){
           DaJurel();
        }else{
          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
        }
      }
    });
  }

  function DaJurel(){
    var idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    $.ajax({
      data:{descarga: idDescarga},
      url: 'api/asignaciones/addDaJurel.json',
      dataType: 'json',
      type: 'post'
    }).done(function(data){
        if (data.status == "success") {
          $(document).ajaxStart(function() {
            $(".loader-page").show();
          });

          $(document).ajaxStop(function() {
            $(".loader-page").hide();
          });

          $('#descargas-table').dataTable().DataTable().ajax.reload();
          $('#operaciones-table').dataTable().DataTable().ajax.reload();
          $('#asignaciones-table').dataTable().DataTable().ajax.reload();
          successNotify("Asignación Realizada.", "success");
      }
    });
  }


  function validarDescargaParcial(){
    var $idDescarga = $('#descargas-table').data('selected');
    var $selectedRowDescarga = $('#descargas-table').find('tr.selected');

    var $idOperacion = $('#operaciones-table').data('selected');
    var $selectedRowOperacion = $('#operaciones-table').find('tr.selected');

    if (!$selectedRowDescarga.length) {
      errorNotify("Debe seleccionar una Descarga Primero.");
      return;
    }else if (($selectedRowDescarga.length) && (!$selectedRowOperacion.length)){
      errorNotify("Debe seleccionar una Licencia Segundo.");
      return;
    }

    $.ajax({
        url: 'api/asignaciones/obtenerTonDescargas',
        type: 'POST',
        dataType: 'json',
        data: {idDescarga: $idDescarga, idOperacion: $idOperacion},
        success: function(data){
          validarAsignacionDP(data.di_da,data.tonD,data.codigo_resolucion,data.tonO);
        }
      });
  }

  function eliminarAsignacion(){
    
    idAsignacion = $('#asignaciones-table').data('selected');
    selectedRowAsignacion = $('#asignaciones-table').find('tr.selected'); 

    if (!selectedRowAsignacion.length) {
      errorNotify("Debe seleccionar una Asignacion a eliminar!");
      return;
    }

    var config = {
      sWarning: '¿Seguro de borrar la asignación?',
      sSuccess: 'Se ha borrado con exito la asignación!',
      sError: 'No se ha podido eliminar la asignación!',
    };

    var page = '/asignaciones/delete/';
    var $idAsignacion = $('#asignaciones-table').data('selected');
    var $selectedRowAsignacion = $('#asignaciones-table').find('tr.selected'); 
    var id = $idAsignacion;

    if (!id) {
      warningNotify("Debe seleccionar una fila primero!");
      return false;
    }

    BootstrapDialog.confirm({
      message: config.sWarning,
      type: BootstrapDialog.TYPE_DANGER,
      size: BootstrapDialog.SIZE_SMALL,
      callback: function (result) {
        if (result) {
          $.post( page + id,
            {'id': id},
            function (data) {
              if (data.status == 'success') {
                successNotify(config.sSuccess);
                id = null;
                $('#descargas-table').dataTable().DataTable().ajax.reload();
                $('#operaciones-table').dataTable().DataTable().ajax.reload();
                $('#asignaciones-table').dataTable().DataTable().ajax.reload();
              } else {
                errorNotify(config.sError);
              }
            }, 'json'
          );
        }
      }
    });
  }

  function addDescargaParcial(title, page, arg_options, arg_msgs) {

    idDescarga = $('#descargas-table').data('selected');
    selectedRowDescarga = $('#descargas-table').find('tr.selected'); 

    idOperacion = $('#operaciones-table').data('selected');
    selectedRowOperacion = $('#operaciones-table').find('tr.selected'); 

    if (!selectedRowDescarga.length) {
      errorNotify("Debe seleccionar primero una Descarga");
      return;
    }else if ((selectedRowDescarga.length) && (!selectedRowOperacion.length)){
      errorNotify("Debe seleccionar segundo una Operacion");
      return;
    }

    var options = arg_options ? arg_options : {};
    var msgs = arg_msgs ? arg_msgs : null;
    var config = {
      sClose: msgs?msgs.closeNew:'¿Está seguro de descartar este nuevo registro?',
      sSuccess: msgs?msgs.newSuccess:'Registrado con exito!',
      sError: msgs?msgs.newError:'No se pudo ingresar el registro. Existen errores en el formulario!',
      fnCreateCallback: options && options.fnCreateCallback ? options.fnCreateCallback : function() {},
      fnPreSubmit: options && options.fnPreSubmit ? options.fnPreSubmit : function() {return true;},
      oTable: options ? options.oTable : null,
      sTableReloadPage: options ? options.sTableReloadPage : null,
      fnPreCreate: options ? options.fnPreCreate : null,
      dialogSize: options ? options.dialogSize : null,
      closeCallback: options ? options.closeCallback : null,
      acceptCallback: options ? options.acceptCallback : null,
      successCallback: options.successCallback ? options.successCallback : null
    };

    if ( typeof config.fnPreCreate === 'function' ) {
      if (!config.fnPreCreate())
      return false;
    }

    BootstrapDialog.show({
      title: title,
      closable: false,
      size: config.dialogSize ? config.dialogSize : null,
      buttons: [
        {
          label: 'Guardar',
          cssClass: 'btn-success',
          action: function (dialog) {
            if (typeof config.acceptCallback === 'function') {
              config.acceptCallback( dialog );
            } else {
              if (!config.fnPreSubmit()) {
                return false;
              }
              var $form = $('form', dialog.getModal());
              if(!$form.valid()) {
                console.debug('FORMULARIO CON DATOS INVALIDOS');
                var errorList = $form.validate().errorList;
                console.debug(errorList);
                errorNotify(config.sError);
                return false;
              }
              if(finishedRequest) {
                finishedRequest = false;
                $form.ajaxSubmit({
                  url: encodeURI(page),
                  type: 'POST',
                  dataType: 'json',
                  /*beforeSerialize: function($form, options) {
                  },
                  beforeSubmit: function(arr, $form, options) {
                  },*/
                  success: function (data) {
                    if ( data.status == 'success' ) {
                      successNotify(config.sSuccess);
                      if(typeof config.successCallback === 'function') {
                        config.successCallback( data );
                      }
                      dialog.close();
                      if(config.oTable)
                      reloadTable(config.oTable, config.sTableReloadPage, config.closeCallback);
                    } else {
                      parseErrors(data.errors, $('form', dialog.getModal()));
                      errorNotify(config.sError);
                      finishedRequest = true;
                    }
                    finishedRequest = true;
                  }
                });
              }
              return false;
            }
          }
        },
        {
          label: 'Cerrar',
          action: function(dialog) {
            BootstrapDialog.confirm({
              message: config.sClose,
              type: BootstrapDialog.TYPE_WARNING,
              size: BootstrapDialog.SIZE_SMALL,
              callback: function (result) {
                if ( result )
                dialog.close();
                $('#descargas-table').dataTable().DataTable().ajax.reload();
                $('#operaciones-table').dataTable().DataTable().ajax.reload();
                $('#asignaciones-table').dataTable().DataTable().ajax.reload();
              }
            });
          }
        },
      ],
      message: function(dialog) {
        var $message = $('<div></div>');
        $message.load( encodeURI(page) , function () {
          $('.datetime-picker', $(this)).datetimepicker(datetimeOptions());
          $('.bootstrap-datetimepicker-widget .btn').removeClass('shiny');
          config.fnCreateCallback($message);
        });

        return $message;
      }
    });




  }
  
</script>
<?= $this->end() ?>
