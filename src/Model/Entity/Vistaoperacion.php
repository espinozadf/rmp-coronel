<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;

/**
 * Vistaoperacion Entity
 *
 * @property int $id
 * @property string $resolucion
 * @property int $licencia_id
 * @property int $especie_id
 * @property int $tipo_licencia_id
 * @property int $nave_id
 * @property string $annio
 * @property \Cake\I18n\Time $fecha_inicio
 * @property float $cantidad
 * @property float $saldo
 * @property int $bandera
 *
 * @property \App\Model\Entity\Licencia $licencia
 * @property \App\Model\Entity\Especie $especy
 * @property \App\Model\Entity\TipoLicencia $tipo_licencia
 * @property \App\Model\Entity\Nave $nave
 */
class Vistaoperacion extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
