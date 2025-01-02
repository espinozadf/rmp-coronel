<?php
namespace App\Model\Table;

use App\Model\Entity\Vistadescarga;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Vistadescarga Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Especies
 *
 * @method \App\Model\Entity\Vistadescarga get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vistadescarga newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vistadescarga[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vistadescarga|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vistadescarga patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vistadescarga[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vistadescarga findOrCreate($search, callable $callback = null)
 */
class VistadescargaTable extends Table
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

        $this->table('vistadescarga');
        $this->primaryKey('id');
        $this->belongsTo('Especies', [
            'foreignKey' => 'especie_id'
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
            // ->integer('id')
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->allowEmpty('marea');

        $validator
            ->allowEmpty('di_da');

        $validator
            ->allowEmpty('especie');
            $validator
                ->allowEmpty('especie_id');
        $validator
            ->allowEmpty('recalada');

        $validator
            ->date('fecha_recalada')
            ->allowEmpty('fecha_recalada');

        $validator
            ->time('hora_recalada')
            ->allowEmpty('hora_recalada');

        $validator
            ->date('fecha_ini_des')
            ->allowEmpty('fecha_ini_des');

        $validator
            ->allowEmpty('matricula_nave');

        $validator
            ->allowEmpty('nave');

        $validator
            ->allowEmpty('tipo_nave');

        $validator
            ->allowEmpty('arte_pesca');

        $validator
            ->allowEmpty('tcs');

        $validator
            ->allowEmpty('tipo_descarga');

        $validator
            ->allowEmpty('zona_pesca');

        $validator
            ->numeric('ton')
            ->allowEmpty('ton');

        $validator
            ->numeric('saldo')
            ->allowEmpty('saldo');

        $validator
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');
        $validator
            ->allowEmpty('annio');

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
        $rules->add($rules->existsIn(['especie_id'], 'Especies'));

        return $rules;
    }
}
