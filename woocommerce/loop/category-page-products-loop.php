<?php
function sub_category_id_print_products($subCategoryID) {
    // Get all the products in the category ("tax_query")
    $query = array(
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
        'post_type'         => 'product',
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field'    => 'id',
                'terms'    => $subCategoryID,
            ),
        ),
        'meta_query'        => WC()->query->get_meta_query()
    );

    // Sort by "orderby"
    $theOrder = sanitize_text_field($_GET['orderby']);
    if ($theOrder == "alphabetical") {      $query['orderby'] = 'title'; $query['order'] = 'asc';
    } else if ($theOrder == "price") {      $query['orderby'] = 'meta_value_num'; $query['meta_key'] = '_price'; $query['order'] = 'asc';
    } else if ($theOrder == "price-desc") { $query['orderby'] = 'meta_value_num'; $query['meta_key'] = '_price'; $query['order'] = 'desc';
    } else {                                $query['orderby'] = 'meta_value_num'; $query['meta_key'] = 'total_sales'; $query['order'] = 'desc'; }
    $subcatProducts = new WP_Query($query);

    if ($subcatProducts->have_posts()) {
        echo "<ul class='category-subcat-products products'>";
        // Display the products
        while ($subcatProducts->have_posts()) {
            $subcatProducts->the_post();
            
            require(ABSPATH."wp-content/plugins/woocommerce/templates/content-product.php");
        }
        echo "</ul>";
    }
}
?>