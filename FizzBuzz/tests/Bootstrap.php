<?php

use Zend\Mvc\Application;

if (is_readable('./Definitions.php')) {
	include ('./Definitions.php');
} else {
	throw new Exception('./Definitions.php not found');
}

chdir( '..' );

include 'vendor/autoload.php';
Application::init( include 'config/application.config.php' );


