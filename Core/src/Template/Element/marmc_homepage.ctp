<?php

use Cake\Core\Configure;

$siteTitle = Configure::read('Site.title');
$siteSortForm = Configure::read('Site.sortForm');
$instituteName = Configure::read('Site.institute');
$siteIntro = Configure::read('Site.Intro');
$siteLogo = Configure::read('Site.Logo');
$siteTemplate = Configure::read('Site.template');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $siteSortForm ?> - Home</title>
    <link rel="canonical" href="./">
    <meta name="robots" content="index, follow">
    <meta name="generator" content="TechPlexus (http://tech-plexus.com)">
    <meta name="web-author" content="TechPlexus (http://tech-plexus.com)">
    <meta name="description" content="M Abdur Rahim Medical College, Dinajpur (MARMC) (Bengali: এম আব্দুর রহিম মেডিকেল কলেজ), formerly known as Dinajpur Medical College, is one of the best government medical colleges in Bangladesh.">
    <meta name="keywords" content="MARMC, M Abdur Rahim Medical College, এম আব্দুর রহিম মেডিকেল কলেজ, Dinajpur">
    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title" content="MARMC Official Website">
    <meta property="og:description" content="M Abdur Rahim Medical College, Dinajpur (MARMC) (Bengali: এম আব্দুর রহিম মেডিকেল কলেজ), formerly known as Dinajpur Medical College, is one of the best government medical colleges in Bangladesh.">
    <meta property="og:url" content="./">
    <meta property="og:site_name" content="MARMC">
    <meta property="og:image" content="https://dl.dropboxusercontent.com/s/ab4rq32nhux4kwy/bsmmc_feature.jpg?dl=0">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="675">
    <meta property="article:publisher" content="./">
    <link rel="icon" href="./assets/img/bsmmc_logo_en.png">
    <meta property="article:published_time" content="">
    <meta property="article:modified_time" content="">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:image" content="https://dl.dropboxusercontent.com/s/ab4rq32nhux4kwy/bsmmc_feature.jpg?dl=0">

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [{
                "@type": "CollegeOrUniversity",
                "@id": "https:./#CollegeorUniversity",
                "name": "M Abdur Rahim Medical College",
                "sameAs": [
                    "https://en.wikipedia.org/wiki/Bangabandhu_Sheikh_Mujib_Medical_College",
                    "https://g.page/MARMC",
                ],
                "url": "https:./",
                "telephone": "+88063161744",
                "logo": {
                    "@type": "ImageObject",
                    "url": "https://dl.dropboxusercontent.com/s/ipdw0dudetwazpk/bsmmc_logo_en.png?dl=0"
                },
                "address": {
                    "@type": "PostalAddress",
                    "addressLocality": "West Khabashpur",
                    "addressRegion": "Dinajpur",
                    "postalCode": "5200"
                }
            }]
        }
    </script>
</head>

<body data-aos-easing="slide" data-aos-duration="800" data-aos-delay="0" data-new-gr-c-s-check-loaded="14.1145.0" data-gr-ext-installed="">
    <div class="untree_co-hero overlay" style="background-image: url('./webroot/uploads/homeBanner.jpg')">
        <div class="container">
            <div class="row align-items-center justify-content-center" style="padding-top: 100px;">
                <div class="col-12">
                    <div class="row justify-content-left">
                        <div class="col-lg-6 text-center align-self-center order-lg-2">
                            <a href="https://www.youtube.com/watch?v=D-F8y3EO5oQ" data-fancybox="" class="video-play-btn aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                                <span class="icon-play"></span>
                            </a>
                        </div>
                        <div class="col-lg-6 text-center text-lg-left">
                            <h1 class="mb-4 heading text-white aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                                <?= $instituteName ?>
                            </h1>
                            <div class="mb-5 text-white desc mx- aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                                <p><?= $siteIntro ?> </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="untree_co-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-5">
                <div class="col-lg-7 text-center aos-init" data-aos="fade-up" data-aos-delay="0">
                    <h2 class="line-bottom text-center mb-4">Notice &amp; News</h2>
                    <p>Find the latest news and updates of M Abdur Rahim Medical College, Dinajpur</p>
                </div>
            </div>

            <?= $this->element('marmc_node_section'); ?>

        </div>
    </div>
    <div class="untree_co-section pt-0 bg-img overlay" style="background-image: url('./webroot/uploads/classroom.png');">
        <div class="container">
            <div class="row align-items-center justify-content-center text-center">
                <div class="col-lg-7">
                    <h2 class="text-white mb-3 aos-init" data-aos="fade-up" data-aos-delay="0">Education for Tomorrow's Doctors
                    </h2>
                    <p class="text-white h5 mb-4 aos-init" data-aos="fade-up" data-aos-delay="100">At M Abdur Rahim
                        Medical College, along with teaching the latest knowledge of medicine, we believe to nurture the great
                        qualities of human mind that are required for serving the humanity.
                    </p>
                    <p><a href="./page/mission-vision/" class="btn btn-primary aos-init" data-aos="fade-up" data-aos-delay="200">Mission &amp; Vision</a></p>
                </div>
            </div>
        </div>
    </div>

    <?= $this->element('marmc_home_message') ?>

    <div id="overlayer" style="display: none;"></div>
    <div class="loader" style="display: none;">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

</body>

</html>
