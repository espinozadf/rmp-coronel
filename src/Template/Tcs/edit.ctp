<?php

$this->set('tiposTcs', 'EXTERNA');
$this->layout = 'ajax';
if (!$this->request->is(['post', 'put'])) {
    $hash_id = hash('md5', time());
?>
<div class="row" id="<?=$hash_id?>">
    <div class="col-lg-12">
        <?= $this->Form->create($tcs, ['id' => 'tcs-form']) ?>
        <legend>TCS - <?=$tcs->nave?></legend>
        <?= $this->Form->input('nave', ['placeholder' => 'Ingrese el nombre de la nave']); ?>
        <?= $this->Form->input('tcs', ['options' => $options ,'label' => 'TCS']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>
<script>
 $(document).ready(function() {
     $thisModal = $('#<?=$hash_id?>');
     $('select', $thisModal).select2({
         dropdownParent: $thisModal
     });
     $('#tcs-form', $thisModal).validate({
         rules: {
             nombre: {
                 required: true,
                 minlength: 2,
             }
         }
     })
 });
</script>
<?php
} else {
    echo json_encode([
        'status' => $status,
        'errors' => $tcs->errors(),
        'data' => $tcs
    ]);
}
?>
