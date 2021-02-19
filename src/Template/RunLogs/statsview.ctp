<?php

?>

<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Run Logs'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('Add New Run Log'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('Ranking'), ['action' => 'rank']) ?></li>
        <li><?= $this->Html->link(__('Logout'), ['controller' => 'Users', 'action' => 'logout']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <h3><?= __('Statistics') ?></h3>
    <table>
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('Username') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Total Activities') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Total Distance') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Total Time') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($query as $run): ?>
            <tr>
                <td><?= h($run->username) ?></td>
                <td><?= h($run->count) ?></td>
                <td><?= h($run->distanceSum) ?></td>
                <td><?= h($run->minuteSum) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    
</div>