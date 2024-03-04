<link rel="stylesheet" href="//file-rangpur.portal.gov.bd/media/central/themes/theme-default/css/meganizr.css">


<style>
	.mzr-responsive li.col0 {
		display: block !important;
	}

	.meganizr .drop-five-columns {
		width: 700px;
	}

	/*==================================
    Menubar Broken Design css fix
    ===================================*/
	.meganizr .mzr-content {
		width: 172px;
	}

	li.c1 .mzr-content {
		width: 680px;
	}


	.menu .sub-menu .mzr-links a {
		padding: 5px 0px !important;
	}

	.menu .mzr-drop:hover .sub-menu {
		display: flex;
		opacity: 1;
	}

	.menu .sub-menu>div h6 {
		font-weight: bold;
		margin-bottom: 4px;
		/* padding: 3px 7px; */
	}

	.menu .sub-menu .mzr-links a {
		display: block;
		padding: 5px 7px;
		line-height: 20px;
		border-bottom: 1px dotted #e1e1e1;
		font-size: 15px;
	}

	.menu .sub-menu .mzr-links a:hover {
		color: #333;
		background-color: #eee;
	}

	.menu ul.menu-container {
		background-color: #fafafa;
		border-bottom: 1px dotted #cccccc;
		font-size: 12px;
		position: relative;
		display: flex;
	}

	.menu li {
		list-style: none;
	}

	.menu li.menu-link {
		border-right: 1px dotted #ccc;
	}

	.menu a {
		position: relative;
		z-index: 550;
		display: block;
		font-size: 12px !important;
		text-shadow: 0px 1px 1px white;
		transition: color 0.15s ease-in, background-image 0.2s linear 0.15s;
		margin: 0;
		cursor: pointer;
	}

	.row .menu a:hover {
		color: #0c0c0c;
		/* background-color: #000000; */
		text-decoration: none;
	}

	.menu .c1:hover>a {
		background-color: #ff6600;
		color: #fff;
	}

	.menu .c1>a,
	.menu .c1 h6 {
		color: #ff6600;
	}

	.menu .c1 .sub-menu {
		border-top: #ff6600 solid 8px;
	}

	.mob_menu {
		background: #fafafa;
		height: 40px;
		margin-bottom: 10px;
	}

	.mob_menu a.show-menu {
		background-repeat: no-repeat !important;
		padding-left: 5px;
		background-color: #fafafa;
		line-height: 40px;
		display: block;
		background-position: -3px 0;
	}

	.mob_menu a.show-menu:focus,
	.mob_menu a.show-menu:visited {
		text-decoration: none !important
	}

	.menu ul.menu-container {

		display: block !important;
	}

	.meganizr .one-col,
	.meganizr .two-col,
	.meganizr .three-col,
	.meganizr .four-col,
	.meganizr .five-col,
	.meganizr .six-col {
		float: left;
		margin: 5px !important;
	}


	@media print {
		.menu .sub-menu {
			display: none !important;
		}
	}


	ul.mzr-links li>ul {
		margin-left: 15px;
	}

	ul.mzr-links li>ul li a {
		font-size: 14px !important;
		display: block;
		padding: 0 10px;
	}




	/*--------------------- add new css------------------------- */
	.menu .sub-menu .mzr-links a:focus-within {
		text-decoration: none !important;
	}

	.menu .focusin-drop:focus-within .sub-menu {
		display: flex;
		opacity: 1;
	}

	.focusin-drop:focus-within .mzr-content {
		border-top: none !important;
	}

	.meganizr>li.focusin-drop:focus-within>a {
		z-index: 650;
	}

	.meganizr>li.focusin-drop:focus-within>a:after {
		position: absolute;
		content: '';
		top: 0;
		left: 0;
		width: 100%;
	}

	.meganizr>li.focusin-drop:focus-within>a:after,
	.meganizr>li.focusin-drop>a.mzr-click:after {
		position: absolute;
		content: '';
		top: 0;
		left: 0;
		width: 100%;

	}


	.meganizr>li.focusin-drop:focus-within>a,
	.meganizr>li.focusin-drop>a.mzr-click {
		z-index: 650;
	}

	@media only screen and (min-width:980px) {

		.mzr-slide>li.focusin-drop:focus-within>div,
		.mzr-slide>li.focusin-drop:focus-within>ul,
		.mzr-slide>li>ul li.focusin-drop:focus-within>ul {
			top: 37px;
			opacity: 1;
			overflow: visible;
			visibility: visible;
			display: block;
		}

	}

	@media only screen and (max-width: 959px) {

		.mzr-responsive.mzr-slide>li.focusin-drop:focus-within>div,
		.mzr-responsive.mzr-slide>li.focusin-drop:focus-within>ul,
		.mzr-responsive.mzr-slide>li>ul li.focusin-drop:focus-within>ul,
		.mzr-responsive.mzr-fade>li.focusin-drop:focus-within>div,
		.mzr-responsive.mzr-fade>li.focusin-drop:focus-within>ul,
		.mzr-responsive.mzr-fade>li>ul li.focusin-drop:focus-within>ul {
			top: auto;
		}

	}

	.dropdown-menu,
	.dropdown-item a {
		background-color: #fff !important;
		color: #000 !important;
	}

	#MobNav {
		display: none;
		margin-top: -40px;
		/* Initially hide the navigation */
	}
</style>

<div class="row" style="margin-bottom: 15px;">
	<div class="col-md-12">
		<div class="menu d-none d-md-block cmn-mrg-btm">
			<?= $this->Menus->menu('main', [
				'dropdown' => true,
				'dropdownClass' => 'menu-container meganizr mzr-slide mzr-responsive',
				'subTagAttributes' => [
					'class' => 'mzr-drop menu-link  c1  focusin-drop focusClassDrop',
				],
				'linkAttributes' => [
					'class' => 'nav-link head_link bg-transparent',
				],
			]); ?>
		</div>
	</div>
</div>


<nav class="navbar navbar-expand-lg navbar-light custom_bg_nav " id="MobNav">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNav">
		<?=
		$this->Menus->menu('main', [
			'class' => ' bg-dark',
			'dropdown' => true,
			'dropdownClass' => ' navbar-nav mr-auto flex-wrap',
			'subTagAttributes' => [
				'class' => 'nav-item bg-transparent active_menu',
			],
			'linkAttributes' => [
				'class' => 'nav-link head_link bg-transparent',
			],
		]);
		?>
	</div>
</nav>


<script>
	$(document).ready(function() {
		// Find the element with the class focusClassDrop
		var focusClassDropElement = $(".focusClassDrop");

		// Remove the bg-dark class from all child elements under focusClassDropElement
		focusClassDropElement.find("*").removeClass("bg-dark");
	});


	function toggleNavVisibility() {
		var windowWidth = $(window).width();
		if (windowWidth < 768) {
			$('#MobNav').show();
		} else {
			$('#MobNav').hide();
		}
	}



	/* Responsive Design*/
	$(document).ready(function() {

		toggleNavVisibility();
		$(window).on('resize', function() {
			toggleNavVisibility();
		});


		$(".focusClassDrop").hover(
			function() {
				$(".focusClassDrop").removeClass("focusin-drop");
			},
			function() {
				$(".focusClassDrop").addClass("focusin-drop");
			}
		);


		var wi = $(window).width();
		if (wi < 768) {
			$('#jmenu .show-menu').click(function() {

				$(".mzr-responsive").slideToggle(700, "linear", function() {});

			});

			$(".mzr-drop> a").click(function() {

				$(".mzr-drop> a").siblings().addClass('sibling-toggle');

				$(this).parent().find(".mzr-content").removeClass('sibling-toggle').addClass('slide-visible').slideToggle(700, "linear", function() {});
				return false;
			});
		}
	});
</script>