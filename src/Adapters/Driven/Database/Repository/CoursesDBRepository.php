<?php

namespace Src\Adapters\Driven\Database\Repository;

use PDO;
use Src\Core\Domain\Courses\Entities\CourseEntity;
use Src\Core\Domain\Courses\OutputPorts\CourseRepositoryPort;


class CoursesDBRepository implements CourseRepositoryPort{
    protected $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }
    
    public function getAll(): array{
        $data = $this->pdo->query("SELECT * FROM courses ORDER BY courses.name");

        $courses = [];

        foreach ($data as $key => $course) {
            $courses[] = CourseEntity::fromArray( $course );
        }

        return $courses;
    }
}

?>