<?php

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Date'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dates index large-9 medium-8 columns content">
    <h3><?= __('Dates') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col"><?= $this->Paginator->sort('week') ?></th>
                <th scope="col"><?= $this->Paginator->sort('month') ?></th>
                <th scope="col"><?= $this->Paginator->sort('year') ?></th>
                <th scope="col"><?= $this->Paginator->sort('created') ?></th>
                <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dates as $date): ?>
            <tr>
                <td><?= $this->Number->format($date->id) ?></td>
                <td><?= h($date->date) ?></td>
                <td><?= $this->Number->format($date->week) ?></td>
                <td><?= h($date->month) ?></td>
                <td><?= $this->Number->format($date->year) ?></td>
                <td><?= h($date->created) ?></td>
                <td><?= h($date->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $date->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $date->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id)]) ?>
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
