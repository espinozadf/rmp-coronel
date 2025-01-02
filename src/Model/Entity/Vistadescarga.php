<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
/**
 * Vistadescarga Entity
 *
 * @property int $id
 * @property string $marea
 * @property string $di_da
 * @property int $especie_id
 * @property string $especie
 * @property string $recalada
 * @property \Cake\I18n\Time $fecha_recalada
 * @property \Cake\I18n\Time $hora_recalada
 * @property \Cake\I18n\Time $fecha_ini_des
 * @property string $matricula_nave
 * @property string $nave
 * @property string $tipo_nave
 * @property string $arte_pesca
 * @property string $tcs
 * @property string $tipo_descarga
 * @property string $zona_pesca
 * @property float $ton
 * @property float $saldo
 * @property string $estado
 *
 * @property \App\Model\Entity\Especie $especy
 */
class Vistadescarga extends Entity
{
    protected $_accessible = [
        '*' => true,
        'id' => false,
    ];
}
