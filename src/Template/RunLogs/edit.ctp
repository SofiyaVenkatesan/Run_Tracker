<?php

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $runLog->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $runLog->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Run Logs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Statistics'), ['action' => 'stats']) ?></li>
        <li><?= $this->Html->link(__('Ranking'), ['action' => 'rank']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</nav>
<div class="runLogs form large-9 medium-8 columns content">
    <?= $this->Form->create($runLog) ?>
    <fieldset>
        <legend><?= __('Edit Run Log') ?></legend>
        <?php
            echo $this->Form->control('distance');
            echo $this->Form->control('minutes');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
