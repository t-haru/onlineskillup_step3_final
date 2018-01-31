<?php
App::uses('AppModel', 'Model');

class User extends AppModel {
  //入力チェック
  public $validate = array(
    'username' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'ユーザー名を入力してください',
        'last' => false
      ),
      array(
        'rule' => 'isUnique',
        'message' => '入力したユーザー名はすでに存在しています',
        'last' => false
      ),
      array(
        'rule' => array('between',4,20),
        'message' => 'ユーザー名は4文字以上20文字以内で入力してください',
        'last' => false
      ),
      array(
        'rule' => '/^[0-9a-zA-Z_]{4,20}$/',
        'message' => 'ユーザー名は半角英数字または「_」で入力してください'
      )
    ),
    'password' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'パスワードを入力してください',
        'last' => false
      ),
      array(
        'rule' => 'alphaNumeric',
        'message' => 'パスワードは半角英数字で入力してください',
        'last' => false
      ),
      array(
        'rule' => array('between',4,16),
        'message' => 'パスワードは4文字以上16文字以内で入力してください',
        'last' => false
      )
    ),
    'password_confirm' => array(
      array(
        'rule' => 'notBlank',
        'message' => 'パスワード（確認）を入力してください',
        'last' => false
      ),
      array(
        'rule' => 'passwordConfirm',
        'message' => 'パスワードが一致していません'
      )
    )
  );

  // パスワードのハッシュ化
  public function beforeSave($options = array()) {
    $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
    return true;
  }

  // パスワードの一致を確認
  public function passwordConfirm($check) {
    if($this->data['User']['password'] === $this->data['User']['password_confirm']){
        return true;
    }else{
        return false;
    }
  }
}
