<?php

?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Run Logs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Add New Run Log'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Statistics'), ['action' => 'stats']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <h3><?= __('Ranking') ?></h3>
    <?= $this->Form-> create('RunLogs', [
    'url' => [
        'action' => 'rank'
    ]
    ]);?>
        <fieldset>
            <legend><?= __('Rank by Statistics') ?></legend>
            <?= $this->Form->control('year') ?>
            <?= $this->Form->control('month') ?>
            <?= $this->Form->control('week') ?>
            <legend><?= __('Rank by') ?></legend>
            <?=$this->Form->radio('rankorder', ['Activities', 'Distance', 'Time']); ?>
        </fieldset>
    <?= $this->Form->button(__('Check Rank')) ?>
    <?= $this->Form->end() ?>

</div>

