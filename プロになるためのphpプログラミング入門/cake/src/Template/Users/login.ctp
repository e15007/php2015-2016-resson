<div id="navdiv">
<form class="formnav" method="post" action="/cake/tunes/">
<input type="submit" value="キモチ曲検索">
</form>
</div>
<h2>ログイン</h2>
<?= $this->Flash->render('auth') ?>
<?= $this->Form->create() ?>
	<?= $this->Form->input('username',
				['label' => 'ユーザ名', 'size' => 15, 'maxlength' => 20]) ?>
	<?= $this->Form->input('password',
				['label' => 'パスワード', 'size' => 15, 'maxlength' => 100]) ?>
<?= $this->Form->submit(__('ログイン')); ?>
<?= $this->Form->end() ?>
