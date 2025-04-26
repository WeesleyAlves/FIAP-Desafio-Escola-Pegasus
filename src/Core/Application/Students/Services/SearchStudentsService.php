<?php

namespace Src\Core\Application\Students\Services;

use Src\Core\Domain\Students\Ports\StudentsOutputPort;

class SearchStudentsService{
    public function __construct( private readonly StudentsOutputPort $studentRepository ){}

    public function searchByName( string $name ): array {
        return $this->studentRepository->searchByName( $name );
    }

    public function searchByID( int $id ): array {
        return $this->studentRepository->searchByID( $id );
    }
}

?>