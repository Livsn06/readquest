<?php

require_once __DIR__ . '/../services/JWTService.php';
require_once __DIR__ . '/../controllers/PersonalAccessTokenController.php';

class AuthMiddleware
{
    public static function handle()
    {
        header('Content-Type: application/json');
        $headers = getallheaders();

        if (!isset($headers['Authorization']) || !preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized. Token missing.']);
            exit;
        }


        $decoded = JWTService::validateToken($matches[1]);

        if (!$decoded) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized. Token invalid or expired.']);
            $bearerToken = $headers['Authorization'];
            PersonalAccessTokenController::revokeToken($bearerToken);
            exit;
        }

        $bearerToken = $headers['Authorization'];
        $isExistingToken = PersonalAccessTokenController::isExistingToken($bearerToken);
        if (!$isExistingToken) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized. Token invalid or expired.']);
            exit;
        }



        // Optionally store user info globally
        $GLOBALS['auth_user_id'] = $decoded->uid;
    }
}
