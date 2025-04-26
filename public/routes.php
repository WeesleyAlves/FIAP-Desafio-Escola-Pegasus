<?php

use Src\Adapters\Driver\API;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use Src\Core\Application\Students\Ports\StudentsInput;


$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write( 'Olá' );
    return $response;
});

$app->get('/students', function (Request $request, Response $response, $args) {
    return $this->get(StudentsInput::class)->listStudents( $request, $response, $args );
});

$app->get('/students/{id}', function (Request $request, Response $response, $args) {
    return $this->get(StudentsInput::class)->searchByID( $request, $response, $args );
});

$app->get('/students/search/{name}', function (Request $request, Response $response, $args) {
    return $this->get(StudentsInput::class)->searchByName( $request, $response, $args );
});

?>