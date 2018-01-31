<?php $this->assign('title', 'ログイン'); ?>
<h1>ログイン</h1>

<p><?php echo $this->Flash->render(); ?></p>

<?php echo $this->Form->create('User'); ?>
<p><?php echo $this->Form->input('username', array(
	'label' => 'ユーザー名',
	'required' => false
)); ?></p>

<p><?php echo $this->Form->input('password', array(
	'label' => 'パスワード',
	'required' => false
)); ?></p>

<p><?php echo $this->Form->end('ログイン'); ?></p>
