<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $user->IdUsuarios],
                ['confirm' => __('Are you sure you want to delete # {0}?', $user->IdUsuarios)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Users'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="users form large-9 medium-8 columns content">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Edit User') ?></legend>
        <?php
            echo $this->Form->control('NumeroDocumentoIdentidad');
            echo $this->Form->control('Nombres');
            echo $this->Form->control('Apellidos');
            echo $this->Form->control('CorreoElectronico');
            echo $this->Form->control('Password');
            echo $this->Form->control('IdRoles');
            echo $this->Form->control('Estado');
            echo $this->Form->control('FechaHoraCreacion');
            echo $this->Form->control('FechaHoraModificacion');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
