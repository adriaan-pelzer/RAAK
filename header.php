<!DOCTYPE html>
<html>
<head>
    <title>RAAK | Digital &amp; Social Media Agency London - Putting you in touch with your crowds</title>
    <meta name="google-site-verification" content="59Ab_0-HL7eVdNQ4CqiLOeiQisQgb2Vwg8046N__ng0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <link rel="stylesheet" href="<?php bloginfo ("template_url"); ?>/css/style.css" />
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body class="wordpress y2011 m12 d07 h07  page pageid-4 page-author-admin page-template page-template-home-php">
<div class="wrapper hfeed">
    <header class="rounded-corners din-schrift site_header">
        <h1>RAAK</h1>
        <a id="title" href="http://wewillraakyou.com/" title="RAAK | Digital &amp; Social Media Agency London" rel="home">
            <span id="logo_letter_r1" class="logo_letter">
                <img alt="logo r" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/r.jpeg" />
            </span>
            <span id="logo_letter_a2" class="logo_letter">
                <img alt="logo a" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/a1.jpeg" />
            </span>
            <span id="logo_letter_a3" class="logo_letter">
                <img alt="logo a" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/a2.jpeg" />
            </span>
            <span id="logo_letter_k4" class="logo_letter">
                <img alt="logo k" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/k.jpeg" />
            </span>
            </a>
        <div id="blog-description">Putting you in touch with your crowds</div>
            <div class="skip-link"><a href="#content" title="Skip to content">Skip to content</a></div>
            <nav class="menu">
                <ul>
                    <li class="first-page-item">
                        <div class="first_topmenu_top"></div>
                        <div class="first_topmenu_body"></div>
                    </li>
                    <li class="page_item page-item-4 current_page_item">
                        <div class="topmenu_top"></div>
                        <div class="topmenu_body"><a href="<?php bloginfo('url');?>" title="Home">Home</a></div>
                    </li>
                    <li class="page_item page-item-1668">
                        <div class="topmenu_top"></div>
                        <div class="topmenu_body"><a href="<?php echo get_page_link(5209); ?>" title="About" rel="nofollow">About</a></div>
                    </li>
                    <li class="page_item page-item-2720">
                        <div class="topmenu_top"></div>
                        <div class="topmenu_body"><a href="<?php echo get_page_link(5212); ?>" title="Logo Project">Logo Project</a></div>
                    </li>
                    <li class="page_item page-item-5169">
                        <div class="topmenu_top"></div>
                        <div class="topmenu_body"><a href="<?php echo get_page_link(5219); ?>" title="Our Products">Our Products</a></div>
                    </li>
                    <li class="page_item page-item-36">
                        <div class="topmenu_top"></div>
                        <div class="topmenu_body"><a href="<?php echo get_page_link(5223); ?>" title="Our work" rel="nofollow">Our work</a></div>
                    </li>
                    <li class="page_item page-item-211">
                        <div class="topmenu_top"></div>
                        <div class="topmenu_body"><a href="<?php echo get_page_link(5233); ?>" title="Blog">Blog</a></div>
                    </li>
                    <li class="page_item page-item-341">
                        <div class="topmenu_top"></div>
                        <div class="topmenu_body"><a href="<?php echo get_page_link(5229); ?>" title="Contact" rel="nofollow">Contact</a></div>
                    </li>
                </ul>
            </nav>
    </header><!--  #header -->

<script type="text/javascript">
<!--
var post_count = 10;
var curr_page = 0;

function expand (id) {
    var elements_to_hide = new Array();
    elements_to_hide[0] = 'social-media-ready';
    elements_to_hide[1] = 'impact-projects';
    elements_to_hide[2] = 'consulting';

    var element_to_expand = document.getElementById (id);
    var menu_item_to_activate = document.getElementById ("bluebox_nav_"+id);
    var element_to_hide;

    for (i = 0; i < 3; i++) {
        element_to_hide = document.getElementById(elements_to_hide[i]);
        menu_item_to_deactivate = document.getElementById("bluebox_nav_"+elements_to_hide[i]);
        if (element_to_hide.style.display != 'none') {
            element_to_hide.style.display = 'none';
        }
        if (menu_item_to_deactivate.className == "bluebox_nav_item active") {
            menu_item_to_deactivate.className = "bluebox_nav_item";
        }
    }

    element_to_expand.style.display = 'block';
    menu_item_to_activate.className = "bluebox_nav_item active";
}

function previous () {
    if ((post_count - curr_page) > 2) {
        var element_to_hide = document.getElementById ("whitebox_primary_post_"+curr_page);
        curr_page += 2;
        var element_to_show = document.getElementById ("whitebox_primary_post_"+curr_page);
        element_to_hide.style.display = 'none';
        element_to_show.style.display = 'block';
        if ((post_count - curr_page) > 2) {
            document.getElementById('whitebox_primary_footer_prev_text').className = "whitebox_primary_footer_item active";
        } else {
            document.getElementById('whitebox_primary_footer_prev_text').className = "whitebox_primary_footer_item";
        }
        if (curr_page > 1) {
            document.getElementById('whitebox_primary_footer_next_text').className = "whitebox_primary_footer_item active";
        } else {
            document.getElementById('whitebox_primary_footer_next_text').className = "whitebox_primary_footer_item";
        }
    }
}

function next () {
    if (curr_page > 1) { 
        var element_to_hide = document.getElementById ("whitebox_primary_post_"+curr_page);
        curr_page -= 2;
        var element_to_show = document.getElementById ("whitebox_primary_post_"+curr_page);
        element_to_hide.style.display = 'none';
        element_to_show.style.display = 'block';
        if ((post_count - curr_page) > 2) {
            document.getElementById('whitebox_primary_footer_prev_text').className = "whitebox_primary_footer_item active";
        } else {
            document.getElementById('whitebox_primary_footer_prev_text').className = "whitebox_primary_footer_item";
        }
        if (curr_page > 1) {
            document.getElementById('whitebox_primary_footer_next_text').className = "whitebox_primary_footer_item active";
        } else {
            document.getElementById('whitebox_primary_footer_next_text').className = "whitebox_primary_footer_item";
        }
    }
}

//-->
</script>
