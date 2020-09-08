<?php 

	class Middleware {	
		public function __construct() {

        }

        public function __invoke($request, $response, $next) {
        	if ($request->hasHeader("Authorization")) {
        		// Validar si el token sigue siendo valido
        		
        	}

			$response->getBody()->write("ANTES DEL ENDPOINT");

			$response = $next($request, $response);

			return $response->withStatus(401);
        }
	}