<!DOCTYPE html>
<html <?php echo ((is_single()) && ('post' == get_post_type())) ? language_attributes() : ''; ?>>
<head>
    <title><?php wp_title( '-', true, 'right' ); echo wp_specialchars( get_bloginfo('name'), 1 ) ?><?php if ($wptitle == "") { echo " - "; bloginfo('description'); } ?></title>
    <meta name="google-site-verification" content="gopVig1vD9ASr_RMvJGPk5w2Rk9dQ16tJY4v7-5E5dc" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <?php echo !((is_single()) && ('post' == get_post_type())) ? '<meta name="description" content="' . page_description() . '" />' : ''; ?>
<?php wp_head(); ?>
    <link rel="stylesheet" href="<?php bloginfo ("template_url"); ?>/css/style.css" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" href="<?php bloginfo ("template_url"); ?>/css/style_ie7.css" />
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<?php include 'letter_array_create.php'; ?>
    <script src="<?php bloginfo ("template_url"); ?>/js/script.js"></script>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-350036-10']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

    </script>
</head>
<body class="wordpress y2011 m12 d07 h07  page pageid-4 page-author-admin page-template page-template-home-php">
<div class="wrapper hfeed">
    <header class="rounded-corners din-schrift site_header">
        <h1>RAAK</h1>
        <a id="title" href="<?php bloginfo('home') ?>/" title="<?php echo wp_specialchars( get_bloginfo('name'), 1 ) ?>" rel="home">
            <span id="logo_letter_1" class="logo_letter">
                <span>
                    <img alt="logo r" src="<?php bloginfo ("template_url"); ?>/images/r.jpeg" />
                </span>
            </span>
            <span id="logo_letter_2" class="logo_letter">
                <span>
                    <img alt="logo a" src="<?php bloginfo ("template_url"); ?>/images/a1.jpeg" />
                </span>
            </span>
            <span id="logo_letter_3" class="logo_letter">
                <span>
                    <img alt="logo a" src="<?php bloginfo ("template_url"); ?>/images/a2.jpeg" />
                </span>
            </span>
            <span id="logo_letter_4" class="logo_letter">
                <span>
                    <img alt="logo k" src="<?php bloginfo ("template_url"); ?>/images/k.jpeg" />
                </span>
            </span>
        </a>
        <div id="blog-description">Putting you in touch with your crowds</div>
            <div class="skip-link"><a href="#content" title="Skip to content">Skip to content</a></div>
<?php
//include 'stats_table.php';
wp_nav_menu(array('container'=>'nav', 'container_class'=>'menu', 'before'=>'<div class="topmenu_top"></div><div class="topmenu_body">', 'after'=>'</div>')); 
?> 
    </header><!--  header -->
