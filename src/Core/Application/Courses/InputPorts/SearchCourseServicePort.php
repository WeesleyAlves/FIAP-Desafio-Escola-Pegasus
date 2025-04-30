<?php

namespace Src\Core\Application\Courses\InputPorts;

use Src\Core\Domain\Courses\Entities\CourseEntity;


interface SearchCourseServicePort{
    /**
     * Busca os cursos por Id
     *
     * @return ?CourseEntity
     */
    public function searchByID(int $id): ?CourseEntity;

    /**
     * Busca os cursos por nome
     *
     * @return CourseEntity[]
     */
    public function searchByName(string $name): array;
}
?>