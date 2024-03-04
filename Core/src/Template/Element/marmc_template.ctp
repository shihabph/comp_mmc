<?php
use Cake\ORM\TableRegistry;

$get_node = TableRegistry::getTableLocator()->get('nodes');
$nodes = $get_node->find()->first();
?>

<?php
$isWebroot = false;
if ($this->request->getPath() === '/') {
    $isWebroot = true;
}

echo $this->element('marmc_header');

if ($isWebroot) {
    echo $this->element('marmc_homepage');
} else if ($nodes->type == 'page') { ?>
    <?= $this->fetch('content') ?>
<?php } else { ?>
    <div class="untree_co-hero overlay" style="background-color:#184aad; height: 150px!important; min-height: 150px!important;">
    </div>
    <?= $this->fetch('content') ?>
<?php } ?>

<?= $this->element('marmc_footer'); ?>
