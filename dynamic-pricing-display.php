<?php
/*
* Dynamic Pricing kedvezmenyek megjelenitese
*/
add_action( 'woocommerce_single_product_summary', 'sd_display_bulk_discount_table', 15 );

function sd_display_bulk_discount_table() {

	global $woocommerce, $post, $product;

	$array_rule_sets = get_post_meta( $post->ID, '_pricing_rules', true );

	if ( $array_rule_sets && is_array( $array_rule_sets ) && sizeof( $array_rule_sets ) > 0 ) {

    $tempstring .= '<div class="dynamicpricingdisplay">';
    $tempstring .= '<p>Mennyiségi kedvezményeink:</p>';
    $tempstring .= '<ul>';

	foreach( $array_rule_sets as $pricing_rule_sets ) {

		foreach ( $pricing_rule_sets['rules'] as $key => $value ) {

			switch ( $pricing_rule_sets['rules'][$key]['type'] ) {

			    case 'percentage_discount':

			    $woosymbol = '%';

			    break;

			    case 'price_discount':

			    $woosymbol = get_woocommerce_currency_symbol();

			    break;

            }
            
        $szorzo = $pricing_rule_sets['rules'][$key]['amount'];
        $ar = $product->get_price();
        $kedvezmenyesar = ((100-$szorzo)/100)*$ar;

        $vanemaximum = $pricing_rule_sets['rules'][$key]['to'];
        $vaneminimum = $pricing_rule_sets['rules'][$key]['from'];
        if ( empty($vanemaximum)) {
            $valtozokarakter = ' vagy több';
        } else {
            $valtozokarakter = ' - ';
        }

        //".$pricing_rule_sets['rules'][$key]['to']." - maximum mennyiseg
        //".$pricing_rule_sets['rules'][$key]['from']." - minimum mennyiseg

        $tempstring .= '<li><a href="?add-to-cart=';
        $tempstring .= get_the_ID();
        $tempstring .= '&quantity=';
        $tempstring .= ''.$pricing_rule_sets['rules'][$key]['from']."";
        $tempstring .= '">';
        if ( $vanemaximum == $vaneminimum) {
            $tempstring .= ''.$pricing_rule_sets['rules'][$key]['from']."";
        } else {
            $tempstring .= ''.$pricing_rule_sets['rules'][$key]['from'].$valtozokarakter."".$pricing_rule_sets['rules'][$key]['to']."";
        }

        $tempstring .= ' vásárlása esetén: <strong><span class="amount">' . $pricing_rule_sets['rules'][$key]['amount'] . "" . $woosymbol . "</span> kedvezmény, ";        
        
        $tempstring .= ''.$kedvezmenyesar.' '.get_woocommerce_currency_symbol().'/db</strong></a>';

		$tempstring .= '</li>';

        } 

    }
    
    $tempstring .= '</ul>';
    $tempstring .= '</div>';

	echo $tempstring;

	}

}
