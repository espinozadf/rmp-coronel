<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

class Tcs extends Entity{
    protected $_accessible = [
        '*' => true,
        'id' => true,
        'tcs' => true,
        'nave' => true
    ];
}

?>


