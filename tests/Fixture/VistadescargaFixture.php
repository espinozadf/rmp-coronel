<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * VistadescargaFixture
 *
 */
class VistadescargaFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'vistadescarga';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'id' => ['type' => 'string', 'length' => '400', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'marea' => ['type' => 'string', 'length' => '120', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'di_da' => ['type' => 'string', 'length' => '30', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'especie_id' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
        'especie' => ['type' => 'string', 'length' => '80', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'recalada' => ['type' => 'string', 'length' => '120', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'fecha_recalada' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        'fecha_ini_des' => ['type' => 'date', 'length' => null, 'null' => true, 'default' => null, 'precision' => null, 'comment' => null],
        'matricula_nave' => ['type' => 'string', 'length' => '30', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'nave' => ['type' => 'string', 'length' => '160', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'tipo_nave' => ['type' => 'string', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'tcs' => ['type' => 'string', 'length' => '300', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'tipo_descarga' => ['type' => 'string', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'zona_pesca' => ['type' => 'string', 'length' => '20', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'ton' => ['type' => 'decimal', 'length' => '10', 'precision' => '3', 'null' => true, 'default' => null, 'comment' => null, 'unsigned' => null],
        'saldo' => ['type' => 'decimal', 'length' => '38', 'precision' => '3', 'null' => true, 'default' => null, 'comment' => null, 'unsigned' => null],
        'estado' => ['type' => 'string', 'length' => '10', 'null' => false, 'default' => null, 'precision' => null, 'comment' => null, 'fixed' => null, 'collate' => null],
        'annio' => ['type' => 'integer', 'length' => '10', 'null' => true, 'default' => null, 'precision' => null, 'comment' => null, 'unsigned' => null, 'autoIncrement' => null],
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
            'marea' => 'Lorem ipsum dolor sit amet',
            'di_da' => 'Lorem ipsum dolor sit amet',
            'especie_id' => 1,
            'especie' => 'Lorem ipsum dolor sit amet',
            'recalada' => 'Lorem ipsum dolor sit amet',
            'fecha_recalada' => '2019-09-06',
            'fecha_ini_des' => '2019-09-06',
            'matricula_nave' => 'Lorem ipsum dolor sit amet',
            'nave' => 'Lorem ipsum dolor sit amet',
            'tipo_nave' => 'Lorem ip',
            'tcs' => 'Lorem ipsum dolor sit amet',
            'tipo_descarga' => 'Lorem ip',
            'zona_pesca' => 'Lorem ipsum dolor ',
            'ton' => 1.5,
            'saldo' => 1.5,
            'estado' => 'Lorem ip',
            'annio' => 1
        ],
    ];
}
