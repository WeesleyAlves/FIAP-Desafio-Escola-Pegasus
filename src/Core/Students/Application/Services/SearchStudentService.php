<?php
namespace Src\Core\Students\Application\Services;

use Src\Core\Students\Domain\OutputPorts\StudentsRepositoryPort;
use Src\Core\Students\Application\InputPorts\SearchStudentServicePort;

class SearchStudentService implements SearchStudentServicePort{
    public function __construct( private readonly StudentsRepositoryPort $studentsRepository){}

    /**
     * Busca estudantes por nome
     *
     * @param string $name
     * @return StudentEntity[]
     */
    public function byName( string $name ): array {
        return $this->studentsRepository->searchStudentsByName( $name );
    }
}
?>