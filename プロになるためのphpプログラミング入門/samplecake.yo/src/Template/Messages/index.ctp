<div>
<h3>List Messages</h3>
<table>
<thead>
<tr>
<th>ID</th>
<th>TITLE</th>
<th>MEMBERS</th>
<th>Actions</th>
</tr>
</thead>
<tbody>
<?php foreach ($messages as $message): ?>
<tr>
    <td><?= $this->Number->format($message->id) ?></td>
    <td><?= __($message->title) ?></td>
    <td><?= $message->has('member') ? 
        $this->Html->link($message->member->name, 
        ['controller' => 'Members', 'action' => 'view', 
        $message->member->id]) : '' ?></td>
    <td class="actions">
        <?= $this->Html->link(__('View'), ['action' => 'view', 
            $message->id]) ?>
        <?= $this->Html->link(__('Edit'), ['action' => 'edit', 
            $message->id]) ?>
        <?= $this->Form->postLink(__('Delete'), 
            ['action' => 'delete', $message->id], 
            ['confirm' => __('you want to delete # {0}?', 
            $message->id)]) ?>
    </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?= $this->Paginator->first('<<first'); ?>
<?= $this->Paginator->prev('<prev'); ?>
<?= $this->Paginator->numbers(); ?>
<?= $this->Paginator->next('next>'); ?>
<?= $this->Paginator->last('last>>'); ?>
