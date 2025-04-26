<?php

namespace Src\Adapters\Driver\API;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


use Src\Core\Application\Students\Ports\StudentsInput;


class StudentsTestAdapter implements StudentsInput{
    public function listStudents( Request $request, Response $response, array $args=[] ): Response {
        return $response->withJson([])
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    public function searchByID( Request $request, Response $response, array $args=[] ): Response {
        return $response->withJson([])
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

    public function searchByName( Request $request, Response $response, array $args=[] ): Response {
        return $response->withJson([])
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json');
    }

}

?>