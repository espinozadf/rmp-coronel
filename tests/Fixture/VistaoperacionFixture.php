<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VistaoperacionFixture
 *
 */
class VistaoperacionFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'vistaoperacion';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'length' => '90', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'resolucion' => ['type' => 'string', 'length' => '400', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'licencia_id' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'especie_id' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'tipo_licencia_id' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'nave_id' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'annio' => ['type' => 'string', 'length' => '8', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'fecha_inicio' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        'macro_zona' => ['type' => 'string', 'length' => '40', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'cantidad' => ['type' => 'decimal', 'length' => '10', 'precision' => '3', 'null' => true, 'default' => null, 'comment' => null, 'unsigned' => null],
        'saldo' => ['type' => 'decimal', 'length' => '38', 'precision' => '3', 'null' => true, 'default' => null, 'comment' => null, 'unsigned' => null],
        'bandera' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'id' => 'Lorem ipsum dolor sit amet',
            'resolucion' => 'Lorem ipsum dolor sit amet',
            'licencia_id' => 1,
            'especie_id' => 1,
            'tipo_licencia_id' => 1,
            'nave_id' => 1,
            'annio' => 'Lorem ',
            'fecha_inicio' => '2019-09-06',
            'macro_zona' => 'Lorem ipsum dolor sit amet',
            'cantidad' => 1.5,
            'saldo' => 1.5,
            'bandera' => 1
        ],
    ];
}
