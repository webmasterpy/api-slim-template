<?php 

    require_once ROOT_PATH . "helpers/customMessages.php";

    use \Firebase\JWT\JWT;

    class Helpers extends CustomMessages {

        public function __construct() {

        }
        
        public function sendMail($data) {
            $to = $data["To"];
            $from = MAILER;
            $subject = $data["Subject"];
            $body = $data["Body"]; // This should be a constant with the template 
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            $headers .= "From:$from\r\n";
            // $headers .= "Reply-To: othermail@gmail.com"; // This is optional
            $response = "";

            $mailSuccess = mail($to, $subject, $body, $headers);

            if ($mailSuccess) {
                $response = $this->mailSendedSuccessfully();
            } else {
                $response = $this->customResponse(500, "Something went wrong");
            }

            return $response;
        }

        public function getRequestHeaders() {
            $headers = null;
    
            if (function_exists("apache_request_headers")) {
                $requestHeaders = apache_request_headers();

                $requestHeaders = array_combine(array_map("ucwords", array_keys($requestHeaders)), array_values($requestHeaders));

                if (isset($requestHeaders["Authorization"])) {
                    $headers = trim($requestHeaders["Authorization"]);
                }
            }

            return $headers;
        }

        public function getBearerToken() {
            $headers = $this->getRequestHeaders();

            if (!empty($headers)) {
                if (preg_match('/Bearer\s(\S+)/', $headers, $matches)) {
                    return $matches[1];
                }
            } else {
                return null;
            }
        }

        public function getCurrentUserId() {
            $token = $this->getBearerToken();

            if ($token != null) {
                $currentUserId = $this->decodeAccessToken($token);   

                if ($currentUserId != "expired_token") {
                    $currentUserId = $currentUserId->{"userId"};
                } else {
                    $this->accessDenied();
                }
            } else {
                $this->accessDenied();
            }

            return $currentUserId;         
        }

        public function generateAccessToken($data) {
            $tokenDuration = (60 * 60) * 24;

            $payload = array(
                "iat" => time(),
                "iss" => "localhost",
                "exp" => time() + $tokenDuration,
                "userId" => 1//$data["UserId"]
            );

            $jwtToken = JWT::encode($payload, SECRET_KEY);

            return $jwtToken;
        }

        public function decodeAccessToken($token) {
            try {
                $decoded = JWT::decode($token, SECRET_KEY, array('HS256'));

                return $decoded;
            } catch(\Firebase\JWT\ExpiredException $e){
                return "expired_token";
            }   
        }

        public function allowAccess() {
            $token = $this->getBearerToken();
            $tokenDecoded = null;
            $response = null;

            if ($token != null) {
                $tokenDecoded = $this->decodeAccessToken($token);

                if ($tokenDecoded != "expired_token") {
                    $response = $this->accessGranted();
                } else {
                    $response = $this->accessDenied();
                }
            } else {
                $response = $this->accessDenied();
            }

            $response = json_decode($response, true);

            return $response;
        }

        public function retrieveArrayProperties($data) { // $data receive an FETCH_ASSOC
            $arrayProperties = [];

            foreach ($data as $key => $value) {
                foreach ($value as $k => $val) {
                    $arrayProperties[$k] = $val;
                }
            }

            return $arrayProperties;
        }

        public function generateLog($log) {
            file_put_contents("logs/log_" . date("j.n.Y") . ".txt", $log, FILE_APPEND);
        }

    }
