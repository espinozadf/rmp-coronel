<?php
$this->assign('title', 'Inicio');
?>

<div class="row">
  <div class="col-lg-12">
    <div class="widget">
      <div class="widget-header">
          <span class="widget-caption">Inicio</span>
      </div>
      <div class="widget-body">
        <div class="row">
          <!--- RMP --->
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <h5 class="row-title" id="rmp"><i class="fa fa-chevron-right"></i>Captura</h5>
            <div class="tabbable" id="rmp-select-modulo">
              <ul class="nav nav-tabs nav-justified" id="rmp-tabs">
                <li class="active">
                  <a data-toggle="tab" href="#rmp-mar-tab">
                    <b>Mar</b>
                  </a>
                </li>
                <li>
                  <a data-toggle="tab" href="#rmp-tierra-tab">
                    Tierra
                  </a>
                </li>
              </ul>
              <!-- RMP tabs -->
              <div class="tab-content">
                <div id="rmp-mar-tab" class="tab-pane in active">
                  <?php if (array_in_array(['marea', 'descarga', 'recalada'], $modulos)): ?>
                    <p><?= $this->Html->link('Mareas', ['controller' => 'Mareas', 'action' => 'index'], ['class' => 'btn btn-lg btn-block']) ?></p>
                  <?php else: ?>
                    <p><?= $this->Html->link('Mareas', ['controller' => 'Mareas', 'action' => 'index'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?></p>
                  <?php endif; ?>
                </div>
                <div id="rmp-tierra-tab" class="tab-pane">
                  <?php if (array_in_array(['guia'], $modulos)): ?>
                    <p><?= $this->Html->link('Guias', ['controller' => 'Guias', 'action' => 'index'], ['class' => 'btn btn-lg btn-block']) ?></p>
                  <?php else: ?>
                    <p><?= $this->Html->link('Guias', ['controller' => 'Guias', 'action' => 'index'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?></p>
                  <?php endif; ?>
                </div>
              </div>
              <!-- /RMP tabs -->
            </div>
          </div>
          <!-- /RMP -->
          <!--- Control de Calidad --->
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <h5 class="row-title" id="calidad"><i class="fa fa-chevron-right"></i>Control de Calidad</h5>
              <div class="main-menu-group">
                <?php if (array_in_array(['calidad'], $modulos)): ?>
                <p><?= $this->Html->link('Control de Calidad - Sardina Artesanal', ['controller' => 'Home', 'action' => 'RmpUpdateRecurso', '4', '1'], ['class' => 'btn btn-lg btn-block']) ?></p>
              <?php else: ?>
                <p><?= $this->Html->link('Control de Calidad - Sardina Artesanal', ['controller' => 'Home', 'action' => 'RmpUpdateRecurso', '4', '1'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?></p>
              <?php endif; ?>
              </div>
          </div>
          <!-- /Control de Calidad -->
        </div>
        <div class="row">
          <!--- Produccion --->
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <h5 class="row-title" id="produccion"><i class="fa fa-chevron-right"></i>Producción</h5>
            <div class="main-menu-group">
              <?php if (array_in_array(['produccion'], $modulos)): ?>
              <p><?= $this->Html->link('Langostinos', ['controller' => 'Home', 'action' => 'RmpUpdateRecurso', '3', '2'], ['class' => 'btn btn-lg btn-block']) ?></p>
              <?php else: ?>
              <p><?= $this->Html->link('Langostinos', ['controller' => 'Home', 'action' => 'RmpUpdateRecurso', '3', '2'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?></p>
            <?php endif; ?>
            </div>
          </div>
          <!-- /Produccion -->

          <div class="col-lg-6 col-sm-6 col-xs-12">
            <h5 class="row-title" id="produccion"><i class="fa fa-chevron-right"></i>Control de Cuotas</h5>
            <div class="main-menu-group">
              <?php if (array_in_array(['cuotas'], $modulos)): ?>
              <p><?= $this->Html->link('Licencias de Pesca', ['controller' => 'Licencias', 'action' => 'index'], ['class' => 'btn btn-lg btn-block']) ?></p>
              <?php else: ?>
              <p><?= $this->Html->link('Licencias de Pesca', ['controller' => 'Licencias', 'action' => 'index'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?></p>
              <?php endif; ?>
              <?php if (array_in_array(['cuotas'], $modulos)): ?>
              <p><?= $this->Html->link('Decretos de Pesca (Biblioteca)', ['controller' => 'Decretos', 'action' => 'index'], ['class' => 'btn btn-lg btn-block']) ?></p>
              <?php else: ?>
              <p><?= $this->Html->link('Decretos de Pesca (Biblioteca)', ['controller' => 'Decretos', 'action' => 'index'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?></p>
              <?php endif; ?>
              <?php if (array_in_array(['cuotas'], $modulos)): ?>
              <p><?= $this->Html->link('Operaciones de Pesca', ['controller' => 'Operaciones', 'action' => 'index'], ['class' => 'btn btn-lg btn-block']) ?></p>
              <?php else: ?>
              <p><?= $this->Html->link('Operaciones de Pesca', ['controller' => 'Operaciones', 'action' => 'index'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?></p>
              <?php endif; ?>
              <!--
              <?php if (array_in_array(['cuotas'], $modulos)): ?>
              <p><?= $this->Html->link('Ver Estado de Cuota', ['controller' => 'EstadoCuotas', 'action' => 'index'], ['class' => 'btn btn-lg btn-block']) ?></p>
              <?php else: ?>
              <p><?= $this->Html->link('Ver Estado de Cuota', ['controller' => 'EstadoCuotas', 'action' => 'index'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?></p>
              <?php endif; ?>
              -->
            </div>
          </div>
        </div>

        <div class="row">
          <!--- Administracion --->
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <h5 class="row-title" id="administracion"><i class="fa fa-chevron-right"></i>Administración</h5>
            <div class="tabbable">
              <ul class="nav nav-tabs nav-justified" id="rmp-tabs">
                <li class="active">
                  <a data-toggle="tab" href="#admin-permisos-tab">
                    <b>Permisos</b>
                  </a>
                </li>
                <li>
                  <a data-toggle="tab" href="#admin-mantencion-tab">
                    Mantención
                  </a>
                </li>
              </ul>
              <!-- Administracion tabs -->
              <div class="tab-content">
                <div id="admin-permisos-tab" class="tab-pane in active">
                    <p>
                      <?php if (array_in_array(['usuario'], $modulos)): ?>
                      <?= $this->Html->link('Areas', ['controller' => 'Areas', 'action' => 'index'], ['class' => 'btn btn-lg btn-block']) ?>
                      <?= $this->Html->link('Usuarios', ['controller' => 'Usuarios', 'action' => 'index'], ['class' => 'btn btn-lg btn-block']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Areas', ['controller' => 'Areas', 'action' => 'index'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?>
                        <?= $this->Html->link('Usuarios', ['controller' => 'Usuarios', 'action' => 'index'], ['class' => 'btn btn-lg btn-block', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                    </p>
                </div>

                <div id="admin-mantencion-tab" class="tab-pane">
                    <p>
                      <?php if (array_in_array(['nave'], $modulos)): ?>
                        <?= $this->Html->link('Naves', ['controller' => 'Naves', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Naves', ['controller' => 'Naves', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['camion'], $modulos)): ?>
                      <?= $this->Html->link('Camiones', ['controller' => 'Camiones', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Camiones', ['controller' => 'Camiones', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['auxiliar'], $modulos)): ?>
                      <?= $this->Html->link('Auxiliares', ['controller' => 'Auxiliares', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Auxiliares', ['controller' => 'Auxiliares', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['puerto', 'ponton'], $modulos)): ?>
                      <?= $this->Html->link('Puertos', ['controller' => 'Puertos', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Puertos', ['controller' => 'Puertos', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['planta'], $modulos)): ?>
                      <?= $this->Html->link('Plantas', ['controller' => 'Plantas', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Plantas', ['controller' => 'Plantas', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['artePesca'], $modulos)): ?>
                      <?= $this->Html->link('Artes de Pesca', ['controller' => 'Artepesca', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Artes de Pesca', ['controller' => 'Artepesca', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['movimiento'], $modulos)): ?>
                      <?= $this->Html->link('Movimientos', ['controller' => 'Movimientos', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Movimientos', ['controller' => 'Movimientos', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['especie'], $modulos)): ?>
                      <?= $this->Html->link('Especies', ['controller' => 'Especies', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Especies', ['controller' => 'Especies', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['calibre'], $modulos)): ?>
                      <?= $this->Html->link('Calibres', ['controller' => 'Calibres', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Calibres', ['controller' => 'Calibres', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (array_in_array(['tipoDescarga'], $modulos)): ?>
                      <?= $this->Html->link('Tipo de Descargas', ['controller' => 'TipoDescargas', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Tipo de Descargas', ['controller' => 'TipoDescargas', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (true || array_in_array(['zonaPesca'], $modulos)): ?>
                      <?= $this->Html->link('Zonas de Pesca', ['controller' => 'ZonasPesca', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Zonas de Pesca', ['controller' => 'ZonaPesca', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                      <?php if (true || array_in_array(['zonaPesca'], $modulos)): ?>
                      <?= $this->Html->link('Tipos Operaciones', ['controller' => 'TipoOperaciones', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock']) ?>
                      <?php else: ?>
                        <?= $this->Html->link('Tipos Operaciones', ['controller' => 'TipoOperaciones', 'action' => 'index'], ['class' => 'btn btn-lg btn-halfblock', 'disabled' => 'disabled']) ?>
                      <?php endif; ?>
                    </p>
                </div>
              </div>
              <!-- /Administracion tabs -->
            </div>
          </div>
          <!-- /Administracion -->
        </div>
      </div>
    </div>
  </div>
</div>

<?php $this->start('jquery'); ?>
<script type="text/javascript">
$(document).ready(function () {
  $('#rmp-select-recurso button').on('click', function() {
    $('#rmp-select-recurso').hide();
    $('#rmp-select-modulo').show();

    var recursoId = $(this).data('id');

    $('#rmp-select-modulo .tab-content a').each(function () {
      $(this).prop('href', $(this).prop('href') + '/' + recursoId);
    });
  });

  $('.disabled a').attr('data-toggle', null);
  $('.disabled a').on('click', function (e) {
    e.preventDefault();
  });
  <?php if($changelog): ?>
  /**
   * Modal con Changelog
   */
   BootstrapDialog.show({
     title: 'Cambios de la versión <b><?=$rmp_version?></b>.',
     message: $('#changelog').html()
   });
   <?php endif; ?>
});
</script>
<?php $this->end(); ?>
