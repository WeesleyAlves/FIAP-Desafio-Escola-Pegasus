<?php

namespace Src\Core\Application\Students\Services;

use Src\Core\Domain\Students\Ports\StudentsOutputPort;


class ListStudentsService{
    public function __construct( private readonly StudentsOutputPort $studentRepository ){}

    public function execute(): array{
        return $this->studentRepository->listAll();
    }
} 

?>