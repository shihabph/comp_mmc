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
$siteFeatured = Configure::read('Site.govFeatured');
$siteURL = $this->Url->build([
    "plugin" => "Croogo/Nodes",
    "controller" => "Nodes",
    "action
" => "promoted",
]);

 ?>



<style>
    body {
        font-family: kalpurushregular;
        margin: 0;
        font-weight: 400;
        line-height: 1.5;
        text-align: left;
        font-size: 16px;
        color: #000;
    }

    #header-site-info {
        left: 20px;
        margin-bottom: 0;
        padding: 10px;
        position: absolute;
        top: 80px;
        z-index: 100;
        width: 90%;
    }

    .logo {
        display: block;
        margin: 0 0 10px 15px;
        float: left;
        width: 12%;
    }

    #site-name-wrapper {
        position: relative;
        float: left;
        padding: 10px 0;
        line-height: 2;
        margin-left: -15px;
    }

    #site-name,
    #slogan {
        display: block;
    }

    #site-name {
        font-size: 2vw;
        font-weight: bold;
        text-shadow: -1px -1px 10px #333, 1px -1px 10px #333, -1px 1px 10px #333, 1px 1px 10px #333;
    }

    #site-name a,
    #slogan {
        color: #ffffff;
    }

    @media only screen and (min-width: 960px) {
        .container {
            position: relative;
            width: 960px;
            margin: 0 auto;
            padding: 0;
        }
    }

    .top-menu {
        background-color: #683091;
        box-shadow: 0 1px 5px #999999;
        border-bottom: 4px solid #8bc643;
        color: #ffffff;
        padding: 5px 0;
    }


    @media only screen and (max-width: 768px) {}

    .bd-gov-site {
        display: flex;
        align-items: center;
    }

    .bd-gov-site>a>i {
        margin-top: 0 !important;
    }


    #block-3>div>form {
        margin-bottom: 0 !important;
    }



    .another_portal {
        background: #fafafa;
    }



    .portal_cont {
        padding: 5px;
        display: none;
    }

    .form-item {
        padding: 0 3px;
    }

    .top-menu .bd-gov-site a {
        color: white;
        font-size: 1.1em;
        padding-left: 10px;
        line-height: 31px;
    }

    .plain-header {
        display: none;
    }

    #logo {
        display: block;
        margin: 0 0 10px 15px;
        float: left;
        width: 12%;
    }

    #logo img {
        display: block;
        width: 70px;
        height: auto;
    }

    @media (max-width: 767px) {
        .img-square-wrapper img {
            width: 100%;
            margin-top: 50px;

        }

        #header-site-info {
            display: block !important;
        }

        #logo img {
            width: 50px !important;
        }

        .plain-header {
            display: none !important;
        }

        #logo {
            margin-top: 20px !important;
            margin-left: -14px !important;
        }

        #site-name,
        #slogan {
            margin-top: 14px !important;

        }

        #site-name a,
        #slogan {
            font-size: 25px !important;
        }

        .block table {
            margin-left: 0px;
        }

        .bd-gov-site {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 1em;
            margin-bottom: 1em;
        }

        #header-site-info>div {
            top: 60;
            left: 25;
            position: absolute;
        }
    }

    @media (max-width: 991px) {

        #site-name a,
        #slogan {
            margin-left: 30px !important;
        }

        #banner-slider {
            display: block !important;
        }

        #banner-slider img {
            display: block !important;
            width: 100% !important;
            height: auto !important;
        }

        #header-site-info {
            left: 20px;
            margin-bottom: 0;
            padding: 10px;
            position: absolute;
            top: 80px;
            z-index: 100;
            width: 90%;
        }

        #logo {
            display: block !important;
        }

        .container.details-page .row {
            display: block !important;
        }

        .right-side-bar.col-3 {
            width: 100% !important;
            max-width: 100% !important;
        }

        .img-square-wrapper img {
            margin-top: 0px !important;
        }

        .block table {
            margin-left: 0px;
        }


    }

    .containerpadma {
        border: 2px solid red;
    }

    .fixed_notice {
        background-color: #f5f5f5;
        border: 1px solid #ccc;
    }

    nav#menu-wrap {
        margin-top: 0.5em;
        margin-bottom: 0.5em;
    }
</style>

<body style="background: url(//file-rangpur.portal.gov.bd/media/central/themes/theme-default/img/bg_main.gif
) repeat-y scroll center top rgba(0, 0, 0, 0);">

    <div class="container home-page">
        <div class="blocks">
            <div class="top-menu">
                <div class="row mb-2 mb-md-0 px-3">
                    <div class="col-12 col-md-8 bd-gov-site">
                        <?= $this->element('social'); ?>
                    </div>
                    <div class="col-12 col-md-4 text-right pr-3">
                        <div class="input-group">
                            <?= $this->Regions->blocks('header'); ?>
                        </div>
                    </div>
                </div>
                <script>
                    document.querySelector('.input-group > span > button').innerHTML = '<i class="fa fa-search"></i>';
                </script>
            </div>
            <div id="banner-slider">

                <?php
                // Check if current URL corresponds to the webroot directory
                $isWebroot = false;
                if ($this->request->getPath() === '/') {
                    $isWebroot = true;
                }
                echo $this->element('gov_slider');
                ?>

                <?= $this->element('menu_2'); ?>
            </div>

            <div class="header-site-info" id="header-site-info">
                <div>
                    <a href="<?= $siteURL ?>"><?= $this->Html->image($HeaderBanner, array("alt" => $institute, "style" => "width: 50%;")); ?></a>
                </div>
            </div>



            <div class="row">
                <div class="col-md-9">
                    <div class="containerpadma mb-4 p-2">
                        <?php if (isset($mapImage)) {
                            echo $this->Html->image($siteFeatured, array("alt" => 'padma_bridge_countdown', "style" => "width: 100%;"));
                        } ?>
                    </div>
                    <?php if ($isWebroot) { ?>
                        <div class="fixed_notice my-4 p-4">
                            <?= $this->element('gov_fixed_notice'); ?>
                        </div>
                        <div class="mb-4">
                            <?= $this->element('xnews'); ?>
                        </div>

                        <!-- <div id="news">
                            <div class="news_head">খবর:</div>
                            <div class="breaking-news-slider">
                                <div class=" news_title breaking-news-item">
                                    < ? = $this->element('news'); ?>
                                </div>
                            </div>
                        </div> -->

                    <?= $this->element('boxes_node');?>
                    <?php } ?>
                    <?= $this->fetch('content'); ?>


                </div>
                <div class=" col-md-3">
                    <?= $this->element('gov_employee'); ?>
                    <?= $this->Regions->blocks('right') ?>
                    <div class="sidebarComn">
                        <?= $this->Regions->blocks('blogroll'); ?>
                        <?= $this->element('calendar'); ?>

                        <div class="row mt-3 mb-5">
                            <div class="col-md-12 mb-3">
                                <a href="<?= $mapLink ?>">
                                    <?php if (isset($mapImage)) {
                                        echo $this->Html->image($mapImage, array("alt" => $institute, "class" => "map_img"));
                                    } ?>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <?php
            echo $this->element('gov_footer');
            ?>
        </div>
    </div>
</body>
