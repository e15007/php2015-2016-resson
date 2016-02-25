<?php
namespace App\Model\Table;
 
use App\Model\Entity\Member;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
 
class MembersTable extends Table
{
	 
	public function initialize(array $config)
	{
		parent::initialize($config);
								 
		$this->table('members');
		$this->displayField('name');
		$this->primaryKey('id');
													 
		$this->hasMany('Messages', [
																'foreignKey' => 'members_id'
																]);
	}
	 
	public function validationDefault(Validator $validator)
	{
		$validator
							->add('id', 'valid', ['rule' => 'numeric'])
							->allowEmpty('id', 'create')
							->add($rules->existsIn('members_id', 'messages'));
											 
		$validator
							->requirePresence('name', 'create')
							->notEmpty('name');
											 
		$validator
							->allowEmpty('mail');
										 
		return $validator;
	}
}
