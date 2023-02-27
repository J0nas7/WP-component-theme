<?php
// WOOCOMMERCE START

/*
    content-product-cat.php
*/
//// REMOVE CATEGORY THUMBNAIL
remove_action( 'woocommerce_before_subcategory_title', 'woocommerce_subcategory_thumbnail' );
//// REMOVE CATEGORY COUNTER
add_filter( 'woocommerce_subcategory_count_html', 'hide_category_count' );
function hide_category_count() {
    // No count
}
//// ADD SUB-CATEGORY TITLE
add_action( 'woocommerce_shop_loop_subcategory_title', 'subcat_title', 15 );
function subcat_title($mainCategory) {
    $parent_category_ID = $mainCategory->term_id;
    $args = array(
        'hierarchical' => 1,
        'show_option_none' => '',
        'hide_empty' => 0, // Set to 0 to show empty categories and 1 to hide them
        'parent' => $parent_category_ID,
        'taxonomy' => 'product_cat'
    );
    $subcategories = get_categories($args);
    
    echo '<ul class="woo_subcategory_list">';
    foreach ($subcategories as $subcategory) {
        $link = get_term_link( $subcategory->slug, $subcategory->taxonomy );
        echo '<li><a href="'. $link .'">'.$subcategory->name.'</a></li>';
    }
    echo '</ul>';
}

/*
     content-product.php:
*/
//// REMOVE CATEGORY COUNTER
add_action( 'after_setup_theme', 'my_remove_product_result_count', 99 );
function my_remove_product_result_count() { 
    remove_action( 'woocommerce_before_shop_loop' , 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_after_shop_loop' , 'woocommerce_result_count', 20 );
}

/*
    content-single-product.php
*/
//// REMOVE UPSELL AND RELATED
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

/*
    Add "alphabetically" to WC ordering options
*/
add_filter( 'woocommerce_get_catalog_ordering_args', 'custom_woocommerce_get_catalog_ordering_args' );

function custom_woocommerce_get_catalog_ordering_args( $args ) {
    $orderby_value = isset( $_GET['orderby'] ) ? woocommerce_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );

    if ( 'alphabetical' == $orderby_value ) {
        $args['orderby'] = 'title';
        $args['order'] = 'ASC';
    }

    return $args;
}

add_filter( 'woocommerce_default_catalog_orderby_options', 'custom_woocommerce_catalog_orderby' );
add_filter( 'woocommerce_catalog_orderby', 'custom_woocommerce_catalog_orderby' );

function custom_woocommerce_catalog_orderby( $sortby ) {
    $sortby['alphabetical'] = __( 'Sortér Alfabetisk' );
    return $sortby;
}

// WOOCOMMERCE END
?>