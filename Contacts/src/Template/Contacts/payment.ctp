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
    .dbbl {
	position:relative;
    }
</style>
		<div class="regWrap">
        	<?php if( !empty($newAdmitter) ){ ?>
        	<h2>Congratulation!! Your registration has been completed successfully.</h2>
            <?php } ?>
            <div class="regCont">
            	<?php if( !empty($newAdmitter) ){ ?>
            	<div class="studentInfo">
		    <div class="infobox">Reference/Ref Number: <span><?php echo $newAdmitter['ref']; ?></span></div>
                    <div class="infobox">Student Name: <span><?php echo $newAdmitter['name']; ?></span></div>
                    <div class="infobox">Father`s Name: <span><?php echo $newAdmitter['fname']; ?></span></div>
                    <div class="infobox">Mother`s Name: <span><?php echo $newAdmitter['mname']; ?></span></div>
                </div><!--End of studentInfo-->
                <?php } ?>

                <div class="bkashHdr"><h3> Instruction for DBBL Mobile Banking payment. </h3></div>
		<div class="dbbl">
		    <div class="mob"><?php echo $newAdmitter['mobile']; ?></div>
		    <div class="ref"><?php echo $newAdmitter['ref']; ?></div>
		    <?php echo $this->Html->image('/uploads/dbbl.png'); ?>
		</div>

                <div class="btmTop">
                	<p>এ সফল ভাবে টাকা জমা হলে আপনি একটি TrxID Number নাম্বার পাবেন। TrxID নাম্বারটি আপনাকে অবশ্যই লিখে/মনে রাখতে হবে। পরবর্তীতে Admit Card উত্তলনের জন্য এই TrxID নাম্বারটি প্রয়োজন হবে।</p>
                    <?php echo $this->Html->link('Admit Card', '/admitcard', array('class'=>'account','target'=>'_blank')); ?>
                </div><!--End of studentInfo-->
            </div><!--End of regCont-->

        </div><!--End of regWrap-->
