<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../databases/config/Database.php';


class GradeYearController
{
    private static PDO $pdo;

    public static function init(): void
    {
        $database = new Database();
        self::$pdo = $database->getConnection();
    }

    public static function fetchAllGradeYear(): void
    {
        try {
            header('Content-Type: application/json');

            self::init();
            $stmt = self::$pdo->query("SELECT * FROM grade_years");

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
            echo json_encode(['message' => $e->getMessage()]);
        }
    }
}
