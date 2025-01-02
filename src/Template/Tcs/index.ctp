<?php
$this->extend('/Common/view');
$this->assign('title', 'Mantenedor TCS');
$this->Html->addCrumb('Mantendores');
$this->Html->addCrumb('TCS');
?>
<div class="row">
    <div class="col-lg-12">
        <div class="widget">
            <div class="widget-header">
                <span class="widget-caption">TCS</span>
                <div class="widget-buttons">
                    <a href="#" data-toggle="maximize">
                        <i class="fa fa-expand"></i>
                    </a>
                    <a href="#" data-toggle="collapse">
                        <i class="fa fa-minus"></i>
                    </a>
                </div>
            </div>
            <div class="widget-body">
                <div class="table-toolbar">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <?php if(array_in_array(['admin_tcs_add'], $current_user['privilegios'])): ?>
                            <button id="new-button" onclick="javascript:newEntity('Nuevo TCS', '/tcs/add', newTcsOptions);" class="btn btn-default">
                                Nuevo TCS
                            </button>
                          <?php else: ?>
                            <button id="new-button" class="btn btn-default" disabled="disabled">
                              Nuevo TCS
                            </button>
                          <?php endif; ?>
                        </div>
                        <!-- <div class="col-md-6 col-sm-6">
                            <div class="checkbox pull-right">
                                <label>
                                    <input type="checkbox" class="form-control" id="ver-plantas-inactivas">
                                    <span class="text"><?= __('View inactive {0}', __('Plantas'))?></span>
                                </label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div>
                    <table class="table table-hover table-striped table-bordered" id="tcs-table">
                        <thead>
                            <tr>
                                <th><?= __('id') ?></th>
                                <th><?= __('tcs') ?></th>
                                <th><?= __('nave') ?></th>
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

<?= $this->append('jquery') ?>
<script>
$(document).ready(function() {

  newTcsOptions = {
    oTable: $('#tcs-table'),
    sTableReloadPage: '/api/tcs/'
  }

  editTcsOptions = {
    oTable: $('#tcs-table'),
    sTableReloadPage: '/api/tcs/'
  }

  options = {
    loadUrl: '/api/tcs/',
    actionButtons:
    <?php if(array_in_array(['admin_tcs_edit'], $current_user['privilegios'])): ?>
    '<button id="edit-btn" class="btn" onClick="editEntity(\'Editar TCS\', \'/tcs/edit/\', editTcsOptions )"><i class="fa fa-edit"></i> Editar</button> ' +
    <?php else: ?>
    '<button id="edit-btn" class="btn" disabled="disabled"><i class="fa fa-edit"></i> Editar</button> ' +
    <?php endif; ?>
    <?php if(array_in_array(['admin_tcs_delete'], $current_user['privilegios'])): ?>
    '<button id="delete-btn" class="btn" onclick="deleteEntity(\'/tcs/delete/\', $(\'#tcs-table\'))"><i class="fa fa-trash-o"></i> Borrar</button>',
    <?php else: ?>
    '<button id="delete-btn" class="btn" disabled="disabled"><i class="fa fa-trash-o"></i> Borrar</button>',
    <?php endif; ?>
    dataColumns: [
      {"data": "id"},
      {"data": "tcs"},
      {"data": "nave"}
    ],
    orderFixed: [
        [ 2, 'asc' ]
    ],
  };

  dataTableEntityInit($('#tcs-table'), options)
});
</script>
<?= $this->end() ?>
