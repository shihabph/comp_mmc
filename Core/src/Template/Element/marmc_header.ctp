<?php

use Cake\Core\Configure;

$siteTitle = Configure::read('Site.title');
$siteLogo = Configure::read('Site.Logo');
$siteTemplate = Configure::read('Site.template');

?>

<nav class="site-nav mb-5">
    <div class="pb-2 top-bar mb-3">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-6 col-lg-9">
                    <a href="#" class="small mr-3"> <i class="fa fa-question-circle mr-2"></i> <span class="d-none d-lg-inline-block">Have a
                            questions?</span></a>
                    <a href="tel:+88 0531 64787" class="small mr-3"> <i class="fa fa-phone mr-2"></i> </span> <span class="d-none d-lg-inline-block">+88 0531 64787</span></a>
                    <a href="mailto:dinajmc@ac.dghs.gov.bd" class="small mr-3"><i class="fa fa-envelope mr-2"></i></span> <span class="d-none d-lg-inline-block"><span class="__cf_email__">dinajmc@ac.dghs.gov.bd</span></span></a>
                </div>
                <div class="col-6 col-lg-3 text-right">
                    <a href="./admin" class="small mr-3">
                        <i class="fa fa-lock mr-2"></i>
                        </span>
                        Log In
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div id="sticky-wrapper" class="sticky-wrapper" style="height: 42.3906px;">
        <div class="sticky-nav js-sticky-header">
            <div class="container position-relative">
                <div class="site-navigation text-center">
                    <div class="row">
                        <div class="col-md-2">
                            <a href="./" class="logo menu-absolute m-0"><?= $this->Html->image($siteLogo, array("alt" => $siteTitle, "class" => "ftr_logo")); ?> <?= $siteTitle ?></a>
                        </div>
                        <div class="col-md-10">
                            <?= $this->element('marmc_webmenu'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
