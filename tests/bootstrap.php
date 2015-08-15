<?php
// Settings to make all errors more obvious during testing
error_reporting(-1);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
date_default_timezone_set('UTC');

use There4\Slim\Test\WebTestCase;
use There4\Slim\Test\NoCacheRouter;

define('PROJECT_ROOT', realpath(__DIR__ . '/..'));
require_once PROJECT_ROOT . '/vendor/autoload.php';

require_once PROJECT_ROOT . '/config.php';

// Initialize our own copy of the slim application
class LocalWebTestCase extends WebTestCase {
	public function getSlimInstance() {
		$app = new \Slim\Slim(array(
			'version'        => '0.0.0',
			'debug'          => false,
			'mode'           => 'testing'
		));

		$app->setName('default');

		$app->router = new NoCacheRouter($app->router);

		// Configure database connection for testing
		ORM::configure(array(
		    'connection_string' => 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME,
		    'username' => DB_USER,
		    'password' => DB_PASSWORD
		));

		// Include our core application file
		require_once PROJECT_ROOT . '/app/app.php';
		
		return $app;
    }
};
