<?php

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Date'), ['action' => 'edit', $date->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Date'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Dates'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Date'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="dates view large-9 medium-8 columns content">
    <h3><?= h($date->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Month') ?></th>
            <td><?= h($date->month) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($date->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Week') ?></th>
            <td><?= $this->Number->format($date->week) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Year') ?></th>
            <td><?= $this->Number->format($date->year) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($date->date) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Created') ?></th>
            <td><?= h($date->created) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Modified') ?></th>
            <td><?= h($date->modified) ?></td>
        </tr>
    </table>
</div>
