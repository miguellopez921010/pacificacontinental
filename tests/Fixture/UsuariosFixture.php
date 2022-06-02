<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuariosFixture
 */
class UsuariosFixture extends TestFixture
{
    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'IdUsuarios' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'NumeroDocumentoIdentidad' => ['type' => 'string', 'length' => 15, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Nombres' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Apellidos' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'CorreoElectronico' => ['type' => 'string', 'length' => 45, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'Password' => ['type' => 'string', 'length' => 255, 'null' => false, 'default' => null, 'collate' => 'utf8mb4_general_ci', 'comment' => '', 'precision' => null, 'fixed' => null],
        'IdRoles' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'Estado' => ['type' => 'boolean', 'length' => null, 'null' => false, 'default' => '1', 'comment' => '1. Activo 0. Inactivo', 'precision' => null],
        'FechaHoraCreacion' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => 'current_timestamp()', 'comment' => '', 'precision' => null],
        'FechaHoraModificacion' => ['type' => 'timestamp', 'length' => null, 'null' => false, 'default' => 'current_timestamp()', 'comment' => '', 'precision' => null],
        '_indexes' => [
            'FK_usuarios_roles_idx' => ['type' => 'index', 'columns' => ['IdRoles'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['IdUsuarios'], 'length' => []],
            'Email_UNIQUE' => ['type' => 'unique', 'columns' => ['CorreoElectronico'], 'length' => []],
            'NumeroDocumentoIdentidad_UNIQUE' => ['type' => 'unique', 'columns' => ['NumeroDocumentoIdentidad'], 'length' => []],
            'FK_usuarios_roles' => ['type' => 'foreign', 'columns' => ['IdRoles'], 'references' => ['roles', 'IdRoles'], 'update' => 'noAction', 'delete' => 'noAction', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8mb4_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd
    /**
     * Init method
     *
     * @return void
     */
    public function init()
    {
        $this->records = [
            [
                'IdUsuarios' => 1,
                'NumeroDocumentoIdentidad' => 'Lorem ipsum d',
                'Nombres' => 'Lorem ipsum dolor sit amet',
                'Apellidos' => 'Lorem ipsum dolor sit amet',
                'CorreoElectronico' => 'Lorem ipsum dolor sit amet',
                'Password' => 'Lorem ipsum dolor sit amet',
                'IdRoles' => 1,
                'Estado' => 1,
                'FechaHoraCreacion' => '2022-06-02 14:44:43',
                'FechaHoraModificacion' => 1654199083,
            ],
        ];
        parent::init();
    }
}
