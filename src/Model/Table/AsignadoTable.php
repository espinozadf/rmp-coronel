<?php
namespace App\Model\Table;
use App\Model\Entity\Asignado;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Asignado Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Sapdescarga
 * @property \Cake\ORM\Association\BelongsTo $Operacionasignable
 * @property \Cake\ORM\Association\BelongsTo $Licencias
 *
 * @method \App\Model\Entity\Asignado get($primaryKey, $options = [])
 * @method \App\Model\Entity\Asignado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Asignado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Asignado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Asignado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Asignado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Asignado findOrCreate($search, callable $callback = null)
 */
class AsignadoTable extends Table
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

        $this->table('asignado');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Sapdescarga', [
            'foreignKey' => 'sapdescarga_id'
        ]);
        $this->belongsTo('Operacionasignable', [
            'foreignKey' => 'operacionasignable_id'
        ]);
        $this->belongsTo('Licencias', [
            'foreignKey' => 'licencia_id'
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
            ->allowEmpty('id', 'create');

        $validator
            ->decimal('ton_asignadas')
            ->allowEmpty('ton_asignadas');

        $validator
            ->allowEmpty('annio');

        $validator
            ->date('fecha_vigente')
            ->allowEmpty('fecha_vigente');

        $validator
            ->dateTime('fecha_asignacion')
            ->allowEmpty('fecha_asignacion');

        $validator
            ->requirePresence('usuario_uid', 'create')
            ->notEmpty('usuario_uid');

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
        $rules->add($rules->existsIn(['sapdescarga_id'], 'Sapdescarga'));
        $rules->add($rules->existsIn(['operacionasignable_id'], 'Operacionasignable'));
        $rules->add($rules->existsIn(['licencia_id'], 'Licencias'));

        return $rules;
    }
}
