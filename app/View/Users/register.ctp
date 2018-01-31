<?php $this->assign('title', '新規登録'); ?>
<?php $this->Html->script('/js/user_check'); ?>
<h1>新規登録</h1>

もう登録していますか？
<?php echo $this->Html->link('ログイン', 'login'); ?>

<?php echo $this->Form->create('User'); ?>

<p><?php echo $this->Form->input('username', array(
	'label' => 'ユーザー名',
	'required' => false
)) ?></p>

<p><?php echo $this->Form->input('password', array(
	'label' => 'パスワード',
	'required' => false
)) ?></p>

<p><?php echo $this->Form->input('password_confirm', array(
	'type' => 'password',
	'label' => 'パスワード（確認）',
	'required' => false
)) ?></p>

<p><?php echo $this->Form->end('新規登録') ?></p>
