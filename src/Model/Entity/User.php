<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $IdUsuarios
 * @property string $NumeroDocumentoIdentidad
 * @property string $Nombres
 * @property string $Apellidos
 * @property string $CorreoElectronico
 * @property string $Password
 * @property int $IdRoles
 * @property bool $Estado
 * @property \Cake\I18n\FrozenTime $FechaHoraCreacion
 * @property \Cake\I18n\FrozenTime $FechaHoraModificacion
 */
class User extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'NumeroDocumentoIdentidad' => true,
        'Nombres' => true,
        'Apellidos' => true,
        'CorreoElectronico' => true,
        'Password' => true,
        'IdRoles' => true,
        'Estado' => true,
        'FechaHoraCreacion' => true,
        'FechaHoraModificacion' => true,
    ];
}
