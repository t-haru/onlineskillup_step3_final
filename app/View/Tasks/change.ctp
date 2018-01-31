<?php $this->assign('title', 'ToDoを変更') ?>

<h1>ToDoを変更する</h1>

<?php echo $this->Form->create('Task'); ?>
<p><?php echo $this->Form->input('todo', array(
	'label' => 'ToDo',
	'required' => false,
	'value' => $task['Task']['todo']
)); ?></p>

<p><?php echo $this->Form->input('date', array(
	'type' => 'date',
	'label' => '期限',
	'dateFormat' => 'YMD',
	'monthNames' => false,
	'minYear' => date('Y'),
	'maxYear' => date('Y') + 2,
	'empty' => '---',
	'separator' => array('年', '月', '日'),
	'value' => $task['Task']['date']
));?></p>

<p><?php echo '　　' . $this->Form->input('time', array(
	'type' => 'time',
	'label' => false,
	'timeFormat' => 24,
	'empty' => '---',
	'div' =>false,
	'value' => $task['Task']['time']
));?></p>

<p><?php echo '所要時間' . $this->Form->select('hour', $number_hour, array(
	'div' => false,
	'required' => false,
	'value' => $task['Task']['hour']
)) . "時間"; ?>
<?php echo $this->Form->select('minute', $number_minute, array(
	'required' => false,
	'value' => $task['Task']['minute']
)) . "分"; ?></p>

<p><?php $status_list = array('incomplete' => '未完了', 'complete' => '完了'); ?>
<?php echo "状態" . $this->Form->input('status', array(
	'type' => 'select',
	'label' => false,
	'div' => false,
	'selected' => $task['Task']['status'],
	'options' => $status_list
)); ?></p>

<p><?php echo $this->Form->input('変更', array(
	'type' => 'submit',
	'id' => 'ChangeSubmit',
	'label' => false
)); ?></p>
<?php echo $this->Form->end(); ?>
