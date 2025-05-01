<?php

use Psr\Http\Message\ResponseInterface as Response;
use Src\Adapters\Driver\API\Students\StudentAdapter;

use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Adapters\Driver\API\Students\CreateStudentAdapter;
use Src\Adapters\Driver\API\Students\SearchStudentAdapter;



$app->get('/', function (Request $request, Response $response, $args) {
    return $response->withJson(['mensagem' => 'Tudo funcionando!'])
        ->withStatus(200)
        ->withHeader('Content-Type', 'application/json');
});

$app->get('/students/search[/{name}]', StudentAdapter::class . ':searchStudentsByName' );
$app->post('/students/create', StudentAdapter::class . ':createStudent' );
$app->delete('/students/delete', StudentAdapter::class . ':deleteStudent' );


?>