<?php

namespace Src\Core\Application\Courses\Services;

use Src\Core\Domain\Courses\Entities\CourseEntity;
use Src\Core\Domain\Courses\OutputPorts\CourseRepositoryPort;
use Src\Core\Application\Courses\InputPorts\SearchCourseServicePort;



class SearchCoursesService implements SearchCourseServicePort{
    public function __construct( private readonly CourseRepositoryPort $courseRepository ) {}


    /**
     * Busca os cursos por Id
     *
     * @return ?CourseEntity
     */
    public function searchByID( int $id ): ?CourseEntity {
        return $this->courseRepository->getByID( $id );
    }

    /**
     * Busca os cursos por nome
     *
     * @return CourseEntity[]
     */
    public function searchByName( string $name ): array {
        return $this->courseRepository->getByName( $name );

    }
}


?>