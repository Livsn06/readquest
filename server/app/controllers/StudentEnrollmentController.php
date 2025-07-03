<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../databases/config/Database.php';


class StudentEnrollmentController
{
    private static PDO $pdo;

    public static function init(): void
    {
        $database = new Database();
        self::$pdo = $database->getConnection();
    }

    public static function fetchAllStudentEnrollment(): void
    {
        try {
            header('Content-Type: application/json');
            self::init();

            $sql = "
            SELECT 
                s.id, 
                s.first_name, 
                s.last_name, 
                s.email, 
                g.year_level,
                sec.section_name, 
                se.school_year, 
                se.enrollment_status, 
                se.created_at, se.updated_at, se.deleted_at
                FROM student_enrollments se JOIN students s ON s.id = se.student_id 
                JOIN grade_years g ON g.id = se.grade_year_id 
                JOIN grade_sections sec ON sec.id = se.section_id
        ";

            $stmt = self::$pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if (empty($data)) {
                http_response_code(204);
                echo json_encode(['message' => 'No data found']);
                return;
            }

            http_response_code(200);
            echo json_encode($data);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => $e->getMessage()]);
        }
    }
}
