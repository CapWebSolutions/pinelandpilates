jQuery(document).on( 'click', '.pineland-woocommerce-notice .notice-dismiss', function() {

	jQuery.ajax({
	    url: ajaxurl,
	    data: {
	        action: 'genesis_sample_dismiss_woocommerce_notice'
	    }
	});

});
