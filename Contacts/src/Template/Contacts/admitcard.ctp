<?php

//pr($admitter); die();

if (!empty($admitter)):
    ?>
    <?php if (empty($admitter)): //echo '1';die; ?>
<div style="width:50%; padding:50px; margin:30px auto 0; text-align:center; background:red; color:white; font-size:20px">INVALID ID !!!</div>

    <?php else: //pr ($admitter);die; ?>
<div class="admitWrap">

    <!doctype html>
    <html lang="en">
        <head>
            <!-- Required meta tags -->
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
            <style>
                .txt-center {
                    text-align: center;
                }

                .border- {
                    border: 1px solid #000 !important;
                }

                .padding {
                    padding: 15px;
                }

                .mar-bot {
                    margin-bottom: 15px;
                }

                .admit-card {
                    border: 2px solid #000;
                    padding: 15px;
                    margin: 20px 0;
                }

                .BoxA h5,
                .BoxA p {
                    margin: 0;
                }

                h5 {
                    text-transform: uppercase;
                }

                table img {
                    width: 100%;
                    margin: 0 auto;
                }

                .table-bordered td,
                .table-bordered th,
                .table thead th {
                    border: 1px solid #000000 !important;
                }
            </style>
            <title>admit Card</title>



        </head>
        <body>

            <section>
                <div class="container">
                    <div class="admit-card">
                        <!--<div class="BoxA border- padding mar-bot">--> 
                        <div class="col-sm-4">
                                    <?php $level_name = $admitter['level'] == 90 ? "Play" : ($admitter['level'] == 91 ? "Nursery-I" : ($admitter['level'] == 92 ? "Nursery-II" : $admitter['level'])); ?>
                                    <?php $mydate = getdate(date("U"));
        $current_date = "$mydate[weekday], $mydate[month] $mydate[mday], $mydate[year]";
        $date = in_array($admitter['level'], [90, 91, 92, 1, 2]) ? "তাৎক্ষনিকভাবে লিখিত / মৌখিক পরীক্ষার মাধ্যমে প্রভাতী শাখায় ভর্তি করানো হবে।" : "০৮ জানুয়ারি-২০২৩ রোজ রবিবার";
        $date1 = in_array($admitter['level'], [3, 4, 5, 6, 9]) ? "০৬-জানুয়ারি-২০২৩ রোজ শুক্রবার " : "০৮-জানুয়ারি-২০২৩ রোজ রবিবার ";
//      in_array($admitter['level'], [90, 91,92, 1, 2]) ? " তাৎক্ষনিকভাবে মৌখিক পরীক্ষার মাধ্যমে প্রভাতী শাখায় ভর্তি করানো হবে।" : "সকাল ১১:০০ টা";
        $time = in_array($admitter['level'], [90, 91, 92, 1, 2]) ? " অফিস চলাকালীন সময়ে।" : "সকাল ১১:০০ টা";
        $time1 = in_array($admitter['level'], [3, 4, 5, 6, 9]) ? " সকাল ১০:৩০ টা" : "সকাল ১১:০০ টা";

        $subject = in_array($admitter['level'], [90, 91, 92, 1, 2]) ? "শুধুমাত্র মৌখিক পরীক্ষা" : (in_array($admitter['level'], []) ? "বাংলা-১০, ইংরেজি-১০, গণিত-২০" : (in_array($admitter['level'], [3, 4, 5, 6]) ? "বাংলা-১০, ইংরেজি ২০, গণিত ২০" : (in_array($admitter['level'], [7, 8, 9]) ? "বাংলা-১০, ইংরেজি-১৫, গণিত ১৫, বিজ্ঞান ১০" : "")));
        ?>
                        </div>
                        <!--</div>-->
                        <!--                        <div class="BoxC border- padding mar-bot">
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <h5>Roll No:<span class="rollNo"><?php echo sprintf("%05s", $admitter['roll']); ?></span></h5>
                                                        </div>
                                                    </div>
                                                </div>-->
                        <div class="BoxD border- padding mar-bot">
                            <div class="row">
                                <div class="col-sm-10">
                                    <table class="table table-bordered">
                                        <tbody>
                                        <h5 style="text-align: center">Admit Card</h5>
                                        <?php echo 'Class ' . $level_name . ' Admission Examination ' . ($admitter['session'] + 1); //pr($admitter);die;   ?>

                                        <tr>
                                            <td><b>Student Name: </b><?php echo $admitter['name']; ?></td>
                                            <td><b>Roll: </b><?php echo sprintf("%05s", $admitter['roll']); ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Father Name: </b><?php echo $admitter['fname']; ?></td>
                                            <td><b>DOB: </b><?php echo $admitter['dob']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Mother Name: </b><?php echo $admitter['mname']; ?></td>
                                            <td><b>Class: </b><?php echo $admitter['level']; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="    height: 125px;"><b>Address: </b><?php echo $admitter['location']; ?></td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-sm-2 txt-center">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                        <img src="/scms_packet/webroot/uploads/students/thumbnail/<?php echo $admitter['photo']; ?>" width="123px" height="165px" />
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="BoxE border- padding mar-bot txt-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h5>DATE OF EXAM</h5>
                                    <p> <span class="infoName infoName1"><?php
                if (in_array($admitter['level'], [90, 91, 92, 1, 2]))
                {
                echo $date;
                }
                else
                {
                echo $date1;
                }
                ?></span><p>

                                    <p><span class="infoTitle">Time</span> <span class="infoName infoName1"><?php
                if (in_array($admitter['level'], [90, 91, 92, 1, 2]))
                {
                echo $time;
                }
                else
                {
                echo $time1;
                }
                ?></span></p>
                                    <span class="infoTitle">Subject</span> <span><?php
                
            echo $subject; 
                ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="BoxF border- padding mar-bot txt-center">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered">
                                        <span style="font-size:20px; font-weight:bold"> * </span>
                                        পরীক্ষার উত্তর পত্রে অবশ্যই কালো কালির কলম ব্যবহার করতে হবে।<span style="font-size:20px; font-weight:bold"> * </span>
                                        পরীক্ষার সময় অবশ্যই প্রবেশ পত্রটি সঙ্গে আনতে হবে ।<span style="font-size:20px; font-weight:bold"> * </span>
                                        বিস্তারিত তথ্যের জন্য ওয়েবসাইট এ দেখুন <span style="font-size:18px; font-weight:bold">www.abrmsc.edu.bd</span>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <footer class="txt-center">
                            <?php
            $left = 28;
            $top = 72;
            echo $this->Html->image("/images/admission/signature.png", array("alt" => "", 'style' => "left:{$left}px;top:{$top}px"));
            ?>
                            <b>Signature (Principal)</b>
                        </footer>

                    </div>
                </div>

            </section>


            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>





</div><!--End of admitWrap-->
<div class="btnWrap2">
    <?php //<a class="account" href="#">বন্ধ করুন</a>    ?><a class="account" href="javascript:window.print();">প্রিন্ট করুন</a>
</div><!--End of btnWrap-->
    <?php endif; ?>


<?php else: ?>
<div class="infoWrap">
    <h2>নিচে ফরম পূরণ করে Submit Button টী চাপুন :</h2>
        <?php echo $this->Form->create('Admission', array('action' => 'admitcard', 'class' => 'admitForm')); ?>
    <div class="formWrap">
    <?php if (!empty($validationErrors)) echo '<div class="error-message" style="color:#fff;padding:15px; background:#F99;margin:0 0 10px">' . (empty($validationErrors['pErr']) ? 'Please fill up the form correctly!' : $validationErrors['pErr']) . '</div>'; ?>
        <div class="formCont">
            <div class="formLft">
    <?php if ($this->Form->isFieldError('ref')) echo $this->Form->error('ref'); ?>
                <label>
                    Reference/Ref 
            <?php echo $this->Form->text('ref', array('class' => 'field1', 'style' => 'text-transform:none')); ?>
                </label>
    <?php if ($this->Form->isFieldError('Payment.trxId')) echo $this->Form->error('Payment.trxId'); ?>
                <label>
                    Transaction/TrxID
    <?php echo $this->Form->text('Payment.trxId', array('class' => 'field1')); ?>
                </label>
            </div><!--End of formLft-->
    <?php echo $this->Form->submit('Submit', array('class' => 'subBtn3', 'div' => false)); ?>
            <div class="clear"></div>
            <div class="msgcont">
                বিস্তারিত তথ্যের জন্য এবং কোন জটিলতার সম্মুখীন হলে এই নম্বর গুলোতে তাৎক্ষনাত যোগাযোগ করুন।  কলেজঃ ০১৭১৯৭৫০৪৬৫ (মোঃ ইয়াকুব আলী সহকারী শিক্ষক), টেকনিক্যালঃ ০১৯৪১২০১২০৭, ০১৭০৮৫১৮৭২১, ০১৯৪১২০১২০৯ 
            </div>
        </div><!--End of formCont-->
    </div><!--End of formWrap-->
    <?php echo $this->Form->end(); ?>
</div><!--End of infoWrap-->
<?php endif; ?>
