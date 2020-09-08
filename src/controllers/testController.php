<?php 

	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

    require_once "src/middlewares/middleware.php";

    $app->group("/TestController", function() use ($app) {
		$app->get("/GetName/{name}", function (Request $request, Response $response, $args = []) {
			return $args["name"];
		});    	
    })->add(new Middleware);

    $app->get("/mensaje", function (Request $request, Response $response) {
    	echo "Test";
    });

    $app->get("/mensajeParametro/{mensaje}", function (Request $request, Response $response) {
    	$mensaje = $request->getAttribute("mensaje");

    	echo $mensaje;
    });

    $app->get("/mensajeParametroOpcional[/{mensaje}]", function (Request $request, Response $response) {
   		$mensaje = $request->getAttribute("mensaje");

   		if (!$mensaje) {
   			$mensaje = "El parametro mensaje no fue enviado al metodo";
   		}

    	echo $mensaje;
    });