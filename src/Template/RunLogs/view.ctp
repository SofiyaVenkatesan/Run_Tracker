<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RunLog $runLog
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Run Log'), ['action' => 'edit', $runLog->id]) ?></li>
        <li><?= $this->Form->postLink(__('Delete Run Log'), ['action' => 'delete', $runLog->id], ['confirm' => __('Are you sure you want to delete # {0}?', $runLog->id)]) ?></li>
        <li><?= $this->Html->link(__('List Run Logs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Run Log'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Statistics'), ['action' => 'stats']) ?></li>
        <li><?= $this->Html->link(__('Ranking'), ['action' => 'rank']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</nav>
<div class="runLogs view large-9 medium-8 columns content">
    <h3><?= h($runLog->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('User') ?></th>
            <td><?= $runLog->has('user') ? $this->Html->link($runLog->user->name, ['controller' => 'Users', 'action' => 'view', $runLog->user->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= $runLog->has('date') ? $this->Html->link($runLog->date->date, ['controller' => 'Dates', 'action' => 'view', $runLog->date->id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($runLog->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Distance') ?></th>
            <td><?= $this->Number->format($runLog->distance) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Minutes') ?></th>
            <td><?= $this->Number->format($runLog->minutes) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($runLog->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($runLog->modified) ?></td>
        </tr>
    </table>
</div>
