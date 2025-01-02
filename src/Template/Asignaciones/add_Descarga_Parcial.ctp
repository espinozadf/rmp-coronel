<?php
$this->layout = 'ajax';
if (!$this->request->is(['post', 'put'])) {
    $hash_id = hash('md5', time());
    ?>

<div class="row" id="<?=$hash_id?>">
<form id="descargaParcial-form" class="form-horizontal">
    <div class="col-md-12">
      <legend>Nueva Asignación Parcial</legend>
    </div>
    <div class="col-md-12">
      <div class="row">
        <div class="col-xs-12">
          <div class="col-xs-12">
            <div class="form-group">
              <label class="col-sm-3 control-label">Especie</label>
              <div class="col-sm-9">
                  <div class="input-group input-group-xs date-picker" id="fecha-promulgacion-date-container">
                      <span class="input-group-addon"><span class="fas fa-fish"></span></span>
                      <input name="fecha_promulgacion" id="fecha-promulgacion-date" type="text" class="form-control" value="<?=$descargas->especie?>" disabled>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-3 control-label">Licencia</label>
              <div class="col-sm-6">
                  <div class="input-group input-group-xs date-picker" id="fecha-inicio-date-container">
                      <span class="input-group-addon"><span class="fa fa-ship"></span></span>
                      <input name="fecha_inicio_vigencia" id="fecha-inicio-date" type="text" class="form-control" value="<?=$operacion->licencia->display_name?>" disabled>
                  </div>
              </div>
              <!-- <label class="col-sm-3 control-label">Cantidad Licencia</label> -->
              <div class="col-sm-3">
                  <div class="input-group input-group-xs date-picker" id="fecha-termino-date-container">
                      <span class="input-group-addon">TON</span></span>
                      <input name="fecha_termino_vigencia" id="fecha-termino-date" type="text" class="form-control" value="<?=$operacion->saldo?>" disabled>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <div class="form-group">
              <label class="col-sm-3 control-label">Descarga</label>
              <div class="col-sm-3">
                  <div class="input-group input-group-xs date-picker" id="fecha-inicio-date-container">
                      <span class="input-group-addon"><span class="fa fa-ship"></span></span>
                      <input name="fecha_inicio_vigencia" id="fecha-inicio-date" type="text" class="form-control" value="<?=$descargas->di_da?>" disabled>
                  </div>
              </div>

              <!-- <label class="col-sm-3 control-label">Cantidad Licencia</label> -->
              <div class="col-sm-3">
                  <div class="input-group input-group-xs date-picker" id="fecha-termino-date-container">
                      <span class="input-group-addon">TON</span></span>
                      <input name="fecha_termino_vigencia" id="fecha-termino-date" type="text" class="form-control" value="<?=$descargas->saldo?>" disabled>
                  </div>
              </div>
              <div class="col-sm-3">
                  <div class="input-group input-group-xs date-picker" id="fecha-termino-date-container">
                      <span class="input-group-addon">TON</span></span>
                      <input name="tonAsignablesDP" id="tonAsignablesDP" type="text" class="form-control" value="" autofocus="autofocus">
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>
</div>

<script>

$(document).ready(function () {
    // Se inicializan los componentes necesarios para la vista
    var $thisModal = $('#<?=$hash_id?>');  // asigna un id unico al modal
    
    $('#descargaParcial-form', $thisModal).validate({
         rules: {
            tonAsignablesDP: {
                 required: true
             }
         } 
     });
    
    });
 
</script>


<?php
} else {
    echo json_encode([
        'status' => $status,
        'errors' => $asignacion2->errors(),
        'data' => $asignacion,
    ]);
}
?>

