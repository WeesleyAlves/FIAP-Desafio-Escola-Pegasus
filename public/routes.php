<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Adapters\Driver\API\Students\CreateStudentAdapter;
use Src\Core\Students\Application\Services\CreateStudentService;



$app->get('/', function (Request $request, Response $response, $args) {
    return $response->withJson(['mensagem' => 'Tudo funcionando!'])
        ->withStatus(200)
        ->withHeader('Content-Type', 'application/json');
});

$app->post('/students/create', CreateStudentAdapter::class . ':execute' );


?>