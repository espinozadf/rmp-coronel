<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TipoOrigenesLicencia Model
 *
 * @method \App\Model\Entity\TipoOrigenesLicencium get($primaryKey, $options = [])
 * @method \App\Model\Entity\TipoOrigenesLicencium newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TipoOrigenesLicencium[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TipoOrigenesLicencium|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TipoOrigenesLicencium patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TipoOrigenesLicencium[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TipoOrigenesLicencium findOrCreate($search, callable $callback = null)
 */
class TipoOrigenesLicenciaTable extends Table
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

        $this->table('tipo_origenes_licencia');
        $this->displayField('nombre');
        $this->primaryKey('id');
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
            ->requirePresence('nombre', 'create')
            ->notEmpty('nombre');

        return $validator;
    }
}
