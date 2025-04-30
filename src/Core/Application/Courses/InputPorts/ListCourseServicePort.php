<?php


namespace Src\Core\Application\Courses\InputPorts;

use Src\Core\Domain\Courses\Entities\CourseEntity;


interface ListCourseServicePort {
    /**
     * Lista todos os cursos
     *
     * @return CourseEntity[]
     */
    public function listCourses(): array;
}

?>