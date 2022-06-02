<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Users Model
 *
 * @method \App\Model\Entity\User get($primaryKey, $options = [])
 * @method \App\Model\Entity\User newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\User[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\User|false save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User saveOrFail(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\User patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\User[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\User findOrCreate($search, callable $callback = null, $options = [])
 */
class UsersTable extends Table
{
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('IdUsuarios');
        $this->setPrimaryKey('IdUsuarios');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('IdUsuarios')
            ->allowEmptyString('IdUsuarios', null, 'create');

        $validator
            ->scalar('NumeroDocumentoIdentidad')
            ->maxLength('NumeroDocumentoIdentidad', 15)
            ->requirePresence('NumeroDocumentoIdentidad', 'create')
            ->notEmptyString('NumeroDocumentoIdentidad')
            ->add('NumeroDocumentoIdentidad', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('Nombres')
            ->maxLength('Nombres', 45)
            ->requirePresence('Nombres', 'create')
            ->notEmptyString('Nombres');

        $validator
            ->scalar('Apellidos')
            ->maxLength('Apellidos', 45)
            ->requirePresence('Apellidos', 'create')
            ->notEmptyString('Apellidos');

        $validator
            ->scalar('CorreoElectronico')
            ->maxLength('CorreoElectronico', 45)
            ->requirePresence('CorreoElectronico', 'create')
            ->notEmptyString('CorreoElectronico')
            ->add('CorreoElectronico', 'unique', ['rule' => 'validateUnique', 'provider' => 'table']);

        $validator
            ->scalar('Password')
            ->maxLength('Password', 255)
            ->requirePresence('Password', 'create')
            ->notEmptyString('Password');

        $validator
            ->integer('IdRoles')
            ->requirePresence('IdRoles', 'create')
            ->notEmptyString('IdRoles');

        $validator
            ->boolean('Estado')
            ->notEmptyString('Estado');

        $validator
            ->dateTime('FechaHoraCreacion')
            ->notEmptyDateTime('FechaHoraCreacion');

        $validator
            ->dateTime('FechaHoraModificacion')
            ->notEmptyDateTime('FechaHoraModificacion');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->isUnique(['CorreoElectronico']));
        $rules->add($rules->isUnique(['NumeroDocumentoIdentidad']));

        return $rules;
    }
}
