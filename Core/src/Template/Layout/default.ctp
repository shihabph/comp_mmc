<?php

use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

$siteTemplate = Configure::read('Site.template');
$siteTitle = Configure::read('Site.title');

$get_node = TableRegistry::getTableLocator()->get('nodes');
$nodes = $get_node->find()->first();
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $this->fetch('title'); ?> - <?= $siteTitle; ?></title>
    <?php
    $rightRegionBlocks = $this->Regions->blocks('right');
    echo $this->Meta->meta();
    echo $this->Layout->feed();
    echo $this->Layout->js();
    $this->element('stylesheets');
    $this->element('javascripts');
    echo $this->Blocks->get('css');
    echo $this->Blocks->get('script');
    ?>
</head>

<?php
$isWebroot = false;
if ($this->request->getPath() === '/') {
    $isWebroot = true;
}

echo $this->element('marmc_header');

if ($isWebroot) {
    echo $this->element('marmc_homepage');
}

else if ($nodes->type == 'page') { ?>
    <?= $this->fetch('content') ?>
<?php }

else { ?>
    <div class="untree_co-hero overlay" style="background-color:#184aad; height: 150px!important; min-height: 150px!important;">
    </div>
    <?= $this->fetch('content') ?>
<?php } ?>

<?= $this->element('marmc_footer'); ?>
</html>
