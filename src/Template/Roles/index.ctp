<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Role'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="roles index large-9 medium-8 columns content">
    <h3><?= __('Roles') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('IdRoles') ?></th>
                <th scope="col"><?= $this->Paginator->sort('NombreRol') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FechaHoraCreacion') ?></th>
                <th scope="col"><?= $this->Paginator->sort('FechaHoraModificacion') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($roles as $role): ?>
            <tr>
                <td><?= $this->Number->format($role->IdRoles) ?></td>
                <td><?= h($role->NombreRol) ?></td>
                <td><?= h($role->FechaHoraCreacion) ?></td>
                <td><?= h($role->FechaHoraModificacion) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $role->IdRoles]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $role->IdRoles]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $role->IdRoles], ['confirm' => __('Are you sure you want to delete # {0}?', $role->IdRoles)]) ?>
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
