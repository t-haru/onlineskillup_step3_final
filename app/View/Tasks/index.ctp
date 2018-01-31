<?php $this->assign('title', 'ホーム') ?>

<h1>ホーム</h1>

<?php echo $this->Html->link('新しくToDoを追加する', 'add'); ?>

<div align="right"><?php echo $this->Html->link('未完了一覧', 'incomplete'); ?>
	<br>
<?php echo $this->Html->link('完了一覧', 'complete'); ?></div>

<br>

<table border="1" cellpadding="10">
	<tr>
		<th>ToDo</th>
		<th>期限</th>
		<th>所要時間</th>
		<th>状態</th>
		<th>削除・変更</th>
	</tr>

	<?php //debug($userid); ?>

	<?php foreach($tasks as $task): ?>
		<?php if($task['Task']['status'] == 'complete') {
			$color = "grey";
		} else {
			$color = "";
		} ?>
		<tr align="center">
			<td>
				<font color="<?php echo $color; ?>"><?php echo $this->Text->autoLink(nl2br(h($task['Task']['todo']))); ?></font>
			</td>

			<td>
				<font color="<?php echo $color; ?>"><?php $date = new DateTime($task['Task']['date']);
				echo $date->format('Y年m月d日') . "<br>";

				$time = new DateTime($task['Task']['time']);
				echo $time->format('H時i分'); ?></font>
			</td>

			<td>
				<font color="<?php echo $color; ?>"><?php echo h($task['Task']['hour']) . "時間" . h($task['Task']['minute']) . "分"; ?></font>
			</td>

			<td>
				<?php if($task['Task']['status'] == 'incomplete'): ?>
					<?php echo $this->Html->link('未完了', array('action' => 'status', $task['Task']['id'])); ?>
				<?php elseif($task['Task']['status'] == 'complete'): ?>
					<font color="red">完了</font>
				<?php endif; ?>
			</td>

			<td>
				<?php echo $this->Html->link('変更', array('action' => 'change', $task['Task']['id'])) . "<br>" .
				$this->Html->link('削除',
				array('action' => 'delete', $task['Task']['id']),
				array('confirm' => '本当に削除しますか？この操作は取り消せません。')); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	<?php unset($task); ?>
</table>

<p><?php
  echo $this->Paginator->first('前へ');
	echo $this->Paginator->last('次へ');
?></p>
