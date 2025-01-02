<?php
namespace App\Model\Table;

use App\Model\Entity\Vistaasignado;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Vistaasignado Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Licencias
 * @property \Cake\ORM\Association\BelongsTo $Sapdescargas
 * @property \Cake\ORM\Association\BelongsTo $Especies
 *
 * @method \App\Model\Entity\Vistaasignado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vistaasignado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vistaasignado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vistaasignado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vistaasignado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vistaasignado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vistaasignado findOrCreate($search, callable $callback = null)
 */
class VistaasignadoTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('vistaasignado');

        $this->belongsTo('Licencias', [
            'foreignKey' => 'licencia_id',
            'joinType' => 'LEFT'
        ]);
        $this->belongsTo('Sapdescargas', [
            'foreignKey' => 'sapdescarga_id'
        ]);
        $this->belongsTo('Especies', [
            'foreignKey' => 'especie_id',
            'joinType' => 'LEFT'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->allowEmpty('nombre_licencia');

        $validator
            ->allowEmpty('marea');

        $validator
            ->allowEmpty('di_da');

        $validator
            ->allowEmpty('especie');

        $validator
            ->allowEmpty('nave');

        $validator
            ->allowEmpty('razon_social');

        $validator
            ->allowEmpty('tcs');
            
        $validator
            ->allowEmpty('tipo_descarga_a');


        $validator
            ->allowEmpty('tipo_descarga');

        // $validator
        //     ->decimal('ton_des')
        //     ->allowEmpty('ton_des');
        //
        // $validator
        //     ->decimal('ton_asig')
        //     ->allowEmpty('ton_asig');
        $validator
            ->numeric('ton_des')
            ->allowEmpty('ton_des');

        $validator
            ->numeric('ton_asig')
            ->allowEmpty('ton_asig');
        $validator
            ->date('fecha_vigente')
            ->allowEmpty('fecha_vigente');

        $validator
            ->integer('annio')
            ->allowEmpty('annio');

        $validator
            ->dateTime('fecha_asignacion')
            ->allowEmpty('fecha_asignacion');
        $validator
            ->decimal('ton_operacion')
            ->allowEmpty('ton_operacion');

            $validator
            ->allowEmpty('tipo_asignacion');

            $validator
            ->allowEmpty('usuario');
            $validator
            ->allowEmpty('division');
        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['licencia_id'], 'Licencias'));
        $rules->add($rules->existsIn(['sapdescarga_id'], 'Sapdescargas'));
        $rules->add($rules->existsIn(['especie_id'], 'Especies'));

        return $rules;
    }
}
