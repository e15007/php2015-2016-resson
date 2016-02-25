<div id="navdiv">
<form class="formnav" method="post" action="/cake.yo/users/logout">
<input type="submit" value="ログアウト">
</form>
</div>
<h2>曲の編集</h2>
<?= $this->Form->create($tune) ?>
	<?php
			echo $this->Form->input('name',['label' => '曲名', 'size' => 30, 'maxlength' => 20]);
			echo $this->Form->input('artist_id', ['options' => $artists, 'label' => 'アーティスト']);
			echo $this->Form->input('feeling_id', ['options' => $feelings, 'label' => '気持ち']);
			echo $this->Form->input('comcont', ['label' => 'コメント', 'cols' => 30, 'rows' => 3]);
	?>
<?= $this->Form->button(__('保存')) ?>
<?= $this->Form->end() ?>
