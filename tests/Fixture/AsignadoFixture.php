<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AsignadoFixture
 *
 */
class AsignadoFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'asignado';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'integer', 'length' => '10', 'autoIncrement' => true, 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null],
        'sapdescarga_id' => ['type' => 'string', 'length' => '400', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'operacionasignable_id' => ['type' => 'string', 'length' => '100', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'licencia_id' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'ton_asignadas' => ['type' => 'decimal', 'length' => '10', 'precision' => '3', 'null' => true, 'default' => null, 'comment' => null, 'unsigned' => null],
        'annio' => ['type' => 'string', 'length' => '4', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'fecha_vigente' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        'fecha_asignacion' => ['type' => 'timestamp', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        'ton_operacion' => ['type' => 'decimal', 'length' => '10', 'precision' => '3', 'null' => true, 'default' => null, 'comment' => null, 'unsigned' => null],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['id'], 'length' => []],
            'FK__asignado__sapdes__381A47C8' => ['type' => 'foreign', 'columns' => ['sapdescarga_id'], 'references' => ['sapdescarga', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK__asignado__licenc__3631FF56' => ['type' => 'foreign', 'columns' => ['licencia_id'], 'references' => ['licencias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
            'FK__asignado__licenc__3726238F' => ['type' => 'foreign', 'columns' => ['licencia_id'], 'references' => ['licencias', 'id'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
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
            'sapdescarga_id' => 'Lorem ipsum dolor sit amet',
            'operacionasignable_id' => 'Lorem ipsum dolor sit amet',
            'licencia_id' => 1,
            'ton_asignadas' => 1.5,
            'annio' => 'Lo',
            'fecha_vigente' => '2019-09-06',
            'fecha_asignacion' => 1567797542,
            'ton_operacion' => 1.5
        ],
    ];
}
