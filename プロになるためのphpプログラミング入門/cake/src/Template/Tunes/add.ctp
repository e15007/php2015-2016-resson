<div id="navdiv">
<form class="formnav" method="post" action="/cake/users/logout">
<input type="submit" value="ログアウト">
</form>
</div>
<h2>曲の追加</h2>
<?= $this->Form->create($tune) ?>
		<?php
				echo $this->Form->input('name', 
					['label' => '曲名', 'size' => 30, 'maxlength' => 20]);
				echo $this->Form->input('artist_id', 
					['label' => 'アーティスト', 'options' => $artists]);
				echo $this->Form->input('feeling_id', 
					['label' => '気持ち', 'options' => $feelings]);
				echo $this->Form->input('comcont',
					['label' => 'コメント', 'cols' => 30, 'rows' => 3]);
		?>
<?= $this->Form->submit(__('追加')) ?>
<?= $this->Form->end() ?>
