<?php

/**
 * Hide category/categories on shop page.
 */
function get_subcategory_terms( $terms, $taxonomies, $args ) {
 
	$new_terms 	= array();
	$hide_category 	= array( x, y, z ); // Ids of the category you don't want to display on the shop page
 	
	if ( in_array( 'product_cat', $taxonomies ) && !is_admin() && is_shop() ) {
	    foreach ( $terms as $key => $term ) {
            if ( ! in_array( $term->term_id, $hide_category ) ) { 
                $new_terms[] = $term;
            }
	    }
	    $terms = $new_terms;
	}
  return $terms;
}
add_filter( 'get_terms', 'get_subcategory_terms', 10, 3 );
