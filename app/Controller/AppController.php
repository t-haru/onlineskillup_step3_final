<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {
    //テーブルの指定
    public $usesTable = array('User', 'Todo');
    //コンポーネントの指定
    public $components = array('Auth', 'Flash', 'Session', 'Paginator');

    public function beforeFilter() {
        $this->Auth->allow();
        $user = $this->Auth->user();
        $this->set('user', $user);

        $this->layout = 'main';
    }

    public $helpers = array(
	 		'Session',
	 		'Html' => array('className' => 'TwitterBootstrap.BootstrapHtml'),
	 		'Form' => array('className' => 'TwitterBootstrap.BootstrapForm'),
	 		'Paginator' => array('className' => 'TwitterBootstrap.BootstrapPaginator'),
	 );
}
