<?php

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

$siteTemplate = Configure::read('Site.template');
$siteTitle = Configure::read('Site.title');
$HeaderBanner = Configure::read('Site.banner');
$HeaderGovt = Configure::read('Site.GovtSign');
$institute = Configure::read('Site.institute');
$siteTagline = Configure::read('Site.tagline');
$address = Configure::read('Site.Address'); //Case Sensitive
$footerLogo = Configure::read('Footer.logo');
$footerOption = Configure::read('Footer.select');
$mapLink = Configure::read('Widget.map_link');
$mapImage = Configure::read('Widget.map_image');
$siteURL = $this->Url->build([
    "plugin" => "Croogo/Nodes",
    "controller" => "Nodes",
    "action" => "promoted",
]);

?>

<body>

    <?= $this->element('topbar'); ?>

    <div class=" container custom_banner_bg mt-2">
        <div class="row">
            <div class="col-md-7 col-sm-12">
                <div class="row">
                    <div class="col-md-8 col-8">
                        <a href="<?= $siteURL ?>"><?= $this->Html->image($HeaderBanner, array("alt" => $institute, "class" => "logo100")); ?></a>
                    </div>
                    <div class="col-md-4 col-4">
                        <?= $this->Html->image($HeaderGovt, array("alt" => "")); ?>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <div class="row">
                    <div class="col-md-6 col-sm-6" id="social" align="right">
                        <?= $this->element('social'); ?>
                    </div>
                    <div class="col-md-6 col-sm-6" id="search">
                        <div class="input-group">
                            <?= $this->Regions->blocks('header'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.querySelector('.input-group > span > button').innerHTML = '<i class="fa fa-search"></i>';
        </script>

        <!-- Nav AREA Starts -->
        <?= $this->element('menu_2'); ?>
        <!-- < ? = $this->element('xnews'); ?> -->


        <div id="news">
            <div class="news_head">খবর:</div>
            <div class="breaking-news-slider">
                <div class=" news_title breaking-news-item">
                    <?= $this->element('news'); ?>
                </div>
            </div>
        </div>
        <!-- Nav AREA Ends -->

        <div class="<?= $this->Theme->getCssClass('row') ?>">
            <div class="<?= $this->Theme->getCssClass('columnLeft') ?>">

                <?php
                // Check if current URL corresponds to the webroot directory
                $isWebroot = false;
                if ($this->request->getPath() === '/') {
                    $isWebroot = true;
                }
                // Render the slider_content element only in webroot directory
                if ($isWebroot) {
                    echo $this->element('slider_content');

                    // BOX DISPLAYING Before Content
                    $get_config = TableRegistry::getTableLocator()->get('cms_page_config');
                    $configs = $get_config->find()->enableAutoFields(true)->enableHydration(false)->toArray();
                    foreach ($configs as $config) {
                        if ($config['node_page_id'] == 0 && $config['box_position'] == 1) { //Box position TOP:: "1"
                            echo $this->element('boxes_node');
                        };
                    };
                }
                ?>
                <div class="my-4">
                    <?php
                    echo $this->Layout->sessionFlash();
                    echo $this->fetch('content');

                    if ($isWebroot) {
                        // BOX DISPLAYING After Content
                        foreach ($configs as $config) {
                            if ($config['node_page_id'] == 0 && $config['box_position'] == 0) { //Box position TOP:: "1"
                                echo $this->element('boxes');
                            };
                        };
                    }
                    ?>
                </div>
            </div>

            <div class="<?= $this->Theme->getCssClass('columnRight') ?>">
                <?= $this->Regions->blocks('right') ?>
                <div class="sidebarComn">
                    <?= $this->Regions->blocks('blogroll'); ?>
                    <div class="row mt-3 mb-5">
                        <div class="col-md-12 mb-3">
                            <a href="<?= $mapLink ?>"><?= $this->Html->image($mapImage, array("alt" => $institute, "class" => "map_img")); ?></a>
                        </div>
                        <div class="col-md-12 mb-3">
                            <?php echo $this->element('calendar'); ?>
                        </div>
                        <div class="col-md-6 col-12 clock_body">
                            <?php echo $this->element('clock'); ?>
                        </div>
                        <div class="col-md-6 col-12  visitor_body">
                            <?php echo $this->element('visitor'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Selection -->
    <?php
    if ($footerOption == 1) {
        echo $this->element('footer_1');
    } else {
        echo $this->element('footer_2');
    }
    ?>

    <?php
    echo $this->Blocks->get('scriptBottom');
    echo $this->Js->writeBuffer();
    ?>
</body>
