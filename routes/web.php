<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This is a quick test api for the node feed service
| to test with Symfony (AdvancedV2)
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});


// here we are returning a mongodb Id when we create a new feed definition
// the Node service will take the source url, grab te file data and save into MongoDB
// it should then return a MongoDB id and the original feed id so that we can update the 
// feed record
/*$app->post('/api/feed', function() {
	$data = array(
		'feedId' => rand(1,9999),
		'mongodbId' => rand(1, 9999)
	);

	return json_encode($data);
});*/

$app->post('/api/feed', 'FeedController@processFeed');


// here we are returning some feed records which would be returned form a mongodb document
/*$app->post('/api/feed', function() {

	$data = array(
		'records' => array(
			array(
				'id' => rand(1,9999),
				'field_1' => "Field 1 info",
				'field_2' => "Field 2 info",
				'field_3' => "Field 3 info",
				'field_4' => "Field 4 info",
				'field_5' => "Field 5 info",
				'field_6' => "Field 6 info",
			),
			array(
				'id' => rand(1,9999),
				'field_1' => "Field 1 info",
				'field_2' => "Field 2 info",
				'field_3' => "Field 3 info",
				//'field_4' => "Field 4 info",
				'field_4' => array(
					'images' => array(
						"image_1" => "url1",
						"image_2" => "url2",
						"image_3" => "url3"
					),
				),
				'field_5' => "Field 5 info",
				'field_6' => "Field 6 info",
			),
			array(
				'id' => rand(1,9999),
				'field_1' => "Field 1 info",
				'field_2' => "Field 2 info",
				'field_3' => "Field 3 info",
				'field_4' => "Field 4 info",
				'field_5' => "Field 5 info",
				'field_6' => "Field 6 info",
			)
		)
	);

	return json_encode($data);

});*/


$app->post('/api/feed/updateRootNode/{id}', function($id) {

	// new data structure returned from updated root node
	$data = array(
		'records' => array(
			array(
				'id' => rand(1,9999),
				'field_1' => "Field 1 info",
				'field_2' => "Field 2 info",
				'field_3' => "Field 3 info",
				'field_4' => "Field 4 info",
				'field_5' => "Field 5 info",
				'field_6' => "Field 6 info",
			),
			array(
				'id' => rand(1,9999),
				'field_1' => "Field 1 info",
				'field_2' => "Field 2 info",
				'field_3' => "Field 3 info",
				//'field_4' => "Field 4 info",
				'field_4' => array(
					'images' => array(
						"image_1" => "url1",
						"image_2" => "url2",
						"image_3" => "url3"
					),
				),
				'field_5' => "Field 5 info",
				'field_6' => "Field 6 info",
			),
			array(
				'id' => rand(1,9999),
				'field_1' => "Field 1 info",
				'field_2' => "Field 2 info",
				'field_3' => "Field 3 info",
				'field_4' => "Field 4 info",
				'field_5' => "Field 5 info",
				'field_6' => "Field 6 info",
			)
		)
	);

	return json_encode($data);

});


$app->post('/api/feed/saveQuery/{id}', function($id) {

	// save the new filter definition
	return true;

});


/**
 * Image optimisation routes
 */

$app->post('/api/images/optimise', function() {

	

});