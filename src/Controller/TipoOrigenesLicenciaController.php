<?php
namespace App\Controller;
use App\Controller\AppController;

class TipoOrigenesLicenciaController extends AppController {
    public function initialize() {
        parent::initialize();
        $this->loadComponent('RequestHandler');
    }

    public function isAuthorized($user = null)
  {
      if (in_array($this->request->action, ['index'])) {
          return true;
      }

      $tmp_permiso = false;

      return $tmp_permiso || parent::isAuthorized($user);
  }

    public function index() {
        $tipo_origenes_licencia = $this->TipoOrigenesLicencia->find('list');

        $this->set([
            'tipo_origenes_licencia' => $tipo_origenes_licencia,
            '_serialize' => ['tipo_origenes_licencia']
        ]);
    }

} ?>
