<?php

// Extending WooCommerce

if(class_exists('WooCommerce')) {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
	add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 15 );
	remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

	add_filter( 'woocommerce_breadcrumb_defaults', 'stag_woocommerce_breadcrumbs' );
	function stag_woocommerce_breadcrumbs() {
	    return array(
	            'delimiter'   => ' <i class="fa fa-angle-right"></i> ',
	            'wrap_before' => '<nav class="dt-breadcrumbs" itemprop="breadcrumb">',
	            'wrap_after'  => '</nav>',
	            'before'      => '',
	            'after'       => '',
	            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
	        );
	}

	function stag_products_per_page($cols) {
		global $stag_redux_data;
		$stag_pperpage = 9;
		if(isset($stag_redux_data['stag_woo_products_per_page'])) {
			$stag_pperpage = $stag_redux_data['stag_woo_products_per_page'];
		}
		return $stag_pperpage;
	}

		add_filter( 'loop_shop_per_page', 'stag_products_per_page', 20 );


	add_filter( 'woocommerce_product_description_heading', 'stag_remove_product_description_heading' );
	function stag_remove_product_description_heading() {
	return '';
	}		

}



?>