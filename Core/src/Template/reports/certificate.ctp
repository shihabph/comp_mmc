<?php $img =  'Git_SCMS/uploads/certificate_image/' . $types['config_image']; ?>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Birthstone&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=PT+Sans+Narrow:wght@400;700&display=swap');
    @import url('https://fonts.googleapis.com/css2?family=Charm:wght@400;700&display=swap');
    @import url('https://db.onlinewebfonts.com/c/9722ed7625833c0eec7f4d8979faf175?family=Shelley+Volante+BT+V1');

    .cirtificate_body>span {
        font-family: "Shelley Volante BT V1";
        font-size: 26px;
        font-weight: 700;
        text-decoration: underline 1px dashed;
        text-transform: capitalize;

    }

    .cirtificate_office_body>span {
        font-family: "Shelley Volante BT V1";
        font-size: 14pt;
        font-weight: 700;
        text-decoration: underline 1px dashed;
        text-transform: capitalize;
    }

    .cirtificate_body {
        line-height: 180%;
        font-family: 'Charm', cursive;
        font-size: 20px;
        font-weight: 500;
        margin-bottom: 2.5rem;
        position: relative;
    }

    .certificate_body_text {
        line-height: 150%;
        font-family: 'PT Sans Narrow', sans-serif !important;
        font-size: 15px;
        font-weight: 600;
    }

    .certificate_container {
        position: relative;
    }

    .certificate_inner_body {
        position: absolute;
        top: 25%;
        left: 10%;
        right: 10%;
    }

    .RctBtnWrap {
        position: fixed;
        top: 1.5em;
        right: 1.5em;
        z-index: 999;
    }

    .office_outer {
        padding-left: 2em;
        display: flex;
        justify-content: flex-end;
    }

    .office_outer img {
        width: 358px;
        height: 760px;
    }

    .office_inner {
        left: 20%;
        right: 12%;
    }

    .office_btex {
        font-size: 9pt !important
    }

    .certificate_outer_body img{
    height: 760px;
    }

     @media print {
        #content {
            margin-top: 0 !important;
        }
    }
</style>

<?php
function capitalize($values)
{
    return ucfirst(ucwords(strtolower($values)));
}
// Capitalize all values in the array
$capValue = array_map('capitalize', $values);
?>
<div class="RctBtnWrap text-right">
    <button class="btn btn-danger no_print " onclick="window.print()">Print Certificate</button>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="certificate_container" id="certificate_area">
            <div class="certificate_outer_body office_outer"><?php echo $this->Html->image('/webroot/uploads/certificate_image/' . $types['office_copy_image']); ?></div>
            <div class="row certificate_inner_body office_inner">
                <div class="col-md-6 text-left certificate_body_text office_btex mt-5 ">
                    <?php
                    $l_head = $types['office_left_head'];
                    $result = str_replace(array_keys($values), array_values($values), $l_head);
                    echo $result; ?>
                </div>

                <div class="col-md-6 text-right certificate_body_text  office_btex mt-5">
                    <?php
                    $r_head = $types['office_right_head'];
                    $result = str_replace(array_keys($values), array_values($values), $r_head);
                    echo $result; ?>
                </div>

                <div class="col-md-12 text-justify cirtificate_office_body office_btex cirtificate_body">
                    <?php
                    $main = $types['office_main_content'];
                    $result = str_replace(array_keys($capValue), array_values($capValue), $main);
                    echo $result; ?>
                </div>

                <div class="col-md-6 text-left certificate_body_text office_btex">
                    <?php
                    $left_footer = $types['office_left_footer'];
                    $result = str_replace(array_keys($values), array_values($values), $left_footer);
                    // $slice = explode(" ", $result); // for spliting into two words using spacing.
                    echo $result; ?>
                </div>

                <div class="col-md-6 text-right certificate_body_text office_btex">
                    <?php
                    $right_footer = $types['office_right_footer'];
                    $result = str_replace(array_keys($values), array_values($values), $right_footer);
                    echo $result; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="certificate_container" id="certificate_area">
            <div class="certificate_outer_body"><?php echo $this->Html->image('/webroot/uploads/certificate_image/' . $types['config_image']); ?></div>
            <div class="row certificate_inner_body ">
                <div class="col-md-6 text-left certificate_body_text mt-5 ">
                    <?php
                    $l_head = $types['left_head'];
                    $result = str_replace(array_keys($values), array_values($values), $l_head);
                    echo $result; ?>
                </div>

                <div class="col-md-6 text-right certificate_body_text mt-5">
                    <?php
                    $r_head = $types['right_head'];
                    $result = str_replace(array_keys($values), array_values($values), $r_head);
                    echo $result; ?>
                </div>

                <div class="col-md-12 text-justify cirtificate_body">
                    <?php
                    $main = $types['main_content'];
                    $result = str_replace(array_keys($capValue), array_values($capValue), $main);
                    echo $result; ?>
                </div>

                <div class="col-md-6 text-left certificate_body_text">
                    <?php
                    $left_footer = $types['left_footer'];
                    $result = str_replace(array_keys($values), array_values($values), $left_footer);
                    // $slice = explode(" ", $result); // for spliting into two words using spacing.
                    echo $result; ?>
                </div>

                <div class="col-md-6 text-right certificate_body_text">
                    <?php
                    $right_footer = $types['right_footer'];
                    $result = str_replace(array_keys($values), array_values($values), $right_footer);
                    echo $result; ?>
                </div>
            </div>
        </div>
    </div>
</div>
