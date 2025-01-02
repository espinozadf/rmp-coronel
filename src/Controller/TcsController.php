<?php
namespace App\Controller;

use App\Controller\AppController;

class TcsController extends AppController
{
    public function initialize(){
        parent::initialize();
        $this->loadModel('Vistadescarga');
        $this->loadModel('Naves');
    }
    
    public function isAuthorized($user = null)
    {
        if (in_array($this->request->action, ['index', 'listar']))
            return true;

          $tmp_permiso = false;
        switch ($this->request->action) {
            case 'add': $tmp_permiso = (bool)in_array('admin_tcs_add', $this->Auth->user('privilegios')); break;
            case 'edit': $tmp_permiso = (bool)in_array('admin_tcs_edit', $this->Auth->user('privilegios')); break;
            case 'delete': $tmp_permiso = (bool)in_array('admin_tcs_delete', $this->Auth->user('privilegios')); break;
        }
        return $tmp_permiso || parent::isAuthorized($user);
    }
    public function index()
    {

    }

    public function listar()
    {
        $tcs = $this->Tcs->find('all')
        ->select(['id','tcs','nave']);

        $this->set([
            'tcs' => $tcs,
            '_serialize' => ['tcs'],
        ]);
    }
    public function add(){
        $options = $this->Tcs->find('list', ['keyField' => 'tcs', 'valueField' => 'tcs']);
        
        // $naves = $this->Vistadescarga->find('list', ['keyField' => 'nave', 'valueField' => 'nave'])
        //         ->distinct(['Vistadescarga.nave'])
        //         // ->where(['division'=> $divisionUsuario])
        //         ->order(['Vistadescarga.nave' => 'ASC']);

        $naves = $this->Naves->find('list')
        ->select(['Naves.nombre'])
        ->order(['Naves.nombre' => 'ASC']);

        $status = 'success';
        $tcs = $this->Tcs->newEntity();
        
        if ($this->request->is('post')) {
            // $tcs = $this->Tcs->patchEntity($tcs, $this->request->data);
            $nave = $this->Naves->find()->select(['nombre'])->where(['id' => $this->request->data['nave']])->first();
            $nave2 = $nave['nombre'];
            $tcs->set('tcs',$this->request->data['tcs']);
            $tcs->set('nave',$nave2);

        

            if ($this->Tcs->save($tcs)) {
                $status = 'success';
            } else {
                $status = 'error';
            }
        }

        $this->set(compact('tcs', 'status','options','naves'));
        $this->set('_serialize', ['tcs']);
    }

    public function edit($id = null)
    {
        $options = $this->Tcs->find('list', ['keyField' => 'tcs', 'valueField' => 'tcs']);


        $status = 'success';
        $tcs = $this->Tcs->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tcs = $this->Tcs->patchEntity($tcs, $this->request->data);
            if ($this->Tcs->save($tcs)) {
                $status = 'success';
            } else {
                $status = 'error';
            }
        }
        $this->set(compact('tcs', 'status','options'));
        $this->set('_serialize', ['planta']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tcs = $this->Tcs->get($id);
        if ($this->Tcs->delete($tcs)) {
            $status = 'success';
        } else {
            $status = 'error';
        }

        $this->set(compact('status'));
    }
}


?>