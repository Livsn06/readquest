<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../databases/config/Database.php';
require_once __DIR__ . '/../services/JWTService.php';
require_once __DIR__ . '/../utils/get_token_structure.php';

class PersonalAccessTokenController
{
    private static PDO $pdo;
    public static function init()
    {
        $database = new Database();
        self::$pdo = $database->getConnection();
    }

    public static function createToken(array $data): string
    {
        self::init();

        $tokenable_id = $data['tokenable_id'];
        $tokenable_type = $data['tokenable_type'];
        $name = $data['token_name'];
        $abilities = $data['abilities'];
        $tokenExpirationDateTime =  $data['token_expiration_date_time'];
        $totalEndTime = DateTime::createFromFormat('Y-m-d H:i:s', $tokenExpirationDateTime)->getTimestamp();
        $token = JWTService::generateToken($tokenable_id, $totalEndTime);
        $bearerToken = getTokenStructure($token);

        $query = "INSERT 
                    INTO personal_access_tokens 
                    (tokenable_id, 
                    token, 
                    tokenable_type, 
                    name, 
                    abilities, 
                    expires_at)
                    VALUES (:tokenable_id, 
                    :token, 
                    :tokenable_type, 
                    :name, 
                    :abilities, 
                    :expires_at)";

        $stmt = self::$pdo->prepare($query);

        $stmt->bindParam(':tokenable_id', $tokenable_id);
        $stmt->bindParam(':token', $bearerToken);
        $stmt->bindParam(':tokenable_type', $tokenable_type);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':abilities', $abilities);
        $stmt->bindParam(':expires_at', $tokenExpirationDateTime);
        $stmt->execute();
        return $token;
    }


    public static function revokeToken(string $token): void
    {

        self::init();
        $query = "DELETE FROM personal_access_tokens WHERE token = :token";
        $stmt = self::$pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
    }

    public static function getTokenableIDByToken(string $token): string | bool
    {
        self::init();
        $query = "SELECT tokenable_id FROM personal_access_tokens WHERE token = :token";

        $stmt = self::$pdo->prepare($query);

        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false ? $result['tokenable_id'] : false;
    }


    public static function isExistingToken(string $token): bool
    {
        self::init();
        $query = "SELECT * FROM personal_access_tokens WHERE token = :token";
        $stmt = self::$pdo->prepare($query);
        $stmt->bindParam(':token', $token);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result !== false;
    }
}
