<?php

namespace Src\Core\Application\Students\Services;

use Src\Core\Domain\Students\Entities\StudentEntity;
use Src\Core\Domain\Students\Ports\StudentsOutputPort;


class ListStudentsService{
    public function __construct( private readonly StudentsOutputPort $studentRepository ){}

    /**
     * Executa o comportamento do serviço
     *
     * @return StudentEntity[]
     */
    public function execute(): array{
        return $this->studentRepository->getAll();
    }
} 

?>