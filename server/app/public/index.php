<?php

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../middlewares/AuthMiddleware.php';
require_once __DIR__ . '/../controllers/StudentAuthController.php';
require_once __DIR__ . '/../controllers/StudentController.php';
require_once __DIR__ . '/../controllers/GradeYearController.php';
require_once __DIR__ . '/../controllers/GradeSectionController.php';
require_once __DIR__ . '/../controllers/StudentEnrollmentController.php';


use Bramus\Router\Router;

$router = new Router();

$router->get('/', function () {
    echo 'API is running....';
});


$router->post('/student/login', function () {
    (new StudentAuthController())->studentLogin();
});

$router->post('/student/logout', function () {
    AuthMiddleware::handle();
    (new StudentAuthController())->studentLogout();
});

$router->get('/students', function () {
    AuthMiddleware::handle();
    (new StudentController())->fetchAllStudent();
});

$router->get('/grade-years', function () {
    AuthMiddleware::handle();
    (new GradeYearController())->fetchAllGradeYear();
});

$router->get('/grade-sections', function () {
    AuthMiddleware::handle();
    (new GradeSectionController())->fetchAllGradeSection();
});

$router->get('/student-enrollments', function () {
    AuthMiddleware::handle();
    (new StudentEnrollmentController())->fetchAllStudentEnrollment();
});

$router->run();
