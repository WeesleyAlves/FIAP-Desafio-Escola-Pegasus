<?php

use Src\Adapters\Driver\API;
use Src\Adapters\Driver\API\StudentAdapter;
use Src\Adapters\Driver\API\CourseAdapter;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write( 'Olá' );
    return $response;
});

$app->get('/students', function (Request $request, Response $response, $args) {
    return $this->get(StudentAdapter::class)->listStudents( $request, $response, $args );
});

$app->get('/students/{id}', function (Request $request, Response $response, $args) {
    return $this->get(StudentAdapter::class)->searchByID( $request, $response, $args );
});

$app->get('/students/search/{name}', function (Request $request, Response $response, $args) {
    return $this->get(StudentAdapter::class)->searchByName( $request, $response, $args );
});

$app->get('/courses', function (Request $request, Response $response, $args) {
    return $this->get(CourseAdapter::class)->listCourses( $request, $response, $args );
});

$app->get('/courses/search/{name}', function (Request $request, Response $response, $args) {
    return $this->get(CourseAdapter::class)->searchByName( $request, $response, $args );
});

$app->get('/courses/{id}', function (Request $request, Response $response, $args) {
    return $this->get(CourseAdapter::class)->searchByID( $request, $response, $args );
});


?>