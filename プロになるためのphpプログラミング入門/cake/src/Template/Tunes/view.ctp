<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tune'), ['action' => 'edit', $tune->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tune'), ['action' => 'delete', $tune->id], ['confirm' => __('Are you sure you want to delete # {0}?', $tune->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tunes'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tune'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Artists'), ['controller' => 'Artists', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Artist'), ['controller' => 'Artists', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Feelings'), ['controller' => 'Feelings', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Feeling'), ['controller' => 'Feelings', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tunes view large-9 medium-8 columns content">
    <h3><?= h($tune->name) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($tune->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Artist') ?></th>
            <td><?= $tune->has('artist') ? $this->Html->link($tune->artist->name, ['controller' => 'Artists', 'action' => 'view', $tune->artist->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Feeling') ?></th>
            <td><?= $tune->has('feeling') ? $this->Html->link($tune->feeling->name, ['controller' => 'Feelings', 'action' => 'view', $tune->feeling->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($tune->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($tune->modified) ?></td>
        </tr>
    </table>
    <div class="row">
        <h4><?= __('Comcont') ?></h4>
        <?= $this->Text->autoParagraph(h($tune->comcont)); ?>
    </div>
</div>
