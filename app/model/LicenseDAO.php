<?php
namespace rosasurfer\bfx\model;

use rosasurfer\db\orm\DAO;

use const rosasurfer\db\orm\meta\INT;
use const rosasurfer\db\orm\meta\STRING;


/**
 * DAO for accessing {@link License} instances.
 */
class LicenseDAO extends DAO {


    /**
     * {@inheritdoc}
     */
    public function getMapping() {
        static $mapping; return $mapping ?: ($mapping=$this->parseMapping([
            'connection' => 'bfx',
            'table'      => 't_license',
            'class'      => License::class,
            'properties' => [
                ['name'=>'id',       'type'=>INT,    'primary'=>true],    // db:int
                ['name'=>'created',  'type'=>STRING,                ],    // db:text[datetime] GMT
                ['name'=>'modified', 'type'=>STRING, 'version'=>true],    // db:text[datetime] GMT
            ],
        ]));
    }
}
