<?php
require 'vendor/autoload.php';

// Configure ORM connection
ORM::configure(array(
    'connection_string' => 'mysql:host=localhost;dbname=blog',
    'username' => 'root',
    'password' => 'root'
));

// Custom exceptions
class ResourceNotFoundException extends Exception {};
class MissingArgumentsException extends Exception {};


$app = new \Slim\Slim();

/**
 * GET request to retrive all blog
 *
 * 200 on success
 * 500 on other failure
 */
$app->get('/blogs/', function () use ($app) {
	try {
		$blogs = ORM::for_table('blogs')->find_array();
		$app->response()->header('Content-Type', 'application/json');
		echo json_encode($blogs);
	} catch (Exception $e) {
		$app->response()->status(500);
    	$app->response()->header('X-Status-Reason', $e->getMessage());
	}	
});

/**
 * GET request to retrive a blog
 *
 * 200 on success
 * 404 on resource not found
 * 500 on other failure
 */
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

/**
 * POST request to insert a blog
 *
 * Requires "title" and "content" inputs. 
 * Blog datetime_submitted will be set to current datetime
 *
 * 201 on success
 * 400 on missing arguments
 * 500 on other failure
 */
$app->post('/blogs/', function () use ($app) {    
    try {
	    $request = $app->request();
	    $body = $request->getBody();
	    $input = json_decode($body); 
	    
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

/**
 * PUT request to update a blog
 *
 * Requires "title", "content" and "datetime_submitted" inputs. 
 *
 * 200 on success
 * 400 on missing arguments
 * 404 on resource not found
 * 500 on other failure
 */
$app->put('/blogs/:id/', function ($id) use ($app) {      
    try {
    	$blog = ORM::for_table('blogs')->find_one($id);

    	if ($blog) {
		    $request = $app->request();
		    $body = $request->getBody();
		    $input = json_decode($body); 

		    if (isset($input->title) AND isset($input->content) AND isset($input->datetime_submitted)) {
		    	$blog->set(array(
					'title'              => $input->title,
					'content'            => $input->content,
					'datetime_submitted' => $input->datetime_submitted
				));
				$blog->save();
		    } else {
		    	throw new MissingArgumentsException();
		    }

			$app->response()->header('Content-Type', 'application/json');
	    	echo json_encode($blog->as_array());
    	} else {
    		throw new ResourceNotFoundException();
    	}
	} catch (ResourceNotFoundException $e) {
		$app->response()->status(404);
	} catch (MissingArgumentsException $e) {
		$app->response()->status(400);
	} catch (Exception $e) {
	    $app->response()->status(500);
	    $app->response()->header('X-Status-Reason', $e->getMessage());
	}
});

/**
 * DELETE request to delete a blog
 *
 * 204 on success
 * 404 on resource not found
 * 500 on other failure
 */
$app->delete('/blogs/:id', function ($id) use ($app) {    
  	try {
	    $blog = ORM::for_table('blogs')->find_one($id);
	    
	    if ($blog) {
	      	$blog->delete();
	      	$app->response()->status(204);
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

$app->run();
