<?php

use Cake\Core\Configure;

$siteTitle = Configure::read('Site.title');
$siteTagline = Configure::read('Site.tagline');

$this->loadHelper('Croogo/Core.Layout');
$this->loadHelper('Croogo/Core.Js');
$this->loadHelper('Croogo/Core.Theme');
$this->loadHelper('Croogo/Menus.Menus');
$this->loadHelper('Croogo/Meta.Meta');

?>
<!DOCTYPE html>
<html style='background: #0e0e0e;'>


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title><?= $this->fetch('title'); ?> - <?= $siteTitle; ?></title>
    <?php
    echo $this->Meta->meta();
    echo $this->Layout->feed();
    $this->element('stylesheets');
    $this->element('javascripts');
    echo $this->Layout->js();
    echo $this->Blocks->get('css');
    echo $this->Blocks->get('script');
    ?>
</head>


<body id="page-top">
    <?= $this->element('marmc_header'); ?>
    <div class="untree_co-hero overlay" style="background-color:#184aad; height: 150px!important; min-height: 150px!important;">
    </div>
    <section>
        <div class="<?= $this->Theme->getCssClass('container') ?>">
            <div class="<?= $this->Theme->getCssClass('row') ?>">
                <div class="<?= $this->Theme->getCssClass('columnFull') ?>">
                    <?php
                    echo $this->Layout->sessionFlash();
                    echo $this->fetch('content');
                    ?>


                </div>
            </div>
        </div>
    </section>
    <div class="row">
        <div class="col-md-6 col-12">

        </div>
        <div class="col-md-6 col-12">
            <?= $this->Html->image('/webroot/uploads/error_slide.png'); ?>
        </div>
    </div>
    <?= $this->element('marmc_footer'); ?>
    </div>
    <?php
    echo $this->Blocks->get('scriptBottom');
    echo $this->Js->writeBuffer();
    ?>
</body>

</html>
