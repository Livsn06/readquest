<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../databases/config/Database.php';


class StudentController
{
    private static PDO $pdo;

    public static function init(): void
    {
        $database = new Database();
        self::$pdo = $database->getConnection();
    }

    public static function fetchAllStudent(): void
    {
        try {
            header('Content-Type: application/json');

            self::init();

            //fetch al column exclude password
            $sql = "SELECT 
                id, 
                first_name, 
                last_name, 
                email, phone, 
                email_verified_at, 
                created_at, 
                updated_at, 
                deleted_at FROM students 
                ORDER BY id DESC ";

            $stmt = self::$pdo->query($sql);

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                http_response_code(204);
                echo json_encode(['message' => 'No data found']);
            }

            http_response_code(200);
            echo json_encode($data);

            //
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => $e->getMessage()], 500);
        }
    }





    // ========================================== NOT USED TO API CONTROLLER ==========================================
    public static function getStudentById(string $id): array
    {
        self::init();
        $query = "SELECT id, 
                first_name, 
                last_name, 
                email, phone, 
                email_verified_at, 
                created_at, 
                updated_at, 
                deleted_at FROM students 
                WHERE id = :id";

        $stmt = self::$pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user;
    }

    public static function rememberStudentLogin(string $id, string $token): void
    {
        self::init();
        $query = "UPDATE students SET remember_token = :remember_token WHERE id = :id";
        $stmt = self::$pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':remember_token', $token);
        $stmt->execute();
    }

    public static function forgetStudentLogin(string $id): void
    {
        self::init();
        $query = "UPDATE students SET remember_token = NULL WHERE id = :id";
        $stmt = self::$pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
