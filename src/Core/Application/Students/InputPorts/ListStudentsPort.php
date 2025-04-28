<?php

namespace Src\Core\Application\Students\InputPorts;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Application\Students\Services\ListStudentsService;
use Src\Core\Application\Students\Services\SearchStudentsService;


interface ListStudentsPort{
    /**
     * Lista todos os estudantes
     *
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return StudentEntity[]
     */
    public function listStudents(): array;
}

?>