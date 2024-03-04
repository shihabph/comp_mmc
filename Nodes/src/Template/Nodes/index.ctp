<?php
if (isset($type)) :
    $this->assign('title', $type->title);
endif;
?>
<style>
    .custom_thead {
        background: #2C3F33;
        color: #fff;
    }
</style>
<div class="untree_co-hero overlay" style="background-color:#184aad; height: 150px!important; min-height: 150px!important;">
</div>
<div class="text-center mt-5">
    <h2>
        All <?= $type->title ?>
    </h2>
</div>
<div class="container nodes mt-5">

    <!-- Bootstrap Table for Tabular  View Notice -->
    <table class="table">
        <thead class="custom_thead">
            <tr>
                <th style="width: 10%;">Date</th>
                <th>Title</th>
                <th style="width: 10%;">View</th>
            </tr>
        </thead>
        <?php if (count($nodes) == 0) { ?>
            <tbody>
                <tr>
                    <td colspan="3">
                        No items found.
                    </td>
                </tr>
            </tbody>
        <?php } ?>

        <?php
        foreach ($nodes as $node) :
            $this->Nodes->set($node);
            $dateObject = $this->Nodes->field('publish_start'); // Assuming $array is the given array
            $dateWithoutTime = $dateObject->format('Y-m-d');
        ?>

            <tbody>
                <tr>
                    <td style="white-space: nowrap;"><?= $dateWithoutTime ?></td>
                    <td>
                        <div id="node-<?= $this->Nodes->field('id') ?>" class="node node-type-<?= $this->Nodes->field('type') ?>">
                            <h6><?= $this->Html->link($this->Nodes->field('title'), $this->Nodes->field('url')->getUrl(), ['class' => 'node_items']) ?></h6>
                    </td>
                    <td><?php echo $this->Html->link('view', $this->Nodes->field('url')->getUrl(), ['target' => '_blank']) ?></td>
                </tr>
</div>
<?php endforeach; ?>
</table>
<?= $this->element('pagination', compact('nodes', 'type')) ?>
</div>
