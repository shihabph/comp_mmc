<?php

$this->assign('title', __d('croogo', 'Registration'));
$this->setLayout('admin_login');

?>
<div class="users form">
    <h2><?= $this->fetch('title') ?></h2>
    <?= $this->Form->create('User');?>
        <fieldset>
        <?php
            echo $this->Form->input('username');
            echo $this->Form->input('password', ['value' => '']);
            echo $this->Form->input('verify_password', ['type' => 'password', 'value' => '']);

            echo $this->Form->input('email');
            echo $this->Form->input('website');

            echo $this->Form->submit(__d('croogo', 'Register'), [
                'class' => 'btn btn-success',
            ]);
            ?>
        </fieldset>
    <?= $this->Form->end() ?>
</div>