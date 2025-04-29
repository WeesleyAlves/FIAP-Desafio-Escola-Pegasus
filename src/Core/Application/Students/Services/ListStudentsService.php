<?php

namespace Src\Core\Application\Students\Services;

use Src\Core\Domain\Students\Entities\StudentEntity;
use Src\Core\Domain\Students\OutputPorts\StudentsRepositoryPort;
use Src\Core\Application\Students\InputPorts\ListStudentsServicePort;


class ListStudentsService implements ListStudentsServicePort{
    public function __construct( private readonly StudentsRepositoryPort $studentRepository ){}

    /**
     * Executa o comportamento do serviço
     *
     * @return StudentEntity[]
     */
    public function listStudents(): array{
        return $this->studentRepository->getAll();
    }
} 

?>