<?php
require 'vendor/autoload.php';

// Configure DB
ORM::configure(array(
    'connection_string' => 'mysql:host=localhost;dbname=blog',
    'username' => 'root',
    'password' => 'root'
));

// Custom exceptions
class ResourceNotFoundException extends Exception {};
class MissingArgumentsException extends Exception {};


$app = new \Slim\Slim();

// GET all blogs
$app->get('/blogs/', function () use ($app) {
	$blogs = ORM::for_table('blogs')->find_array();
	$app->response()->header('Content-Type', 'application/json');
	echo json_encode($blogs);
});

// GET blog by ID
$app->get('/blogs/:id/', function ($id) use ($app) {
	try {
		$blog = ORM::for_table('blogs')->find_one($id);

		if ($blog) {
			$app->response()->header('Content-Type', 'application/json');
    		echo json_encode($blog->as_array());
		} else {
			throw new ResourceNotFoundException();
		}	
    } catch (ResourceNotFoundException $e) {
    	$app->response()->status(404);
    } catch (Exception $e) {
    	$app->response()->status(500);
    	$app->response()->header('X-Status-Reason', $e->getMessage());
    }
	
});

// POST request to insert blog
$app->post('/blogs/', function () use ($app) {    
    try {
	    // Get and decode JSON request body
	    $request = $app->request();
	    $body = $request->getBody();
	    $input = json_decode($body); 
	    
	    // If title and content provided, then save to DB
	    if (isset($input->title) AND isset($input->content)) {
	    	$newBlog = ORM::for_table('blogs')->create();
	    	$newBlog->set(array(
				'title'              => $input->title,
				'content'            => $input->content,
				'datetime_submitted' => date('Y/m/d H:i:s')
			));
			$newBlog->save();

			$app->response()->status(201);
			$app->response()->header('Content-Type', 'application/json');
	    	echo json_encode($newBlog->as_array());
	    } else {
	    	throw new MissingArgumentsException();
	    }
	} catch (MissingArgumentsException $e) {
		$app->response()->status(400);
	} catch (Exception $e) {
	    $app->response()->status(500);
	    $app->response()->header('X-Status-Reason', $e->getMessage());
	}
});

$app->run();
