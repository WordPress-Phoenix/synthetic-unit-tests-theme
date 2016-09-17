<?php

if( ! class_exists('WP_REST_Controller') ){
	include_once( dirname( __FILE__ ) . '/includes/class-wp-rest-controller.php' );
}
include_once( dirname( __FILE__ ) . '/includes/sut-rest-controller.class.php' );

add_action( 'rest_api_init', function () {
	$controller = new SUT_Rest_Controller;
	$controller->register_routes();
} );