<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New User'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="users index large-9 medium-8 columns content">
    <h3><?= __('Users') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('IdUsuarios') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NumeroDocumentoIdentidad') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Nombres') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Apellidos') ?></th>
                <th scope="col"><?= $this->Paginator->sort('CorreoElectronico') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Password') ?></th>
                <th scope="col"><?= $this->Paginator->sort('IdRoles') ?></th>
                <th scope="col"><?= $this->Paginator->sort('Estado') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FechaHoraCreacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FechaHoraModificacion') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $this->Number->format($user->IdUsuarios) ?></td>
                <td><?= h($user->NumeroDocumentoIdentidad) ?></td>
                <td><?= h($user->Nombres) ?></td>
                <td><?= h($user->Apellidos) ?></td>
                <td><?= h($user->CorreoElectronico) ?></td>
                <td><?= h($user->Password) ?></td>
                <td><?= $this->Number->format($user->IdRoles) ?></td>
                <td><?= h($user->Estado) ?></td>
                <td><?= h($user->FechaHoraCreacion) ?></td>
                <td><?= h($user->FechaHoraModificacion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $user->IdUsuarios]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $user->IdUsuarios]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $user->IdUsuarios], ['confirm' => __('Are you sure you want to delete # {0}?', $user->IdUsuarios)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
