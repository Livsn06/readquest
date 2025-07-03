<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class JWTService
{


    private static $secret = 'your_super_secret_key';
    private static $algo = 'HS256';


    public function  __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();
        self::$secret = $_ENV['JWT_SECRET'];
        self::$algo = $_ENV['JWT_ALGO'];
    }


    /**
     * Generates a JSON Web Token (JWT) for a given user ID.
     *
     * @param int|string $userId The unique identifier for the user.
     * @return string The encoded JWT.
     */

    public static function generateToken($userId, $expiresIn = null)
    {

        $payload = [
            'iat' => time(),
            'exp' => $expiresIn ?? time() + 3600, // 1 hour
            'uid' => $userId
        ];

        return JWT::encode($payload, self::$secret, self::$algo);
    }

    public static function validateToken($token)
    {
        try {
            return JWT::decode($token, new Key(self::$secret, self::$algo));
        } catch (Exception $e) {
            return null;
        }
    }
}
