<?php $this->assign('title', '新規登録完了') ?>
<h1>新規登録完了</h1>

<p><?php echo h($username); ?>さんの新規登録が完了しました。</p>
<p>ログインをクリックしてログインしてください。</p>

<button onclick="location.href='<?php echo $this->html->url('/users/login'); ?>';">ログイン</button>
