<?php

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Run Logs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Add New Run Log'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Statistics'), ['action' => 'stats']) ?></li>
        <li><?= $this->Html->link(__('Ranking'), ['action' => 'rank']) ?></li>
        
    </ul>
</nav>
<div class="runLogs form large-9 medium-8 columns content">
    <?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Add Run Log') ?></legend>
        <?php
            echo $this->Form->control('username');
            echo $this->Form->control('distance');
            echo $this->Form->control('minutes');
            echo 'Date(Year/ Month/ Day)';
            echo $this->Form->date('date', ['minYear' => 2010, 'maxYear' => date('Y'), 'monthNames' => false]);

            ///echo $this->Form->control('dates_id', ['options' => $dates]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
