<?php
namespace App\Controller;
 
use App\Controller\AppController;
use Cake\Datasource\ConnectionManager;
use Cake\Validation\Validator;
 
class PersonsController extends AppController{

	public $paginate = [
						'limit' => 5,
						'order' => [
													'Persons.name' => 'asc'
											]
										];

	public $helpers = [
		    'Paginator' => ['templates' => 
												'paginator-templates']
										];

	public function initialize()
	{
		parent::initialize();
		$this->loadComponent('Paginator');
	}
	 
	public function add()
	{
		$person = $this->Persons->newEntity();
		$this->set('person', $person);
		if ($this->request->is('post')) {
			$validator = new Validator();
			$validator->add(
									'age','comparison',['rule' =>['comparison','>',20]]
								);
			$errors = $validator->errors($this->request->data);
			if (!empty($errors)){
					$this->Flash->error('comparison error');
			} else {
				$person = $this->Persons->patchEntity($person, $this->request->data);
				if ($this->Persons->save($person)) {
					return $this->redirect(['action' => 'index']);
				}
			}
			if ($person->errors()){
				$this->Flash->error('please check entered values...');
			}
		}
	}

	public function index()
	{
		//$this->set('persons', $this->Persons->find('all'));
		$this->set('persons', $this->paginate());
	}

	public function edit($id = null)
	{
		$person = $this->Persons->get($id);
		if ($this->request->is(['post', 'put'])) {
			$person = $this->Persons->patchEntity($person, $this->request->data);
			if ($this->Persons->save($person)) {
				return $this->redirect(['action' => 'index']);
			}
		} else {
			$this->set('person', $person);
		}
	}

	public function delete($id = null)
	{
		$person = $this->Persons->get($id);
		if ($this->request->is(['post', 'put'])) {
			if ($this->Persons->delete($person)) {
				return $this->redirect(['action' => 'index']);
			}
		} else {
			$this->set('person', $person);
		}
	}

	public function find() {
		$persons = [];
		$this->set('msg', null);
		if ($this->request->is('post')) {
			$find = $this->request->data['find'];
/*
			$first = $this->Persons->find()
				            ->limit(1)
										->where(["name like " => '%' . $find . '%']);
			$this->set('msg', $first->first()->name . ' is first data.');

			$persons = $this->Persons->find()
											->offset(1)
											->limit(3)
											->select(['id', 'name'])
											->order(['name' =>'Asc'])
											->where(["name like " => '%' . $find . '%']);
 */
//			$persons = $this->Persons->findByName($find);
			/*
			$first = $this->Persons->find()
				            ->where(["name like " => '%' . $find . '%'])
										->first();
			$count = $last = $this->Persons->find()
								            ->where(["name like " => '%' . $find . '%'])
														->count();
			$last = $this->Persons->find()
								            ->offset($count - 1)
														->where(["name like " => '%' . $find . '%'])
														->first();
			$persons = $this->Persons->find()
								            ->where(["name like " => '%' . $find . '%']);
			$msg = 'FIRST: "' . $first->name . '", LAST: "' . $last->name . '". (' . $count . ')';
			$this->set('msg', $msg);
			$persons = $this->Persons->find()
				            ->where(["name like " => '%' . $find . '%'])
										->andWhere(["mail like " => '%' . $find . '%']);
			$query = $this->Persons->find();
			$exp = $query->newExpr();
			$fnc = function($exp, $f) {
							//			return $exp->gte('age', $find * 1);
									return $exp
													->isNotNull('name')
													->isNotNull('mail')
													->gt('age',0)
													->in('name', explode(',',$f));
							};
			$persons = $query->where($fnc($exp,$find));
			 */
			$connection = ConnectionManager::get('default');
			$query = 'select * from persons where ' . $find;
			$persons = $connection->query($query)->fetchAll('assoc');
		}    
		$this->set('persons', $persons);
	}

 
}
