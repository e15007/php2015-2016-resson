<?php
namespace App\Controller;
 
use App\Controller\AppController;
 
class HeloController extends AppController
{
	public function initialize()
	{
		parent::initialize();
		$this->viewBuilder()->layout('sample');
		$this->set('header', '* this is sample site *');
		$this->set('footer', 'copyright 2015 libro.');
	}

	public function index($a = '')
	{
		$msg = "これは、サンプルアクションです。";
		$this->set('message', $msg);
	}
}
