<?php
namespace App\Controller;

use App\Controller\AppController;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Network\Exception\NotFoundException;

/**
 * Sapdescarga Controller
 *
 * @property \App\Model\Table\SapdescargaTable $Sapdescarga
 *
 * @method \App\Model\Entity\Sapdescarga[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class AsignacionesController extends AppController{
    public function initialize(){

        parent::initialize();
        $this->loadComponent('RequestHandler');
        $this->loadModel('Usuarios');
        $this->loadModel('Operaciones');
        $this->loadModel('Vistadescarga');
        $this->loadModel('Regimenes');
        $this->loadModel('Divisiones');
        $this->loadModel('Vistaoperacion');
        $this->loadModel('Asignado');
        $this->loadModel('Vistaasignado');
        // $this->loadModel('Tcs');
    }
    public function isAuthorized($user = null){
        if (in_array($this->request->action, ['index', 'listarDescargas','listarOperaciones','listarAsignaciones'])) {
            return true;
        }

        $tmp_permiso = false;
        switch ($this->request->action) {

            case 'obtenerTonDescargas': $tmp_permiso = (bool) in_array('cuotas_asignacion_add', $this->Auth->user('privilegios')); break;
            case 'validarToneladas': $tmp_permiso = (bool) in_array('cuotas_asignacion_add', $this->Auth->user('privilegios')); break;
            case 'add': $tmp_permiso = (bool) in_array('cuotas_asignacion_add', $this->Auth->user('privilegios')); break;
            case 'validarSinControlCuota': $tmp_permiso = (bool) in_array('cuotas_asignacion_sccuota', $this->Auth->user('privilegios')); break;
            case 'addSinControlCuota': $tmp_permiso = (bool) in_array('cuotas_asignacion_sccuota', $this->Auth->user('privilegios')); break;
            case 'addDescarguita': $tmp_permiso = (bool) in_array('cuotas_asignacion_descarguita', $this->Auth->user('privilegios')); break;
            case 'addBolson': $tmp_permiso = (bool) in_array('cuotas_asignacion_bolson', $this->Auth->user('privilegios')); break;
            case 'addCuentaCorriente': $tmp_permiso = (bool) in_array('cuotas_asignacion_ccorriente', $this->Auth->user('privilegios')); break;
            case 'delete': $tmp_permiso = (bool) in_array('cuotas_asignacion_delete', $this->Auth->user('privilegios')); break;
            case 'addDescargaParcial': $tmp_permiso = (bool) in_array('cuotas_asignacion_dparcial', $this->Auth->user('privilegios')); break;
            case 'addDaJurel': $tmp_permiso = (bool) in_array('cuotas_asignacion_da_jurel', $this->Auth->user('privilegios')); break;
        }
        return $tmp_permiso || parent::isAuthorized($user);

        // return parent::isAuthorized($user);
    }

    // public function isAuthorized($user = null){
    //     $tmp_permiso = false;
    //     switch ($this->request->action) {
    //         case 'index':
    //         case 'listarDescargas':
    //         case 'listarOperaciones':
    //         case 'listarAsignaciones':

    //         $search = 'admin_usuario';
    //         $matches = array_filter($this->Auth->user('privilegios'), function ($var) use ($search) {
    //         return preg_match("/$search/i", $var);
    //         });
    //         $tmp_permiso = (bool)$matches;
    //         break;
    //         case 'obtenerTonDescargas':     $tmp_permiso = (bool) in_array('cuotas_asignacion_add', $this->Auth->user('privilegios')); break;
    //         case 'validarToneladas':        $tmp_permiso = (bool) in_array('cuotas_asignacion_add', $this->Auth->user('privilegios')); break;
    //         case 'add':                     $tmp_permiso = (bool) in_array('cuotas_asignacion_add', $this->Auth->user('privilegios')); break;
    //         case 'delete':                  $tmp_permiso = (bool) in_array('cuotas_asignacion_add', $this->Auth->user('privilegios')); break;
    //         case 'validarSinControlCuota':  $tmp_permiso = (bool) in_array('cuotas_asignacion_sccuota', $this->Auth->user('privilegios')); break;
    //         case 'addSinControlCuota':      $tmp_permiso = (bool) in_array('cuotas_asignacion_sccuota', $this->Auth->user('privilegios')); break;
            
    // }

    // return $tmp_permiso || parent::isAuthorized($user);

    // }

    public function grupoUsuario($username){
        $usuario = $this->Usuarios->find()
            ->where(['Usuarios.uid' => $username])
            ->contain(['Grupos'])
            ->toArray();
            return $usuario[0]->grupos[0]->id;
    }

    public function regimenUsuario($username){
        $usuario = $this->Usuarios->find()
            ->where(['Usuarios.uid' => $username])
            ->contain(['Grupos'])
            ->toArray();
            return $usuario[0]->grupos[0]->regimen;
    }


    public function divisionUsuario($username){
        // $usuario = $this->Usuarios->find()
        //     ->where(['Usuarios.uid' => $username])
        //     ->contain(['Grupos'])
        //     ->toArray();
        //     return $usuario[0]->grupos[0]->division_id;

        $grupos = [];
        $divisiones = [];

        $usuario = $this->loadModel('Usuarios')
        ->find()
        ->where(['Usuarios.uid' => $username])
        ->contain(['Grupos'])->first();

        $grupos = $usuario->grupos;

        foreach ($grupos as $key => $grupos) {
            $division =  $grupos->division_id;
            $divisiones[] = $division;
        }
        return $divisiones;
    }


    public function index(){
        $user = $this->Auth->user('uid');

        $regimenUsuario = $this->regimenUsuario($user);
        $divisionUsuario = $this->divisionUsuario($user);
        
        if (!$this->request->is(['ajax'])) {
            $descargasYear = $this->Vistadescarga
            ->find('all')
            ->select('fecha_ini_des');

            if ($descargasYear->count() == 0) {
                $firstYear = date('Y');
                $lastYear = $firstYear;
            } else {
                $firstYear = $descargasYear->cleanCopy()->order('fecha_ini_des ASC')->first()->toArray()['fecha_ini_des']->format('Y');
                $lastYear = $descargasYear->order('fecha_ini_des DESC')->first()->toArray()['fecha_ini_des']->format('Y');
            }

            $especies = $this->Operaciones->find('all', [
                'contain' => ['Licencias', 'Licencias.Especies'],
                'group' => ['Especies.id', 'Especies.nombre']
            ])
            ->select(['Especies.id', 'Especies.nombre']);

            $regimenes = $this->Regimenes->find('all')
            ->select(['nombre','abreviacion']);

            // $tcs = $this->Tcs->find('all');

            $years = range($lastYear, $firstYear);

            $divisiones = $this->Divisiones->find('all',[ 'conditions' => ['id IN' => $divisionUsuario]]);

            $naves = $this->Vistadescarga->find('all',[ 'conditions' => ['division IN' => $divisionUsuario]])
                ->select('Vistadescarga.nave','naves.id')
                ->distinct(['Vistadescarga.nave'])
                // ->where(['division'=> $divisionUsuario])
                ->order(['Vistadescarga.nave' => 'ASC']);
                
            $this->set([
                'years' => $years,
                'divisiones' => $divisiones,
                'especies' => $especies,
                'regimenes' => $regimenes,
                'naves' => $naves
                //  'tcs' => $tcs
               

            ]);


        }
    }

    public function listarOperaciones(){
        $user = $this->Auth->user('uid');
        $regimenUsuario = $this->regimenUsuario($user);
        $divisionUsuario = $this->divisionUsuario($user);

        if ($this->request->is(['ajax', 'post'])){
            $operacionAsignable = $this->Vistaoperacion->find('all',[ 'conditions' => ['Licencias.division IN' => $divisionUsuario]])
            ->where(['saldo >' => 0])
            ->contain([
                'Licencias' => function ($q) {
                    return $q->select(['id', 'especie_id', 'fecha_promulgacion', 'codigo_resolucion', 'tipo_licencia_id']);
                },
                'Licencias.Especies',
                'Licencias.Auxiliares',
                'Licencias.Naves' => function($q){
                    return $q->select(['id','regimen_id']);
                },
                'Licencias.TiposLicencia',
                'Licencias.TipoOrigen'
            ]);

            if ($this->request->query('year')) {
                $operacionAsignable = $operacionAsignable
                ->where([
                    'annio' => $this->request->query('year')
                ]);
            }
            if ($this->request->query('division')){
                $operacionAsignable = $operacionAsignable
                ->where([
                    'Licencias.division' => $this->request->query('division')
                ]);
            }

            if ($this->request->query('especie') && $this->request->query('especie') != 'undefined') {
                $operacionAsignable = $operacionAsignable
                ->where([
                    'Licencias.especie_id' => $this->request->query('especie')
                ]);
            }

            if ($this->request->query('regimen')){
                $operacionAsignable = $operacionAsignable
                ->where([
                    'TiposLicencia.regimen' => $this->request->query('regimen')
                ]);
            }

            if($this->request->query('nave')){
                $operacionAsignable = $operacionAsignable
                ->where([
                    'Naves.nombre' => $this->request->query('nave')
                ]);
            }
        
            $this->set([
                'operaciones' => $operacionAsignable,
                'draw' => $this->request->data('draw'),
                '_serialize' => [
                    'operaciones',
                    'draw'
                ]
            ]);
        }
    }

    public function listarDescargas(){
        $user = $this->Auth->user('uid');
        $regimenUsuario = $this->regimenUsuario($user);
        $divisionUsuario = $this->divisionUsuario($user);
        // Carga de Operaciones
        if ($this->request->is(['ajax', 'post']) && !empty($this->request->query('year'))) {
            $descargas = $this->Vistadescarga->find('all',[ 'conditions' => ['division IN' => $divisionUsuario]])
            ->find('all')
            ->where(['saldo >' => 0]);
            // ->where(['division'=> $divisionUsuario]);
        //  ->order(['fecha_ini_des' => 'DESC']);

            if ($this->request->query('especie') && $this->request->query('especie') != 'undefined') {
                $descargas = $descargas
                ->where([
                    'especie_id' => $this->request->query('especie')
                ]);
            }

            if ($this->request->query('year')) {
                $descargas = $descargas
                ->where([
                    'YEAR(fecha_ini_des)' => $this->request->query('year')
                ]);
            }

            if ($this->request->query('division')){
                $descargas = $descargas
                ->where([
                    'division' => $this->request->query('division')
                ]);
            }

            if ($this->request->query('regimen')){
                $descargas = $descargas
                ->where([
                    'tipo_descarga' => $this->request->query('regimen')
                ]);
            }

            if($this->request->query('nave')){
                $descargas = $descargas
                ->where([
                    'nave' => $this->request->query('nave')
                ]);
            }

            $this->set([
                'descargas' => $descargas,
                'draw' => $this->request->data('draw'),
                '_serialize' => [
                    'descargas',
                    'draw'
                ]
            ]);
        }
    }

    public function listarAsignaciones(){
        $user = $this->Auth->user('uid');
        $regimenUsuario = $this->regimenUsuario($user);
        $divisionUsuario = $this->divisionUsuario($user);
          if ($this->request->is(['ajax', 'post'])) {
  
  
              // $asignaciones = $this->Vistaasignado->find('all')
              // ->contain([
              //     'Licencias' => function ($q) {
              //         return $q->select(['id', 'especie_id', 'fecha_promulgacion', 'codigo_resolucion', 'tipo_licencia_id']);
              //     },
              //     'Licencias.Especies',
              //     'Licencias.Auxiliares',
              //     'Licencias.Naves' => function($q){
              //         return $q->select(['id','regimen_id']);
              //     },
              //     'Licencias.TiposLicencia'
              // ]);
  
              $asignaciones = $this->Vistaasignado->find('all',[ 'conditions' => ['division IN' => $divisionUsuario]]);
  
              if($this->request->query('year')) {
                  $asignaciones = $asignaciones
                  ->where(['annio' => $this->request->query('year')]);
              }
  
              if($this->request->query('division')) {
                  $asignaciones = $asignaciones
                  ->where(['division' => $this->request->query('division')]);
              }
  
              if($this->request->query('especie') && $this->request->query('especie') != 'undefined') {
                  $asignaciones = $asignaciones
                  ->where([
                      'Vistaasignado.especie_id' => $this->request->query('especie')
                  ]);
              }
  
              if ($this->request->query('regimen')){
                  $asignaciones = $asignaciones
                  ->where([
                      'tipo_descarga_a' => $this->request->query('regimen')
                  ]);
              }
  
              if($this->request->query('nave')){
                  $asignaciones = $asignaciones
                  ->where([
                      'nave' => $this->request->query('nave')
                  ]);
              }
  
              $this->set([
                  'asignaciones' => $asignaciones,
                  'draw' => $this->request->data('draw'),
                  '_serialize' => [
                      'asignaciones',
                      'draw'
                  ]
              ]);
          }
    }

    public function obtenerTonDescargas(){

        $idDescarga = filter_input(INPUT_POST, 'idDescarga');
        $idOperacion = filter_input(INPUT_POST, 'idOperacion');

        $di_da = $this->Vistadescarga->find()->select(['di_da'])->where(['id' => $idDescarga])->first();
        $di_da2 = $di_da['di_da'];

        $tonDescarga = $this->Vistadescarga->find()->select(['saldo'])->where(['id' => $idDescarga])->first();
        $tonDescarga2 = $tonDescarga['saldo'];

        $licencia = $this->Vistaoperacion->find()->select(['resolucion'])->where(['id' => $idOperacion])->first();
        $licencia2 = $licencia['resolucion'];

        $tonOperacion = $this->Vistaoperacion->find()->select(['saldo'])->where(['id' => $idOperacion])->first();
        $tonOperacion2 = $tonOperacion['saldo'];

        $this->set([
            'di_da' => $di_da2,
            'tonD' => $tonDescarga2,
            'codigo_resolucion' => $licencia2,
            'tonO' => $tonOperacion2,
            '_serialize' => ['di_da','tonD','codigo_resolucion','tonO']
        ]);

    }

    public function add(){

        $idDescarga = filter_input(INPUT_POST, 'descarga');
        $idOperacion = filter_input(INPUT_POST, 'operacion');
        $tipoAsignacion = filter_input(INPUT_POST, 'tipoAsignacion');
        // $descargas = $this->Sapdescarga->get($idDescarga);

        $tonDescarga = $this->Vistadescarga->find()->select(['saldo'])->where(['id' => $idDescarga])->first();
        $tonDescarga2 = $tonDescarga['saldo'];

        $divisionDescarga = $this->Vistadescarga->find()->select(['division'])->where(['id' => $idDescarga])->first();
        $divisionDescarga2 = $divisionDescarga['division'];
        // $operaciones = $this->Operacionvista->get($idOperacion);
        // debug($operaciones);

        $tonOperacion = $this->Vistaoperacion->find()->select(['saldo'])->where(['id' => $idOperacion])->first();
        $tonOperacion2 = $tonOperacion['saldo'];

        $tonOperacionFijo = $this->Vistaoperacion->find()->select(['cantidad'])->where(['id' => $idOperacion])->first();
        $tonOperacionFijo2 = $tonOperacionFijo['cantidad'];

        $annioOperacion = $this->Vistaoperacion->find()->select(['annio'])->where(['id' => $idOperacion])->first();
        $annioOperacion2 = $annioOperacion['annio'];

        $fechaOperacion = $this->Vistaoperacion->find()->select(['fecha_inicio'])->where(['id' => $idOperacion])->first();
        $fechaOperacion2 = $fechaOperacion['fecha_inicio'];

        $idLicencia = $this->Vistaoperacion->find()->select(['licencia_id'])->where(['id' => $idOperacion])->first();
        $idLicencia2 = $idLicencia['licencia_id'];

        date_default_timezone_set('America/Santiago');

        $fechaAsignacion = date('Y/m/d H:i:sA');

        $asignacion2 = $this->Asignado->newEntity();

        // tipoAsignacion = 1 => Operacion menor a la descarga; 2 => Descarga menor a la operacion
        if($tipoAsignacion == 1){

              $asignacion2->set('sapdescarga_id',$idDescarga);
              $asignacion2->set('operacionasignable_id',$idOperacion);
              $asignacion2->set('licencia_id',$idLicencia2);
              $asignacion2->set('ton_asignadas',$tonOperacion2);
              $asignacion2->set('annio',$annioOperacion2);
              $asignacion2->set('fecha_vigente',$fechaOperacion2);
              $asignacion2->set('fecha_asignacion',$fechaAsignacion);
              $asignacion2->set('ton_operacion',$tonOperacionFijo2);
              $asignacion2->set('tipo_asignacion','A');
              $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
              $asignacion2->set('division', $divisionDescarga2);

              if($this->Asignado->save($asignacion2)){
                  $status = 'success';
              }else {
                $status = 'error';
              }
        }else{
                $asignacion2->set('sapdescarga_id',$idDescarga);
                $asignacion2->set('operacionasignable_id',$idOperacion);
                $asignacion2->set('licencia_id',$idLicencia2);
                $asignacion2->set('ton_asignadas',$tonDescarga2);
                $asignacion2->set('annio',$annioOperacion2);
                $asignacion2->set('fecha_vigente',$fechaOperacion2);
                $asignacion2->set('fecha_asignacion',$fechaAsignacion);
                $asignacion2->set('ton_operacion',$tonOperacionFijo2);
                $asignacion2->set('tipo_asignacion','A');
                $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
                $asignacion2->set('division', $divisionDescarga2);

                if($this->Asignado->save($asignacion2)){
                    $status = 'success';
                }else {
                  $status = 'error';
                }
        }

        $this->set([
            'asignacion' => $asignacion2,
            'status' => $status,
            'errors' => $asignacion2->errors(),
            '_serialize' => ['asignacion', 'status', 'errors']
        ]);

    }
    
    public function addSinControlCuota(){

      $idDescarga = filter_input(INPUT_POST, 'descarga');
      $tonDescarga = $this->Vistadescarga->find()->select(['saldo'])->where(['id' => $idDescarga])->first();
      $tonDescarga2 = $tonDescarga['saldo'];

      // $annioDescarga = $this->Vistadescarga->find()->select(['annio'])->where(['id' => $idOperacion])->first();
      // $annioDescarga2 = $annioDescarga['annio'];

      $divisionDescarga = $this->Vistadescarga->find()->select(['division'])->where(['id' => $idDescarga])->first();
      $divisionDescarga2 = $divisionDescarga['division'];


      $fechaDescarga = $this->Vistadescarga->find()->select(['fecha_ini_des'])->where(['id' => $idDescarga])->first();
      $fechaDescarga2 = $fechaDescarga['fecha_ini_des'];

      $tipoDescarga = $this->Vistadescarga->find()->select(['tipo_descarga'])->where(['id' => $idDescarga])->first();
      $tipoDescarga2 = $tipoDescarga['tipo_descarga'];

      date_default_timezone_set('America/Santiago');

      $fechaAsignacion = date('Y/m/d H:i:sA');

      $asignacion2 = $this->Asignado->newEntity();

      if($tipoDescarga2 == 'A'){
        $asignacion2->set('sapdescarga_id',$idDescarga);
        // $asignacion2->set('operacionasignable_id','NULL');
        // $asignacion2->set('licencia_id', );
        $asignacion2->set('ton_asignadas',$tonDescarga2);
        $asignacion2->set('annio',2019);
        $asignacion2->set('fecha_vigente',$fechaDescarga2);
        $asignacion2->set('fecha_asignacion',$fechaAsignacion);
        $asignacion2->set('ton_operacion',$tonDescarga2);
        $asignacion2->set('tipo_asignacion','S');
        $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
        $asignacion2->set('division', $divisionDescarga2);

        if($this->Asignado->save($asignacion2)){
            $status = 'success';
        }else {
          $status = 'error';
        }

      }elseif($tipoDescarga2 == 'P'){
          $asignacion2->set('sapdescarga_id',$idDescarga);
          // $asignacion2->set('operacionasignable_id','NULL');
        //   $asignacion2->set('licencia_id', );
          $asignacion2->set('ton_asignadas',$tonDescarga2);
          $asignacion2->set('annio',2019);
          $asignacion2->set('fecha_vigente',$fechaDescarga2);
          $asignacion2->set('fecha_asignacion',$fechaAsignacion);
          $asignacion2->set('ton_operacion',$tonDescarga2);
          $asignacion2->set('tipo_asignacion','S');
          $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
          $asignacion2->set('division', $divisionDescarga2);

          if($this->Asignado->save($asignacion2)){
              $status = 'success';
          }else {
            $status = 'error';
          }

        }

      $this->set([
          'asignacion' => $asignacion2,
          'status' => $status,
          'errors' => $asignacion2->errors(),
          '_serialize' => ['asignacion', 'status', 'errors']
      ]);
    }

    public function delete($id = null){
      $this->request->allowMethod(['post', 'delete']);

      $asignacion = $this->Asignado->get($id);
      if ($this->Asignado->delete($asignacion)) {
          $status = 'success';
          
      } else {
          $status = 'error';
      }

      $this->set([
          'status' => $status,
          '_serialize' => ['status']
      ]);
    }


    public function addDescargaParcial($idDescarga = NULL, $idOperacion = NULL){
        $status = 'success';
        $descargas = $this->Vistadescarga->get($idDescarga);
  
        $operacion = $this->Vistaoperacion->get($idOperacion, [
            'contain' => [
              'Licencias' => function ($q) {
                  return $q->select(['id', 'especie_id', 'fecha_promulgacion', 'codigo_resolucion', 'tipo_licencia_id']);
              },
              'Licencias.Especies',
              'Licencias.Auxiliares',
              'Licencias.Naves' => function($q){
                  return $q->select(['id','regimen_id']);
              },
              'Licencias.TiposLicencia']
          ]);

        $asignacion2 = $this->Asignado->newEntity();
        if ($this->request->is('post')) {
            $asignacion2 = $this->Asignado->patchEntity($asignacion2, $this->request->data);
            $valor = $this->request->data('tonAsignablesDP');

            $divisionDescarga = $this->Vistadescarga->find()->select(['division'])->where(['id' => $idDescarga])->first();
            $divisionDescarga2 = $divisionDescarga['division'];

            $tonOperacion = $this->Vistaoperacion->find()->select(['saldo'])->where(['id' => $idOperacion])->first();
            $tonOperacion2 = $tonOperacion['saldo'];

            $tonOperacionFijo = $this->Vistaoperacion->find()->select(['cantidad'])->where(['id' => $idOperacion])->first();
            $tonOperacionFijo2 = $tonOperacionFijo['cantidad'];

            $annioOperacion = $this->Vistaoperacion->find()->select(['annio'])->where(['id' => $idOperacion])->first();
            $annioOperacion2 = $annioOperacion['annio'];

            $fechaOperacion = $this->Vistaoperacion->find()->select(['fecha_inicio'])->where(['id' => $idOperacion])->first();
            $fechaOperacion2 = $fechaOperacion['fecha_inicio'];

            $idLicencia = $this->Vistaoperacion->find()->select(['licencia_id'])->where(['id' => $idOperacion])->first();
            $idLicencia2 = $idLicencia['licencia_id'];

            date_default_timezone_set('America/Santiago');

            $fechaAsignacion = date('Y/m/d H:i:sA');

            $asignacion2->set('sapdescarga_id',$idDescarga);
            $asignacion2->set('operacionasignable_id',$idOperacion);
            $asignacion2->set('licencia_id',$idLicencia2);
            $asignacion2->set('ton_asignadas',$valor);
            $asignacion2->set('annio',$annioOperacion2);
            $asignacion2->set('fecha_vigente',$fechaOperacion2);
            $asignacion2->set('fecha_asignacion',$fechaAsignacion);
            $asignacion2->set('ton_operacion',$tonOperacionFijo2);
            $asignacion2->set('tipo_asignacion','P');
            $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
            $asignacion2->set('division', $divisionDescarga2);

            if($this->Asignado->save($asignacion2)){
                $status = 'success';
            }else {
                $status = 'error';
            }
            
        }

          $this->set([
            'descargas' => $descargas,
            'operacion' => $operacion,
            'draw' => $this->request->data('draw'),
            'status' => $status,
            '_serialize' => [
                'descargas',
                'operacion',
                'draw',
                'status'
            ]
        ]);

        

        
    }

    public function addDescarguita(){

        $idDescarga = filter_input(INPUT_POST, 'descarga');
        $tonDescarga = $this->Vistadescarga->find()->select(['saldo'])->where(['id' => $idDescarga])->first();
        $tonDescarga2 = $tonDescarga['saldo'];
  
        // $annioDescarga = $this->Vistadescarga->find()->select(['annio'])->where(['id' => $idOperacion])->first();
        // $annioDescarga2 = $annioDescarga['annio'];

        $divisionDescarga = $this->Vistadescarga->find()->select(['division'])->where(['id' => $idDescarga])->first();
        $divisionDescarga2 = $divisionDescarga['division'];
  
        $fechaDescarga = $this->Vistadescarga->find()->select(['fecha_ini_des'])->where(['id' => $idDescarga])->first();
        $fechaDescarga2 = $fechaDescarga['fecha_ini_des'];
  
        $tipoDescarga = $this->Vistadescarga->find()->select(['tipo_descarga'])->where(['id' => $idDescarga])->first();
        $tipoDescarga2 = $tipoDescarga['tipo_descarga'];
  
        date_default_timezone_set('America/Santiago');
  
        $fechaAsignacion = date('Y/m/d H:i:sA');
  
        $asignacion2 = $this->Asignado->newEntity();
  
        if($tipoDescarga2 == 'A'){
          $asignacion2->set('sapdescarga_id',$idDescarga);
          // $asignacion2->set('operacionasignable_id','NULL');
          // $asignacion2->set('licencia_id', );
          $asignacion2->set('ton_asignadas',$tonDescarga2);
          $asignacion2->set('annio',2019);
          $asignacion2->set('fecha_vigente',$fechaDescarga2);
          $asignacion2->set('fecha_asignacion',$fechaAsignacion);
          $asignacion2->set('ton_operacion',$tonDescarga2);
          $asignacion2->set('tipo_asignacion','D');
          $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
          $asignacion2->set('division', $divisionDescarga2);
  
          if($this->Asignado->save($asignacion2)){
              $status = 'success';
          }else {
            $status = 'error';
          }
  
        }elseif($tipoDescarga2 == 'P'){
            $asignacion2->set('sapdescarga_id',$idDescarga);
            // $asignacion2->set('operacionasignable_id','NULL');
          //   $asignacion2->set('licencia_id', );
            $asignacion2->set('ton_asignadas',$tonDescarga2);
            $asignacion2->set('annio',2019);
            $asignacion2->set('fecha_vigente',$fechaDescarga2);
            $asignacion2->set('fecha_asignacion',$fechaAsignacion);
            $asignacion2->set('ton_operacion',$tonDescarga2);
            $asignacion2->set('tipo_asignacion','D');
            $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
            $asignacion2->set('division', $divisionDescarga2);
  
            if($this->Asignado->save($asignacion2)){
                $status = 'success';
            }else {
              $status = 'error';
            }
  
          }
  
        $this->set([
            'asignacion' => $asignacion2,
            'status' => $status,
            'errors' => $asignacion2->errors(),
            '_serialize' => ['asignacion', 'status', 'errors']
        ]);
      }

      public function addBolson(){

        $idDescarga = filter_input(INPUT_POST, 'descarga');
        $tonDescarga = $this->Vistadescarga->find()->select(['saldo'])->where(['id' => $idDescarga])->first();
        $tonDescarga2 = $tonDescarga['saldo'];
  
        // $annioDescarga = $this->Vistadescarga->find()->select(['annio'])->where(['id' => $idOperacion])->first();
        // $annioDescarga2 = $annioDescarga['annio'];

        $divisionDescarga = $this->Vistadescarga->find()->select(['division'])->where(['id' => $idDescarga])->first();
        $divisionDescarga2 = $divisionDescarga['division'];
  
        $fechaDescarga = $this->Vistadescarga->find()->select(['fecha_ini_des'])->where(['id' => $idDescarga])->first();
        $fechaDescarga2 = $fechaDescarga['fecha_ini_des'];
  
        $tipoDescarga = $this->Vistadescarga->find()->select(['tipo_descarga'])->where(['id' => $idDescarga])->first();
        $tipoDescarga2 = $tipoDescarga['tipo_descarga'];
  
        date_default_timezone_set('America/Santiago');
  
        $fechaAsignacion = date('Y/m/d H:i:sA');
  
        $asignacion2 = $this->Asignado->newEntity();
  
        if($tipoDescarga2 == 'A'){
          $asignacion2->set('sapdescarga_id',$idDescarga);
          // $asignacion2->set('operacionasignable_id','NULL');
          // $asignacion2->set('licencia_id', );
          $asignacion2->set('ton_asignadas',$tonDescarga2);
          $asignacion2->set('annio',2019);
          $asignacion2->set('fecha_vigente',$fechaDescarga2);
          $asignacion2->set('fecha_asignacion',$fechaAsignacion);
          $asignacion2->set('ton_operacion',$tonDescarga2);
          $asignacion2->set('tipo_asignacion','B');
          $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
          $asignacion2->set('division', $divisionDescarga2);
  
          if($this->Asignado->save($asignacion2)){
              $status = 'success';
          }else {
            $status = 'error';
          }
  
        }elseif($tipoDescarga2 == 'P'){
            $asignacion2->set('sapdescarga_id',$idDescarga);
            // $asignacion2->set('operacionasignable_id','NULL');
          //   $asignacion2->set('licencia_id', );
            $asignacion2->set('ton_asignadas',$tonDescarga2);
            $asignacion2->set('annio',2019);
            $asignacion2->set('fecha_vigente',$fechaDescarga2);
            $asignacion2->set('fecha_asignacion',$fechaAsignacion);
            $asignacion2->set('ton_operacion',$tonDescarga2);
            $asignacion2->set('tipo_asignacion','B');
            $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
            $asignacion2->set('division', $divisionDescarga2);
  
            if($this->Asignado->save($asignacion2)){
                $status = 'success';
            }else {
              $status = 'error';
            }
  
          }
  
        $this->set([
            'asignacion' => $asignacion2,
            'status' => $status,
            'errors' => $asignacion2->errors(),
            '_serialize' => ['asignacion', 'status', 'errors']
        ]);
      }

    public function addCuentaCorriente(){
        $idDescarga = filter_input(INPUT_POST, 'descarga');
        $tonDescarga = $this->Vistadescarga->find()->select(['saldo'])->where(['id' => $idDescarga])->first();
        $tonDescarga2 = $tonDescarga['saldo'];
  
        // $annioDescarga = $this->Vistadescarga->find()->select(['annio'])->where(['id' => $idOperacion])->first();
        // $annioDescarga2 = $annioDescarga['annio'];

        $divisionDescarga = $this->Vistadescarga->find()->select(['division'])->where(['id' => $idDescarga])->first();
        $divisionDescarga2 = $divisionDescarga['division'];
  
        $fechaDescarga = $this->Vistadescarga->find()->select(['fecha_ini_des'])->where(['id' => $idDescarga])->first();
        $fechaDescarga2 = $fechaDescarga['fecha_ini_des'];
  
        $tipoDescarga = $this->Vistadescarga->find()->select(['tipo_descarga'])->where(['id' => $idDescarga])->first();
        $tipoDescarga2 = $tipoDescarga['tipo_descarga'];
  
        date_default_timezone_set('America/Santiago');
  
        $fechaAsignacion = date('Y/m/d H:i:sA');
  
        $asignacion2 = $this->Asignado->newEntity();
  
        if($tipoDescarga2 == 'A'){
          $asignacion2->set('sapdescarga_id',$idDescarga);
          // $asignacion2->set('operacionasignable_id','NULL');
          // $asignacion2->set('licencia_id', );
          $asignacion2->set('ton_asignadas',$tonDescarga2);
          $asignacion2->set('annio',2019);
          $asignacion2->set('fecha_vigente',$fechaDescarga2);
          $asignacion2->set('fecha_asignacion',$fechaAsignacion);
          $asignacion2->set('ton_operacion',$tonDescarga2);
          $asignacion2->set('tipo_asignacion','C');
          $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
          $asignacion2->set('division', $divisionDescarga2);
  
          if($this->Asignado->save($asignacion2)){
              $status = 'success';
          }else {
            $status = 'error';
          }
  
        }elseif($tipoDescarga2 == 'P'){
            $asignacion2->set('sapdescarga_id',$idDescarga);
            // $asignacion2->set('operacionasignable_id','NULL');
          //   $asignacion2->set('licencia_id', );
            $asignacion2->set('ton_asignadas',$tonDescarga2);
            $asignacion2->set('annio',2019);
            $asignacion2->set('fecha_vigente',$fechaDescarga2);
            $asignacion2->set('fecha_asignacion',$fechaAsignacion);
            $asignacion2->set('ton_operacion',$tonDescarga2);
            $asignacion2->set('tipo_asignacion','C');
            $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
            $asignacion2->set('division', $divisionDescarga2);
  
            if($this->Asignado->save($asignacion2)){
                $status = 'success';
            }else {
              $status = 'error';
            }
  
          }
  
        $this->set([
            'asignacion' => $asignacion2,
            'status' => $status,
            'errors' => $asignacion2->errors(),
            '_serialize' => ['asignacion', 'status', 'errors']
        ]);
      }

      public function addDaJurel(){
        $idDescarga = filter_input(INPUT_POST, 'descarga');
        $tonDescarga = $this->Vistadescarga->find()->select(['saldo'])->where(['id' => $idDescarga])->first();
        $tonDescarga2 = $tonDescarga['saldo'];
  
        // $annioDescarga = $this->Vistadescarga->find()->select(['annio'])->where(['id' => $idOperacion])->first();
        // $annioDescarga2 = $annioDescarga['annio'];

        $divisionDescarga = $this->Vistadescarga->find()->select(['division'])->where(['id' => $idDescarga])->first();
        $divisionDescarga2 = $divisionDescarga['division'];
  
        $fechaDescarga = $this->Vistadescarga->find()->select(['fecha_ini_des'])->where(['id' => $idDescarga])->first();
        $fechaDescarga2 = $fechaDescarga['fecha_ini_des'];
  
        $tipoDescarga = $this->Vistadescarga->find()->select(['tipo_descarga'])->where(['id' => $idDescarga])->first();
        $tipoDescarga2 = $tipoDescarga['tipo_descarga'];
  
        date_default_timezone_set('America/Santiago');
  
        $fechaAsignacion = date('Y/m/d H:i:sA');
  
        $asignacion2 = $this->Asignado->newEntity();
  
        if($tipoDescarga2 == 'A'){
          $asignacion2->set('sapdescarga_id',$idDescarga);
          // $asignacion2->set('operacionasignable_id','NULL');
          // $asignacion2->set('licencia_id', );
          $asignacion2->set('ton_asignadas',$tonDescarga2);
          $asignacion2->set('annio',2019);
          $asignacion2->set('fecha_vigente',$fechaDescarga2);
          $asignacion2->set('fecha_asignacion',$fechaAsignacion);
          $asignacion2->set('ton_operacion',$tonDescarga2);
          $asignacion2->set('tipo_asignacion','DAJ');
          $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
          $asignacion2->set('division', $divisionDescarga2);
  
          if($this->Asignado->save($asignacion2)){
              $status = 'success';
          }else {
            $status = 'error';
          }
  
        }elseif($tipoDescarga2 == 'P'){
            $asignacion2->set('sapdescarga_id',$idDescarga);
            // $asignacion2->set('operacionasignable_id','NULL');
          //   $asignacion2->set('licencia_id', );
            $asignacion2->set('ton_asignadas',$tonDescarga2);
            $asignacion2->set('annio',2019);
            $asignacion2->set('fecha_vigente',$fechaDescarga2);
            $asignacion2->set('fecha_asignacion',$fechaAsignacion);
            $asignacion2->set('ton_operacion',$tonDescarga2);
            $asignacion2->set('tipo_asignacion','DAJ');
            $asignacion2->set('usuario_uid', $this->Auth->user('uid'));
            $asignacion2->set('division', $divisionDescarga2);
  
            if($this->Asignado->save($asignacion2)){
                $status = 'success';
            }else {
              $status = 'error';
            }
  
          }
  
        $this->set([
            'asignacion' => $asignacion2,
            'status' => $status,
            'errors' => $asignacion2->errors(),
            '_serialize' => ['asignacion', 'status', 'errors']
        ]);
      }
    

}

