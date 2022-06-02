<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Role'), ['action' => 'edit', $role->IdRoles]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Role'), ['action' => 'delete', $role->IdRoles], ['confirm' => __('Are you sure you want to delete # {0}?', $role->IdRoles)]) ?> </li>
        <li><?= $this->Html->link(__('List Roles'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="roles view large-9 medium-8 columns content">
    <h3><?= h($role->IdRoles) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('NombreRol') ?></th>
            <td><?= h($role->NombreRol) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdRoles') ?></th>
            <td><?= $this->Number->format($role->IdRoles) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaHoraCreacion') ?></th>
            <td><?= h($role->FechaHoraCreacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaHoraModificacion') ?></th>
            <td><?= h($role->FechaHoraModificacion) ?></td>
        </tr>
    </table>
</div>
