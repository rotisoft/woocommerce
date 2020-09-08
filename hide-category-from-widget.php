<?php

/**
 * Hide category from Woocommerce category widget.
 */
 
function woo_product_cat_widget_args( $cat_args ) {
    $cat_args['exclude'] = array('x, y, z'); // x, y, z is the ID numbers
    return $cat_args;
}

add_filter( 'woocommerce_product_categories_widget_args', 'woo_product_cat_widget_args' ); 
