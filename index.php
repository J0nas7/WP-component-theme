<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <title><?php bloginfo( 'name' ); ?><?php wp_title( '&mdash;' ); ?></title>
    <?php if ( is_singular() && get_option( 'thread_comments') ) wp_enqueue_script( 'comment-reply' ); ?>
    <?php wp_head(); ?>
    <link rel="stylesheet" type="text/css" media="all" href="<?=get_template_directory_uri();?>/style.min.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?=get_template_directory_uri();?>/custom-woocommerce.min.css" />
    <!--<link rel="stylesheet" type="text/css" media="all" href="<?php// bloginfo( 'stylesheet_url' ); ?>" />-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body <?php body_class(); ?>>
    <div id="page-container">
        <?php require_once "header.php"; ?>

        <div id="main-content">
            <?php
            function renderWidget($widget) {
                if (is_active_sidebar($widget)) {
                  echo "<div id='".$widget."'>";
                    echo "<div id='".$widget."-content'>";
                        dynamic_sidebar($widget);
                        echo "<div class='clrBth'></div>";
                    echo "</div>";
                  echo "</div>";
                }
            }
            renderWidget("over-component");
            renderWidget("left-of-component");
            require_once "posts.php";
            renderWidget("right-of-component");
            renderWidget("under-component");
            ?>
        </div>
    </div>
    <?php wp_footer(); ?>
    <script src="<?=get_template_directory_uri();?>/template.js" type="text/javascript"></script>
  </body>
</html>