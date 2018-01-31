<?php
App::uses('AppController', 'Controller');

class TasksController extends AppController {
	/*
	* 始めに実行される関数
	*/
	public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->deny('index', 'add', 'change', 'incomplete', 'complete');
  }

	/*
	* ホーム
	*/
	public function index() {
		$userid = $this->Session->read('Auth.User.id');
//		$this->set('userid', $userid);
		$paginate = array(
			'fields' => array('id', 'todo', 'date', 'time', 'hour', 'minute', 'status'),
			'conditions' => array('user_id' => $userid),
			'order' => array('date' => 'ASC'),
			'limit' => '10'
		);
		$this->Paginator->settings = $paginate;
		$tasks = $this->Paginator->paginate('Task');
		$this->set('tasks', $tasks);
	}

	/*
	* 未完了一覧
	*/
	public function incomplete() {
		$userid = $this->Session->read('Auth.User.id');
		$paginate = array(
			'fields' => array('id', 'todo', 'date', 'time', 'hour', 'minute', 'status'),
			'conditions' => array('user_id' => $userid, 'status' => 'incomplete'),
			'order' => array('date' => 'ASC'),
			'limit' => '10'
		);
		$this->Paginator->settings = $paginate;
		$tasks = $this->Paginator->paginate('Task');
		$this->set('tasks', $tasks);
	}

	/*
	* 完了一覧
	*/
	public function complete() {
		$userid = $this->Session->read('Auth.User.id');
		$paginate = array(
			'fields' => array('id', 'todo', 'date', 'time', 'hour', 'minute', 'status'),
			'conditions' => array('user_id' => $userid, 'status' => 'complete'),
			'order' => array('date' => 'ASC'),
			'limit' => '10'
		);
		$this->Paginator->settings = $paginate;
		$tasks = $this->Paginator->paginate('Task');
		$this->set('tasks', $tasks);
	}

	/*
	* ToDoを追加
	*/
	public function add() {
		$number_hour = $this->_selectRange(48);
		$this->set('number_hour', $number_hour);

		$number_minute = $this->_selectRange(59);
		$this->set('number_minute', $number_minute);
	}

	public function ajax_get_data() {
		$userid = $this->Session->read('Auth.User.id');
		$task = $this->Task->find('all', array(
			'conditions' => array('user_id' => $userid),
			'order' => array('created' => 'desc')
		));
		$this->viewClass = 'Json';
		$this->set(compact('task'));
		$this->set('_serialize', 'task');
	}

	public function ajax_submit() {
		$userid = $this->Session->read('Auth.User.id');
		if($this->request->is('ajax')) {
			$this->autoRender = false;
			$data = array(
				'Task' => array(
					'user_id' => $userid,
					'todo' => $this->data['todo'],
					'date' => $this->data['date'],
					'time' => $this->data['time'],
					'hour' => $this->data['hour'],
					'minute' => $this->data['minute'],
					'status' => 'incomplete'
				)
			);
			$this->Task->save($data);
		}
	}

	/*
	* 未完了を完了にする
	*/
	public function status($id) {
		$userid = $this->Session->read('Auth.User.id');
//			$this->set('userid', $userid);
		$task = $this->Task->findById($id);
//		$this->set('task', $task);
		if($task) {
			if($task['Task']['user_id'] == $userid) {
				$this->Task->id = $id;
				$this->Task->save(array('status' => 'complete'));
			}
		}
		$this->redirect($this->referer(array('action' => 'index')));
	}

	/*
	* ToDoを変更
	*/
	public function change($id) {
		$userid = $this->Session->read('Auth.User.id');

		$number_hour = $this->_selectRange(24);
		$this->set('number_hour', $number_hour);

		$number_minute = $this->_selectRange(59);
		$this->set('number_minute', $number_minute);

		$task = $this->Task->findById($id);
		if (!$task) {
      $this->redirect('index');
    }
		if($task['Task']['user_id'] == $userid) {
			$this->set('task', $task);
			if (!empty($this->request->data)) {
				$task['Task']['todo'] = $this->request->data('Task.todo');
				$task['Task']['date'] = $this->request->data('Task.date');
				$task['Task']['time'] = $this->request->data('Task.time');
				$task['Task']['hour'] = $this->request->data('Task.hour');
				$task['Task']['minute'] = $this->request->data('Task.minute');
				$task['Task']['status'] = $this->request->data('Task.status');
				$this->Task->save($task);
				$this->redirect('index');
	    }
		}
	}

	/*
	* ToDoを削除
	*/
	public function delete($id) {
		$userid = $this->Session->read('Auth.User.id');
		$task = $this->Task->findById($id);
		if($task['Task']['user_id'] == $userid) {
			$this->Task->delete($id);
			$this->redirect($this->referer(array('action' => 'index')));
		}
	}

	/*
	* セレクトボックスの数値をつくる
	*/
	public function _selectRange($max) {
		for($i = 0; $i <= $max; $i += 1) {
			$number[$i] = $i;
		}
		return $number;
	}
}
?>
