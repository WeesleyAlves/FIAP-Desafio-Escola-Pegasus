<?php


namespace Src\Core\Application\Courses\Services;

use Src\Core\Domain\Courses\OutputPorts\CourseRepositoryPort;
use Src\Core\Application\Courses\InputPorts\ListCourseServicePort;


class ListCoursesService implements ListCourseServicePort {
    public function __construct( private readonly CourseRepositoryPort $courseRepository ) {}

    /**
     * Lista todos os cursos
     *
     * @return CourseEntity[]
     */
    public function listCourses(): array {
        return $this->courseRepository->getAll();
    }
}

?>