<?php     

    class CustomMessages {

        public function customResponse($code, $message) {
            return json_encode(array(
                "Code" => $code,
                "Message" => $message
            ));
        }

        public function mailSendedSuccessfully() {
            return json_encode(array(
                "Code" => 200,
                "Message" => "Email sended successfully"
            ));
        }

        public function accessGranted() {
            return json_encode(array(
                "Code" => 200,
                "Message" => "Access granted"
            ));
        }

        public function accessDenied() {
            return json_encode(array(
                "Code" => 401,
                "Message" => "Access Unauthorized Error"
            ));
        }

        public function notFound() {
            return json_encode(array(
                "Code" => 404,
                "Message" => "Resource not found"
            ));   
        }

        public function internalError() {
            return json_encode(array(
                "Code" => 500,
                "Message" => "Internal Error Server"
            ));
        }

    }