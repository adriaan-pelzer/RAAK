<!DOCTYPE html>
<html<?php echo (is_single()) ? ' xmlns:fb="http://ogp.me/ns/fb#" itemscope itemtype="http://schema.org/Blog"' : ''; ?>>
<head>
    <title>RAAK | Digital &amp; Social Media Agency London - Putting you in touch with your crowds</title>
    <meta name="google-site-verification" content="59Ab_0-HL7eVdNQ4CqiLOeiQisQgb2Vwg8046N__ng0" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script>
    var letters = [];
    </script>
<?php
$different_letters = array('r', 'a', 'k');
foreach($different_letters as $different_letter) {
    $array_name = strtoupper($different_letter);
    $each_letter = new WP_Query(array('post_type' => 'raak_logo_letter', 'posts_per_page' => -1, 'meta_value' => $different_letter));
    while($each_letter->have_posts()) {
        $each_letter->the_post();
?>
        <script>
        letters['<?php echo $array_name; ?>'] =[];
        letters['<?php echo $array_name; ?>'].push('<?php echo get_post_meta(get_the_ID(), 'file', TRUE); ?>');
        </script>
<?php
    }
}
?>
    <script src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/js/script.js"></script>
    <link rel="stylesheet" href="<?php bloginfo ("template_url"); ?>/css/style.css" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" href="<?php bloginfo ("template_url"); ?>/css/style_ie7.css" />
    <![endif]-->
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
</head>
<body class="wordpress y2011 m12 d07 h07  page pageid-4 page-author-admin page-template page-template-home-php">
<div class="wrapper hfeed">
    <header class="rounded-corners din-schrift site_header">
        <h1>RAAK</h1>
        <a id="title" href="http://wewillraakyou.com/" title="RAAK | Digital &amp; Social Media Agency London" rel="home">
            <span id="logo_letter_1" class="logo_letter">
                <img alt="logo r" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/r.jpeg" />
            </span>
            <span id="logo_letter_2" class="logo_letter">
                <img alt="logo a" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/a1.jpeg" />
            </span>
            <span id="logo_letter_3" class="logo_letter">
                <img alt="logo a" src="http://stage.wewillraakyou.com/wp-content/themes/RAAK/images/a2.jpeg" />
            </span>
            <span id="logo_letter_4" class="logo_letter">
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
    </header><!--  header -->
