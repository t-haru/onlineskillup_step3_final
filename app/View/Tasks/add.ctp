<?php $this->assign('title', 'ToDoを追加') ?>

<h1>新しくToDoを追加する</h1>

<?php echo $this->Html->link('ホームに戻る', 'index'); ?>

<?php echo $this->Form->create('Task'); ?>
<p><?php echo $this->Form->input('todo', array(
	'label' => 'ToDo',
	'required' => false
)); ?></p>

<p><?php echo $this->Form->input('date', array(
	'type' => 'date',
	'label' => '期限',
	'dateFormat' => 'YMD',
	'monthNames' => false,
	'minYear' => date('Y'),
	'maxYear' => date('Y') + 2,
	'empty' => '---',
	'separator' => array('年', '月', '日')
));?></p>

<p><?php echo $this->Form->input('time', array(
	'type' => 'time',
	'label' => false,
	'timeFormat' => 24,
	'empty' => '---'
));?></p>

<p><?php echo '所要時間' . $this->Form->select('hour', $number_hour, array(
	'div' => false,
	'required' => false
)) . "時間"; ?>
<?php echo $this->Form->select('minute', $number_minute, array(
	'required' => false
)) . "分"; ?></p>

<p><?php echo $this->Form->input('追加', array(
	'type' => 'submit',
	'id' => 'AddSubmit',
	'label' => false,
)); ?></p>
<?php echo $this->Form->end(); ?>

<?php //debug($this->request->data); ?>

<hr>
<h3>最近の更新</h3>
<div id="latest"></div>
