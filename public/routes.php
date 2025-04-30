<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Students\Application\Services\CreateStudentService;



$app->get('/', function (Request $request, Response $response, $args) {
    return $response->withJson(['mensagem' => 'Tudo funcionando!'])
        ->withStatus(200)
        ->withHeader('Content-Type', 'application/json');
});

$app->post('/students/new', function (Request $request, Response $response, $args) {
    $body = $request->getParsedBody();

    return $response->withJson(['mensagem' => 'Rota de estudantes POST'])
        ->withStatus(200)
        ->withHeader('Content-Type', 'application/json');
});


?>