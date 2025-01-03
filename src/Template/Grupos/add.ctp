<?php
$this->layout = 'ajax';
if (!$this->request->is(['post'])) {
    $hash_id = hash('md5', time());
?>
    <div class="row" id="<?=$hash_id?>">
        <div class="col-lg-12">
          <?= $this->Form->create($grupo) ?>
          <legend>Grupo</legend>
            <?php
            echo $this->Form->input('nombre');
            echo $this->Form->input('division_id', ['options' => $divisiones, 'style' => 'width: 100%']);
            echo $this->Form->input('areas._ids', ['options' => $areas, 'multiple' => 'multiple', 'class' => 'input-xs form-control', 'style' => 'width: 100%']);
            ?>
            <legend>Privilegios</legend>
            <div class="row">
                <label class="col-sm-3 control-label" style="text-align: left;">Privilegioss</label>
                <div class="col-sm-9">
                  <input type="hidden" name="privilegios[_ids]" class="form-control input-xs" value="">
                    <table class="table table-striped table-condensed table-hover" id="privilegios-table">
                      <thead>
                        <tr>
                          <th>Modulo</th>
                          <th>Sección</th>
                          <th>Agregar</th>
                          <th>Borrar</th>
                          <th>Editar</th>
                          <th>Cerrar</th>
                          <th>Abrir</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($privilegios2 as $modulo => $secciones):
                          $first_section = true;
                          ?>
                          <?php foreach($secciones as $seccion => $permisos):?>
                            <tr>
                          <?php
                            if ($first_section):
                              $rowspan = count($secciones);
                              ?>
                              <td rowspan="<?=$rowspan?>"><?=strtoupper($modulo)?></td>
                          <?php endif; ?>
                              <td><?=strtoupper(implode(' ', preg_split('/(?=[A-Z])/', $seccion)))?></td>
                            <?php foreach($permisos as $permiso => $id): ?>
                                <td>
                                  <div class="centered checkbox"><label for="privilegios-ids-<?=$id?>">
                                     <input type="checkbox" name="privilegios[_ids][]" value="<?=$id?>" id="privilegios-ids-<?=$id?>"
                      
                                     <span class="text"></span></label>
                                   </div>
                                </td>
                            <?php endforeach; ?>
                            <?php if (count($permisos) == 3): ?>
                              <td>
                                <div class="centered checkbox"><label>
                                   <input type="checkbox" disabled="disabled">
                                   <span class="text"></span></label>
                                 </div>
                              </td>
                              <td>
                                <div class="centered checkbox"><label>
                                   <input type="checkbox" disabled="disabled">
                                   <span class="text"></span></label>
                                 </div>
                              </td>
                            <?php endif; ?>
                            </tr>
                          <?php
                            $first_section = false;
                          endforeach; ?>
                        <?php endforeach; ?>
                             <!--echo '<div class="col-sm-6 checkbox"><label for="privilegios-ids-'.$id.'">'.
                                  '<input type="checkbox" name="privilegios[_ids][]" value="'.$id.'" id="privilegios-ids-'.$id.'"'.
                               (in_array($id, $grupo->privilegios_ids) ? ' checked="checked"' : '').
                                  '>'.
                                  '<span class="text">'.$privilegio.'</span></label></div>';-->
                      </tbody>
              </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
<script>
$(document).ready(function() {
  var $thisModal = $('#<?=$hash_id?>');
  $('select', $thisModal).select2({
      dropdownParent : $thisModal
  });
});
</script>
<?php
} else {
    echo json_encode([
        'status' => $status,
        'errors' => $grupo->errors(),
        'data' => $grupo
    ]);
}
?>
