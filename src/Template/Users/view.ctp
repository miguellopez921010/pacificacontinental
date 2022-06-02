<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit User'), ['action' => 'edit', $user->IdUsuarios]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete User'), ['action' => 'delete', $user->IdUsuarios], ['confirm' => __('Are you sure you want to delete # {0}?', $user->IdUsuarios)]) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="users view large-9 medium-8 columns content">
    <h3><?= h($user->IdUsuarios) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('NumeroDocumentoIdentidad') ?></th>
            <td><?= h($user->NumeroDocumentoIdentidad) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Nombres') ?></th>
            <td><?= h($user->Nombres) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Apellidos') ?></th>
            <td><?= h($user->Apellidos) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('CorreoElectronico') ?></th>
            <td><?= h($user->CorreoElectronico) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Password') ?></th>
            <td><?= h($user->Password) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdUsuarios') ?></th>
            <td><?= $this->Number->format($user->IdUsuarios) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('IdRoles') ?></th>
            <td><?= $this->Number->format($user->IdRoles) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaHoraCreacion') ?></th>
            <td><?= h($user->FechaHoraCreacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('FechaHoraModificacion') ?></th>
            <td><?= h($user->FechaHoraModificacion) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Estado') ?></th>
            <td><?= $user->Estado ? __('Yes') : __('No'); ?></td>
        </tr>
    </table>
</div>
