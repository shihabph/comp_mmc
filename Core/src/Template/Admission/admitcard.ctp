<?php $this->layout = 'no_sidebar'; ?>

<style>
    .topSubmittable {
        font-size: 22px;
        font-weight: 600;
        border-bottom: 2px solid #862424;
        padding-bottom: 0.25em;
    }

    .submitBox {
        padding: 3em;
        text-align: justify;
        background-color: rgb(251, 251, 251);
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        border-bottom: 4px solid rgb(17, 128, 192);
        margin-top: 10px !important;
    }

    .admInstuct {
        margin-top: 2em;
        font-weight: 600;
        font-size: 14px;
    }

    .submitForm {
        border-radius: 0 !important;
        padding: 1.5em 1em !important;
    }
</style>

<h3 class="topSubmittable">নিচে ফরম পূরণ করে Submit Button টী চাপুন :</h3>
<?php echo $this->Form->create('Admission', array('action' => 'admitcard')); ?>
<div class="submitBox">
    <?php if (!empty($validationErrors)) echo '<div class="error-message" style="color:#fff;padding:15px; background:#F99;margin:0 0 10px">' . (empty($validationErrors['pErr']) ? 'Please fill up the form correctly!' : $validationErrors['pErr']) . '</div>'; ?>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="label" for="name">Reference/Ref</label>
                <?php echo $this->Form->text('ref', array('class' => 'form-control submitForm', 'placeholder' => 'Reference ID')); ?>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="label" for="email">Transaction/TrxID</label>
                <?php echo $this->Form->text('trxId', array('class' => 'form-control submitForm', 'placeholder' => 'Transaction ID')); ?>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo $this->Form->submit('Submit', array('class' => 'btn btn-lg btn-success', 'div' => false)); ?>
            </div>
        </div>
    </div>
    <!--        <div class="admInstuct">
            বিস্তারিত তথ্যের জন্য এবং কোন জটিলতার সম্মুখীন হলে এই নম্বর গুলোতে তাৎক্ষনাত যোগাযোগ করুন। কলেজঃ ০১৭১৯৭৫০৪৬৫ (মোঃ ইয়াকুব আলী সহকারী শিক্ষক)<br>টেকনিক্যালঃ ০১৯৪১২০১২০৭, ০১৭০৮৫১৮৭২১, ০১৯৪১২০১২০৯
        </div>-->
</div><!--End of formWrap-->
<?php echo $this->Form->end(); ?>
