<?php

header('Content-Type:text/plain');
echo '{ "tests": ['.PHP_EOL;

// generic test from the internet
sut_rest_test( 'http://echo.jsontest.com/key/value/wp_rest_cache/test_1?update_value=group_a', 'simple test');

// test using internal REST service for more advanced use cases
sut_rest_test( get_home_url() . '/wp-json/sut/v1/echo/1', 'simple test');

// build test 2 with cacheable value
sut_rest_test( get_home_url() . '/wp-json/sut/v1/echo/2', 'header value should be fresh in this call', ['value'=>'2']);

// this test will print a 2 until cache expires the first time, then it will print 3 for header value
sut_rest_test( get_home_url() . '/wp-json/sut/v1/echo/2', 'header value should be fresh in this call', ['value'=>'3']);

echo '{"end of tests":"0"}';
echo "]}".PHP_EOL;

function sut_rest_test( $url, $notes, $headers = [] ){

	$response = wp_remote_get( $url, array ( 'headers' => $headers ) );

	$data['request'] = $url;
	$data['notes'] = $notes;
	$data = array_merge( $data, json_decode( $response['body'], true ) );
	echo print_r( json_encode($data), true ) . ',';
}


