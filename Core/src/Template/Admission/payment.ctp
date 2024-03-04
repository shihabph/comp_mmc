<style>
    .mob {
        position: absolute;
        top: 41.7%;
        right: 21.5%;
        z-index: 1;
    }

    .ref {
        position: absolute;
        top: 78.7%;
        left: 24.5%;
        z-index: 1;
    }

    .bkash {
        position: relative;
    }

    .btmTop {
        text-align: center;
        font-size: 25px;
        cursor: pointer;
    }

    .account,
    .account:hover,
    .account {
        color: #212529;
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btmTop .account {
        margin-top: 18px
    }

    .btmTop {
        padding: 2em;
        background: #f0f8ff;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .btmTop p {
        font-weight: 600;
    }
</style>

<div class="regWrap">
    <?php if (!empty($newAdmitter)) { ?>
        <h2>Congratulation!! Your registration has been completed successfully.</h2>
    <?php } ?>
    <div class="regCont">
        <?php if (!empty($newAdmitter)) { ?>
            <div class="studentInfo">
                <div class="infobox">Reference/Ref Number: <span><?php echo $newAdmitter['ref']; ?></span></div>
                <div class="infobox">Student Name: <span><?php echo $newAdmitter['name']; ?></span></div>
                <div class="infobox">Father`s Name: <span><?php echo $newAdmitter['fname']; ?></span></div>
                <div class="infobox">Mother`s Name: <span><?php echo $newAdmitter['mname']; ?></span></div>
            </div><!--End of studentInfo-->
        <?php } ?>

        <div class="bkash">
            <?php echo $this->Html->image('/uploads/bkash.png'); ?>
        </div>

        <div class="btmTop">
            <p><b>বি:দ্র: Payment অবশ্যই Personal Bkash নাম্বার থেকে করতে হবে |</b></p>
            <p class="text-center">bKash এ সফল ভাবে টাকা জমা হলে আপনি একটি TrxID Number নাম্বার পাবেন। TrxID নাম্বারটি আপনাকে অবশ্যই লিখে/মনে
                রাখতে
                হবে। পরবর্তীতে Admit Card উত্তলনের জন্য এই TrxID নাম্বারটি প্রয়োজন হবে।</p>
            <button class="btn btn-lg btn-warning"><?php echo $this->Html->link('Admit Card', '/admitcard', array('class' => 'account', 'target' => '_blank')); ?></button>
        </div>
    </div><!--End of regCont-->

</div><!--End of regWrap-->
