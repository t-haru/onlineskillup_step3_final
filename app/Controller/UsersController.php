<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {
  /*
   * 初めに実行される関数
   */
  public function beforeFilter() {
    parent::beforeFilter();
    $this->Auth->deny('index', 'logout');
  }

  /*
   * ログイン後にリダイレクトされる
   */
  public function index() {
    $this->set('user', $this->Auth->user());
    $this->redirect('/tasks/index');
  }

  /*
	* 新規登録
	*/
  public function register() {
    if($this->request->is('post') && $this->User->save($this->request->data)) {
      $username = $this->request->data['User']['username'];
      $this->Session->write('username', $username);
      $this->redirect('complete');
    }
  }

  /*
	* 新規登録の完了
	*/
  public function complete() {
    if($this->Auth->login()){
      $this->redirect('/tasks/index');
    }else{
      $username = $this->Session->read('username');
      $this->set('username', $username);
    }
  }

  /*
	* ログイン
	*/
  public function login() {
    if($this->request->is('post')) {
      if($this->Auth->login()) {
        $this->redirect('index');
      }else{
        $this->Flash->set('ユーザー名とパスワードの組み合わせが違います');
      }
    }
  }

  /*
	* ログアウト
	*/
  public function logout() {
    $this->Auth->logout();
    $this->redirect('login');
  }
}
