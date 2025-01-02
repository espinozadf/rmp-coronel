<?php
namespace App\Model\Table;

use App\Model\Entity\Vistaoperacion;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;


/**
 * Vistaoperacion Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Licencias
 * @property \Cake\ORM\Association\BelongsTo $Especies
 * @property \Cake\ORM\Association\BelongsTo $TipoLicencias
 * @property \Cake\ORM\Association\BelongsTo $Naves
 *
 * @method \App\Model\Entity\Vistaoperacion get($primaryKey, $options = [])
 * @method \App\Model\Entity\Vistaoperacion newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Vistaoperacion[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Vistaoperacion|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Vistaoperacion patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Vistaoperacion[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Vistaoperacion findOrCreate($search, callable $callback = null)
 */
class VistaoperacionTable extends Table
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

        $this->table('vistaoperacion');
        $this->primaryKey('id');
        $this->belongsTo('Licencias', [
            'foreignKey' => 'licencia_id'
        ]);
        $this->belongsTo('Especies', [
            'foreignKey' => 'especie_id'
        ]);
        $this->belongsTo('TipoLicencias', [
            'foreignKey' => 'tipo_licencia_id'
        ]);
        $this->belongsTo('Naves', [
            'foreignKey' => 'nave_id'
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
        // $validator
        //     ->requirePresence('id', 'create')
        //     ->notEmpty('id');

        $validator
            ->allowEmpty('resolucion');

        $validator
            ->allowEmpty('annio');

        $validator
            ->date('fecha_inicio')
            ->allowEmpty('fecha_inicio');

        $validator
            ->numeric('cantidad')
            ->allowEmpty('cantidad');

        $validator
            ->numeric('saldo')
            ->allowEmpty('saldo');

        $validator
            ->integer('bandera')
            ->allowEmpty('bandera');

        $validator
            ->integer('licencia_tipo_origen_id')
            ->allowEmpty('licencia_tipo_origen_id');
            
            $validator
            ->integer('division')
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
        $rules->add($rules->existsIn(['especie_id'], 'Especies'));
        $rules->add($rules->existsIn(['tipo_licencia_id'], 'TipoLicencias'));
        $rules->add($rules->existsIn(['nave_id'], 'Naves'));

        return $rules;
    }
}
