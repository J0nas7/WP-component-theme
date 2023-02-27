<?php
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus( array(
        'mainmenu'   => 'Display this menu as Primary',
        'shortcuts'   => 'Display this menu in Shortcut topmenu',
    ) );
}

// WIDGET AREAS START
function custom_register_widget_area($name, $id) {
    if (function_exists('register_sidebar')) {
        register_sidebar(array(
                'name' => $name,
                'id' => $id,
                'before_widget' => '<div class="widget-item '.$id.'">',
                'after_widget' => '<div class="clrBth"></div></div>',
                'before_title' => '<h3>',
                'after_title' => '</h3>',
            )
        );
    }
}
$widgetAreas = array(
    "Header Widgets" => "header-widgets", 
    "Over Component Widgets" => "over-component",
    "Left of Component Widgets" => "left-of-component",
    "Right of Component Widgets" => "right-of-component",
    "Under Component Widgets" => "under-component"
);
foreach ($widgetAreas AS $name => $id) {
    custom_register_widget_area($name, $id);
}
// WIDGET AREAS END

require_once("woocommerce-actions.php");
?>