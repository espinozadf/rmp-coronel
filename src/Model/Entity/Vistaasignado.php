<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use Cake\ORM\TableRegistry;
/**
 * Vistaasignado Entity
 *
 * @property int $id
 * @property string $nombre_licencia
 * @property int $licencia_id
 * @property string $marea
 * @property int $sapdescarga_id
 * @property int $especie_id
 * @property string $di_da
 * @property string $especie
 * @property string $nave
 * @property string $razon_social
 * @property string $tcs
 * @property string $tipo_descarga
 * @property float $ton_des
 * @property float $ton_asig
 * @property \Cake\I18n\Time $fecha_vigente
 * @property int $annio
 * @property \Cake\I18n\Time $fecha_asignacion
 *
 * @property \App\Model\Entity\Licencia $licencia
 * @property \App\Model\Entity\Sapdescarga $sapdescarga
 * @property \App\Model\Entity\Especie $especy
 */
class Vistaasignado extends Entity
{
  protected $_accessible = [
      '*' => true,
      'id' => false,
  ];
}
