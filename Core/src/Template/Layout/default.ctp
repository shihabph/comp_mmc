<?php

use Cake\Core\Configure;

$siteTemplate = Configure::read('Site.template');
$siteTitle = Configure::read('Site.title');
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
if ($siteTemplate == 1) {
    echo $this->element('gov_template');
} else if ($siteTemplate == 2) {
    echo $this->element('marmc_template');
} else {
    echo $this->element('school_template');
}
?>

</html>
