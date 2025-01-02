<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VistaasignadoFixture
 *
 */
class VistaasignadoFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'vistaasignado';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => '10', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'nombre_licencia' => ['type' => 'string', 'length' => '63', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'licencia_id' => ['type' => 'integer', 'length' => '10', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'marea' => ['type' => 'string', 'length' => '120', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'sapdescarga_id' => ['type' => 'string', 'length' => '400', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'especie_id' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'di_da' => ['type' => 'string', 'length' => '30', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'especie' => ['type' => 'string', 'length' => '80', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'nave' => ['type' => 'string', 'length' => '160', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'razon_social' => ['type' => 'string', 'length' => '300', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'tcs' => ['type' => 'string', 'length' => '300', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'tipo_descarga' => ['type' => 'string', 'length' => '10', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'ton_des' => ['type' => 'decimal', 'length' => '10', 'precision' => '3', 'null' => true, 'default' => null, 'comment' => null, 'unsigned' => null],
        'ton_asig' => ['type' => 'decimal', 'length' => '10', 'precision' => '3', 'null' => true, 'default' => null, 'comment' => null, 'unsigned' => null],
        'fecha_vigente' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        'annio' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'fecha_asignacion' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 1,
            'nombre_licencia' => 'Lorem ipsum dolor sit amet',
            'licencia_id' => 1,
            'marea' => 'Lorem ipsum dolor sit amet',
            'sapdescarga_id' => 'Lorem ipsum dolor sit amet',
            'especie_id' => 1,
            'di_da' => 'Lorem ipsum dolor sit amet',
            'especie' => 'Lorem ipsum dolor sit amet',
            'nave' => 'Lorem ipsum dolor sit amet',
            'razon_social' => 'Lorem ipsum dolor sit amet',
            'tcs' => 'Lorem ipsum dolor sit amet',
            'tipo_descarga' => 'Lorem ip',
            'ton_des' => 1.5,
            'ton_asig' => 1.5,
            'fecha_vigente' => '2019-09-06',
            'annio' => 1,
            'fecha_asignacion' => 1567796868
        ],
    ];
}
