<?php

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require_once "vendor/autoload.php";

	$config = ["settings" => [
	    "addContentLengthHeader" => false,
	    "displayErrorDetails" => true,
	    "determineRouteBeforeAppMiddleware" => true
	]];
    
	$app = new \Slim\App($config);

	require_once "src/routes/routes.php";

	$app->get("/", function (Request $request, Response $response, array $args) {
	    $response->getBody()->write("API is running");

	    return $response;
	});

	$app->run();
	