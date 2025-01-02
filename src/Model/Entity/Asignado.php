<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
/**
 * Asignado Entity
 *
 * @property int $id
 * @property int $sapdescarga_id
 * @property int $operacionasignable_id
 * @property int $licencia_id
 * @property float $ton_asignadas
 * @property string $annio
 * @property \Cake\I18n\Time $fecha_vigente
 * @property \Cake\I18n\Time $fecha_asignacion
 *
 * @property \App\Model\Entity\Sapdescarga $sapdescarga
 * @property \App\Model\Entity\Operacionasignable $operacionasignable
 * @property \App\Model\Entity\Licencia $licencia
 */
class Asignado extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'id' => false
    ];
}