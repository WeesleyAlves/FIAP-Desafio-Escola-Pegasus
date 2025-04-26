<?php

namespace Src\Core\Application\Students\Ports;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Application\Students\Services\ListStudentsService;
use Src\Core\Application\Students\Services\SearchStudentsService;


interface StudentsInput{
    public function listStudents( Request $request, Response $response, array $args=[] ): Response;
    public function searchByID( Request $request, Response $response, array $args=[] ): Response;
    public function searchByName( Request $request, Response $response, array $args=[] ): Response;
}

?>