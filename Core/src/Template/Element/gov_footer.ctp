<?php

use Cake\Core\Configure;

$siteTitle = Configure::read('Site.title');
$HeaderBanner = Configure::read('Site.banner');
$HeaderGovt = Configure::read('Site.GovtSign');
$institute = Configure::read('Site.institute');
$siteTagline = Configure::read('Site.tagline');
$address = Configure::read('Site.Address'); //Case Sensitive
$footerLogo = Configure::read('Footer.logo');
$footerBg = Configure::read('Footer.background');
$siteURL = $this->Url->build(["plugin" => "Croogo/Nodes", "controller" => "Nodes", "action" => "promoted"]);
?>

<div class="footer-artwork">
	<img src="https://file-rajshahi.portal.gov.bd/media/central/themes/theme-default/img/footer_top_bg.png" class="w-100" alt="">
</div>
<div class="footer_bg_gov py-3">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-12 footer_logo_position"><a href="<?= $siteURL ?>"><?= $this->Html->image($footerLogo, array("alt" => $institute, "class" => "ftr_logo_gov")); ?>
				</a>
				<b style="color: #000; font-size: 12px; top: 170px;position: absolute">&copy; <?= (new DateTime)->format("Y"); ?> All Rights Reserved</b>
			</div>
			<div class="col-md-4 col-12 address_layout_gov text-dark"><?= $address ?></div>
			<div class="col-md-5 col-12 footer_nav_gov">
				<nav class="navbar navbar-expand-lg">
					<?= $this->Menus->menu('footer', [
						'dropdown' => true,
						'subTagAttributes' => ['class' => 'nav-item text-left footer_2_menu',],
						'linkAttributes' => ['class' => 'nav-link footer_2_link ',],
					]); ?>
				</nav>
			</div>
			<div class="col-md-12 company_logo_gov text-right">
				<a href="http://tech-plexus.com/" class="ftrLogo" target="_blank"><?php echo $this->Html->image("/uploads/Home/ftrlogo.png", array("alt" => "TechPlexus Ltd.")); ?></a>
			</div>
		</div>
	</div>
</div>
