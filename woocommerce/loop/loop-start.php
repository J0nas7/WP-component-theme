<?php
/**
 * Product Loop Start
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/loop-start.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if the WC page is a category-product-page
//if (!strpos($_SERVER["REQUEST_URI"], "/vare-kategori/")) {
if (get_query_var('taxonomy') !== "product_cat") {
    ?><ul class="products columns-<?php echo esc_attr( wc_get_loop_prop( 'columns' ) ); ?>"><?
} else {
    require_once "category-page-products-loop.php";

    $theParentCategoryID = get_queried_object_id();
    $taxonomy = 'product_cat';

    $loop_start_subcategories = get_terms([
        'taxonomy'    => $taxonomy,
        'hide_empty'  => true,
        'parent'      => $theParentCategoryID
    ]);

    echo '<ul class="product-category-subcats subcats-with-products" style="clear: both;">';

    // Loop through product subcategories WP_Term Objects
    if (count($loop_start_subcategories)) {
        foreach ($loop_start_subcategories AS $subCategory) {
            $subCategoryLink = get_term_link($subCategory, $taxonomy);
            // $term->term_id
            echo    "<li class='prod-cat-subcat-item ".$subCategory->slug."'>".
                    "<a href='".$subCategoryLink."'>".$subCategory->name."</a></li>";
            sub_category_id_print_products($subCategory->term_id);
        }
    } else {
        sub_category_id_print_products($theParentCategoryID);
    }

    echo '</ul>';
}
?>