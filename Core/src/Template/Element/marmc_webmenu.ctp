<style>
    .menu,
    .menu ul {
        margin: 0px;
        padding: 0px;
        list-style: none;
    }

    .menu {
        width: 100%;
        background-color: transparent;
    }

    .menu:before,
    .menu:after {
        content: "";
        display: block;
    }

    .menu:after {
        clear: both;
    }

    #menu-wrap>ul.menu>li.nav-item>a {
        color: #fafafa;
    }

    #menu-wrap>ul.menu>li.nav-item {
        display: flex;
        height: 40px;
        float: left;
        padding: 0 !important;
        /* font-weight: 500; */
        position: relative;
        align-items: center;
    }


    .menu a {
        float: left;
        color: #000;
        text-decoration: none;
        font: bold 12px Arial, Helvetica;
    }



    .menu ul {
        margin: 20px 0px 0px 0px;
        opacity: 0;
        visibility: hidden;
        position: absolute;
        top: 38px;
        left: 0px;
        z-index: 1;
        background-color: #fafafa;
        transition: all .2s ease-in-out;
        text-align: left;
        box-shadow: 0 2px 10px -2px rgba(0, 0, 0, 0.1);

    }

    .menu li:hover>ul {
        opacity: 1;
        visibility: visible;
        margin: 0px;
    }

    .menu ul ul {
        top: 0px;
        left: 130px;
        margin: 0px 0px 0px 20px;
        box-shadow: 0 2px 10px -2px rgba(0, 0, 0, 0.1);

    }

    .menu ul a {
        padding: 10px;
        width: 130px;
        display: block;
        white-space: wrap;
        float: none;
        text-transform: none;
    }

    .menu ul a:hover {
        color: #008b8b;
    }

    ul.menu li a:hover {
        color: #008b8b !important;
    }

    ul.menu li.nav-item.dropdown:hover>a::after {
        color: #008b8b;
    }


    .menu ul li:first-child>a:after {
        content: '';
        position: absolute;
        left: 40px;
        top: -6px;
    }

    .menu ul ul li:first-child>a:after {
        left: -12px;
        top: 50%;
        margin-top: -6px;
    }

    #menu-trigger {
        display: none;
    }




    ul.menu li.nav-item.dropdown>a::after {
        content: "▼";
        margin-left: 1px;
        color: #fafafa;
        font-size: 8px;
    }

    ul.menu li.nav-item.dropdown ul li.nav-link::after {
        content: none;
    }

    li.dropdown i {
        font-size: 10px
    }

    @media(min-width: 701px) {
        li.dropdown {
            display: flex;
            align-items: center;
            padding-right: 0.75em;
        }

        li.dropdown i {
            right: 10%;
            position: absolute;
        }
    }


    .is-sticky a {
        color: #000 !important;
    }

    .is-sticky ul.menu li.nav-item.dropdown>a::after {
        content: "▼";
        margin-left: 1px;
        color: #000;
        font-size: 8px;
    }

    .is-sticky .menu ul a:hover {
        color: #008b8b !important;
    }


    @media(max-width: 700px) {

        #menu-wrap {
            position: relative;
        }

        #menu-wrap* {
            box-sizing: border-box;
        }

        #menu-trigger {
            display: flex;
            cursor: pointer;
            height: 40px;
            color: #fff;
            font-weight: bold;
            flex-direction: column;
            justify-content: center;
            align-items: flex-end;
        }

        .is-sticky #menu-trigger {
            color: #000;
        }

        .menu {
            margin: 0px;
            margin-top: 0.5em;
            padding: 10px;
            position: relative;
            top: 100%;
            width: 100%;
            z-index: 1;
            display: none;
            box-shadow: none;
            background: #fafafa;
            text-align: left;
        }

        .menu:after {
            content: '';
            position: absolute;
            left: 25px;
            top: -8px;
        }

        .menu ul {
            width: 100%;
            position: static;
            visibility: visible;
            opacity: 1;
            margin: 0px;
            background: none;
            box-shadow: none;

        }

        .menu ul ul {
            margin: 0px 0px 0px 20px;
            box-shadow: none;
        }

        .menu ul ul li:first-child>a:after {
            border-top: 0px;
            border-bottom: 0;
        }

        .menu li {
            position: static;
            display: block;
            float: none;
            border: 0px;
            margin: 5px;
            box-shadow: none;
            background: none !important;
        }

        .menu ul li {
            margin-left: 20px;
            box-shadow: none;
        }

        .menu a {
            font-size: 14px;
            width: 100%;
            display: block;
            float: none;
            padding: 0px;
        }

        .menu a:hover {
            color: #fafafa;
        }

        .menu ul a {
            padding: 0px;
            width: auto;
        }

        .menu ul a:hover {
            background: none !important;
        }
    }
</style>



<nav id="menu-wrap">
    <?= $this->Menus->menu('main', [
        'class' => '',
        'dropdown' => true,
        'dropdownClass' => 'menu',
        'subTagAttributes' => [
            'class' => 'nav-item',
        ],
        'linkAttributes' => [
            'class' => 'nav-link',
        ],
    ]);
    ?>
</nav>
<script>
    $(document).one('ready', function() {
        $('#menu-wrap').prepend('<div id="menu-trigger"><i class="fa fa-bars mr-2"></i></div>');
        $('#menu-trigger').on('click', function() {
            $('.menu').slideToggle();
        });
    });
</script>

<script>
    var elementsWithBgDarkClass = document.querySelectorAll(".bg-dark");
    var elementsWithDropdownClass = document.querySelectorAll(".dropdown-toggle");

    // Function to remove classes based on screen size
    function removeClassesBasedOnScreenSize() {
        if (window.innerWidth < 700) {
            var elementsWithNavItemClass = document.querySelectorAll(".nav-item");
            var elementsWithNavLinkClass = document.querySelectorAll(".nav-link");

            elementsWithNavItemClass.forEach(function(element) {
                element.classList.remove("nav-item");
            });

            elementsWithNavLinkClass.forEach(function(element) {
                element.classList.remove("nav-link");
            });
        }
    }


    elementsWithBgDarkClass.forEach(function(element) {
        element.classList.remove("bg-dark");
        element.classList.remove("dropdown-menu");
        element.classList.remove("dropdown-item");
    });
    elementsWithDropdownClass.forEach(function(element) {
        element.classList.remove("dropdown-toggle");
    });

    // Call the function on page load and when the window is resized
    removeClassesBasedOnScreenSize();

    window.addEventListener("resize", removeClassesBasedOnScreenSize);
</script>
