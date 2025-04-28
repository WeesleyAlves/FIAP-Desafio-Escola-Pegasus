<?php

namespace Src\Core\Application\Students\Services;

use Src\Core\Domain\Students\Entities\StudentEntity;
use Src\Core\Domain\Students\OutputPorts\StudentsOutputPort;
use Src\Core\Application\Students\InputPorts\ListStudentsPort;


class ListStudentsService implements ListStudentsPort{
    public function __construct( private readonly StudentsOutputPort $studentRepository ){}

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