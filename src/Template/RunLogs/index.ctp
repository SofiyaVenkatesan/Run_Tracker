<?php

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Run Log'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Statistics'), ['action' => 'stats']) ?></li>
    </ul>
</nav>
<div class="runLogs index large-9 medium-8 columns content">
    <h3><?= __('Run Logs') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('users_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('distance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('minutes') ?></th>
                <th scope="col"><?= $this->Paginator->sort('dates_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($runLogs as $runLog): ?>
            <tr>
                <td><?= $this->Number->format($runLog->id) ?></td>
                <td><?= $runLog->has('user') ? $this->Html->link($runLog->user->name, ['controller' => 'Users', 'action' => 'view', $runLog->user->id]) : '' ?></td>
                <td><?= $this->Number->format($runLog->distance) ?></td>
                <td><?= $this->Number->format($runLog->minutes) ?></td>
                <td><?= $runLog->has('date') ? $this->Html->link($runLog->date->id, ['controller' => 'Dates', 'action' => 'view', $runLog->date->id]) : '' ?></td>
                <td><?= h($runLog->created) ?></td>
                <td><?= h($runLog->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $runLog->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $runLog->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $runLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $runLog->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
