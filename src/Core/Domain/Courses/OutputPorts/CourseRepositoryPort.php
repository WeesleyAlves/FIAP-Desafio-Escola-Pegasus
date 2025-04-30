<?php

namespace Src\Core\Domain\Courses\OutputPorts;

use Src\Core\Domain\Courses\Entities\CourseEntity;


interface CourseRepositoryPort{
    /**
     * Recupera todos os cursos
     *
     * @return CourseEntity[]
     */
    public function getAll(): array;
}

?>