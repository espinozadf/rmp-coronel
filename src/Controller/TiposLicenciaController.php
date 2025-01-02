<?php
namespace App\Controller;
use App\Controller\AppController;

class TiposLicenciaController extends AppController {
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
        $tipos_licencia = $this->TiposLicencia->find('list');

        $this->set([
            'tipos_licencia' => $tipos_licencia,
            '_serialize' => ['tipos_licencia']
        ]);
    }
} ?>
