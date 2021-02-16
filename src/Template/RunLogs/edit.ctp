<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\RunLog $runLog
 */
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
        <li><?= $this->Html->link(__('List Dates'), ['controller' => 'Dates', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Date'), ['controller' => 'Dates', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="runLogs form large-9 medium-8 columns content">
    <?= $this->Form->create($runLog) ?>
    <fieldset>
        <legend><?= __('Edit Run Log') ?></legend>
        <?php
            echo $this->Form->control('users_id', ['options' => $users]);
            echo $this->Form->control('distance');
            echo $this->Form->control('minutes');
            echo $this->Form->control('dates_id', ['options' => $dates]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
