<?php
App::uses('AppModel', 'Model');

class Task extends AppModel {
	// 入力チェック
	public $validate = array(
		'todo' => array(
			array(
				'rule' => 'notBlank',
				'message' => 'ToDoを入力してください',
			),
			array(
				'rule' => array('between',1,140),
				'message' => 'ToDoは140文字以下で入力してください'
			)
		),
		'date' => array(
			array(
				'rule' => 'notBlank',
				'message' => '期限を入力してください'
			)
		),
		'time' => array(
			array(
				'rule' => 'notBlank',
				'message' => '期限を入力してください'
			)
		),
		'hour' => array(
			array(
				'rule' => array('naturalNumber', true),
				'message' => '所要時間は整数で入力してください'
			),
			array(
				'rule' => 'notBlank',
				'message' => '所要時間を入力してください'
			)
		),
		'minute' => array(
			array(
				'rule' => array('naturalNumber', true),
				'message' => '所要時間は整数で入力してください'
			),
			array(
				'rule' => 'notBlank',
				'message' => '所要時間を入力してください'
			)
		)
	);
}
