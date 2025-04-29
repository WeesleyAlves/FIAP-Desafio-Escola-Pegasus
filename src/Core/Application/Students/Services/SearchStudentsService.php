<?php

namespace Src\Core\Application\Students\Services;

use Src\Core\Domain\Students\Entities\StudentEntity;

use Src\Core\Domain\Students\OutputPorts\StudentsRepositoryPort;
use Src\Core\Application\Students\InputPorts\SearchStudentsServicePort;

class SearchStudentsService implements SearchStudentsServicePort{
    public function __construct( private readonly StudentsRepositoryPort $studentRepository ){}

    /**
     * Busca estudantes pelo nome;
     *
     * @param string $name
     * @return StudentEntity[]
     */
    public function searchByName( string $name ): array {
        return $this->studentRepository->searchByName( $name );
    }

    /**
     * Busca estudantes pelo ID;
     *
     * @param int $id
     * @return ?StudentEntity
     */
    public function searchByID( int $id ): ?StudentEntity {
        return $this->studentRepository->searchByID( $id );
    }
}

?>