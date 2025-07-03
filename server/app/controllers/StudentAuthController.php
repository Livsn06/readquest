<?php


require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../databases/config/Database.php';
require_once __DIR__ . '/../services/JWTService.php';
require_once __DIR__ . '/../controllers/PersonalAccessTokenController.php';
require_once __DIR__ . '/../utils/get_device_name.php';
require_once __DIR__ . '/../utils/get_expiration_date_extension.php';
require_once __DIR__ . '/../enums/Token.php';
require_once __DIR__ . '/../controllers/StudentController.php';

class StudentAuthController
{

    private static PDO $pdo;

    public static function init(): void
    {
        $database = new Database();
        self::$pdo = $database->getConnection();
    }

    public function studentLogin()
    {
        try {
            header('Content-Type: application/json');
            self::init();
            $data = json_decode(file_get_contents("php://input"), true);
            $id = $data['id'] ?? $_POST['id'] ?? null;
            $password = $data['password'] ?? $_POST['password'] ?? null;
            $rememberMe = $data['remember_me'] ?? $_POST['remember_me'] ?? false;
            $agentType = $_SERVER['HTTP_USER_AGENT'];



            $query = "SELECT * FROM students WHERE id = :id";
            $stmt = self::$pdo->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);



            if (!$user) {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid ID or password.']);
                exit;
            }

            if (!password_verify($password, $user['password'])) {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid email or password.']);
                exit;
            }

            if ($user['deleted_at'] !== null) {
                http_response_code(401);
                echo json_encode(['error' => 'Your account is deleted.']);
                exit;
            }


            $tokenable_id = $id;
            $token_name = getReadableDeviceName($agentType);
            $token_type = TokenType::STUDENT->value;
            $expirationDateTime =  getExpirationDateExtension($rememberMe);
            $abilities = json_encode([TokenAbility::ALL->value]);
            $data = [
                'tokenable_id' => $tokenable_id,
                'tokenable_type' => $token_type,
                'token_name' => $token_name,
                'abilities' => $abilities,
                'token_expiration_date_time' => $expirationDateTime->format('Y-m-d H:i:s'),
            ];

            $token = PersonalAccessTokenController::createToken($data);

            if ($rememberMe) {
                StudentController::rememberStudentLogin($id, $token);
            }

            http_response_code(200);
            echo json_encode([
                'token' => $token,
                'expires_in' => $expirationDateTime->getTimestamp(),
                'expires_at' => $expirationDateTime->format('Y-m-d H:i:s'),

            ]);


            exit;
        } catch (Exception $e) {

            http_response_code(500);
            echo json_encode(['error' => 'Internal server error.' . $e->getMessage()]);
            exit;
        }
    }


    public function studentLogout()
    {
        try {
            header('Content-Type: application/json');
            self::init();

            $headers = getallheaders();
            $token = $headers['Authorization'] ?? $_SERVER['HTTP_AUTHORIZATION'] ?? null;

            if (!$token) {
                http_response_code(401);
                echo json_encode(['error' => 'Token missing.']);
                exit;
            }

            if (!PersonalAccessTokenController::isExistingToken($token)) {
                http_response_code(401);
                echo json_encode(['error' => 'Token is no longer valid.']);
                exit;
            }
            $user_id = PersonalAccessTokenController::getTokenableIDByToken($token);

            if (!$user_id) {
                http_response_code(401);
                echo json_encode(['error' => 'Invalid. Empty tokenable ID.']);
                exit;
            }

            PersonalAccessTokenController::revokeToken($token);

            StudentController::forgetStudentLogin($user_id);

            http_response_code(200);
            echo json_encode(['message' => 'Logout successful.']);
            exit;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['error' => 'Internal server error.' . $e->getMessage()]);
            exit;
        }
    }
}
