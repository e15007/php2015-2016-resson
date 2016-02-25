<div id="navdiv">
<form class="formnav" method="post" action="/cake.yo/users/logout">
<input type="submit" value="ログアウト">
</form>
</div>
<h2>曲の検索</h2>
<?php
echo $this->Form->create();
echo $this->Form->input('name', array('label' => '曲名', 'size' => 30, 'maxlength' => 20));
echo $this->Form->input('artist_id', array('label' => 'アーティスト'));
echo $this->Form->input('feeling_id', array('label' => '気持ち'));
echo $this->Form->submit('検索');
echo $this->Form->end();
?>
<div id="navlink">
<?php echo $this->Html->link('曲の追加', array('action' => 'add'));?>
</div>
<div class="tunes index large-9 medium-8 columns content">
    <table cellpadding="0" cellspacing="0" class="tunetbl">
        <thead>
            <tr>
							<th class="column-1">ID</th>
							<th class="column-2">曲名</th>
							<th class="column-3">アーティスト</th>
							<th class="column-4">気持ち</th>
							<th class="column-5">コメント</th>
							<th class="column-6">操作</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tunes as $tune): ?>
            <tr>
                <td><?= $this->Number->format($tune->id) ?></td>
                <td><?= h($tune->name) ?></td>
                <td><?= $tune->has('artist') ? h($tune->artist->name) : '' ?></td>
                <td><?= $tune->has('feeling') ? h($tune->feeling->name) : '' ?></td>
                <td><?= $tune->has('comcont') ?  __('あり') : __('なし') ?></td>
                <td>
                    <?= $this->Html->link(__('編集'), ['action' => 'edit', $tune->id]) ?>
                    <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $tune->id], ['confirm' => __('この曲を削除します、よろしいですか # {0}?', $tune->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
