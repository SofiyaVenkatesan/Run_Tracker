<?php

?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('New User?') ?></li>
        <li><?= $this->Html->link(__('Register'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users form">
	<?= $this->Flash->render() ?>
	<?= $this->Form->create() ?>
	    <fieldset>
	        <legend><?= __('Please enter your username and password') ?></legend>
	        <?= $this->Form->control('username') ?>
	        <?= $this->Form->control('password') ?>
	    </fieldset>
	<?= $this->Form->button(__('Login')); ?>
	<?= $this->Form->end() ?>
</div>