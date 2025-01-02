<?php

namespace App\Model\Table;

use App\Model\Entity\Tcs;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\Validation\Validator;


class TcsTable extends Table{
    
    public function initialize(array $config)
    {
        parent::initialize($config);
        // $this->addBehavior('Timestamp');
        $this->table('Bd_Modelo_Descargas_Pesca_TCS');
        $this->primaryKey('id');
        $this->entityClass('App\Model\Entity\Tcs');
    }

    // public static function defaultConnectionName() {
    //     return 'tcsBD';
    // }


    public function validationDefault(Validator $validator)
    {
        $validator
            ->add('id', 'valid', ['rule' => 'numeric'])
            ->allowEmpty('id', 'create');

            $validator
            ->allowEmpty('tcs');

        $validator
            ->allowEmpty('nave');

       

        return $validator;
    }
    public function buildRules(RulesChecker $rules)
    {
        //$rules->add($rules->existsIn(['encargado_id'], 'Auxiliares'));
        return $rules;
    }
}


?>