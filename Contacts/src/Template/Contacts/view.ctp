<?php
use Cake\Core\Configure;

$contactAddress = Configure::read('Widget.contactAddress'); //Case Sensitive
$mapIframe = Configure::read('Widget.mapIframe');
$contactInfoBg = Configure::read('Widget.contactInfoBg');
?>
<div id="contact-<?= $contact['id'] ?>" class="">
    <h2><?= $contact->title ?></h2>

    <?php if ($contact->message_status) : ?>

        <div class="contact-form">
            <?php
            echo $this->Form->create($message);

            echo $this->Form->input('name', ['label' => __d('croogo', 'Your name')]);
            echo $this->Form->input('email', ['label' => __d('croogo', 'Your email')]);
            echo $this->Form->input('title', ['label' => __d('croogo', 'Subject')]);
            echo $this->Form->input('body', ['label' => __d('croogo', 'Message')]);

            echo $this->Recaptcha->display();
            echo $this->Form->hidden('recaptcha', ['value' => 'notempty']);
            echo $this->Form->submit();
            echo $this->Form->end();
            ?>


        </div>
    <?php endif ?>
</div>
<style>

</style>

<h2 class="mt-5 display-5 text-center">Find Us</h2>
<div class="row mt-4 mb-5 contactDetails" style="background-color: <?= $contactInfoBg ?>;">
    <div class="col-md-5 contactAddress"><?= $contactAddress ?></div>
    <div class="col-md-7 contactMap">
        <?= $mapIframe ?>
    </div>
</div>
