<?php

namespace Src\Core\Application\Students\InputPorts;

use Psr\Http\Message\ResponseInterface as Response;
use Src\Core\Domain\Students\Entities\StudentEntity;
use Psr\Http\Message\ServerRequestInterface as Request;
use Src\Core\Application\Students\Services\ListStudentsService;
use Src\Core\Application\Students\Services\SearchStudentsService;


interface SearchStudentsPort{
    /**
     * Busca estudantes por nome
     *
     * @param string $name
     * @return StudentEntity[]
     */
    public function searchByName( string $name ): array;

    /**
     * Busca estudantes por id
     *
     * @param int $id
     * @return ?StudentEntity
     */
    public function searchByID( int $id ): ?StudentEntity;
}

?>