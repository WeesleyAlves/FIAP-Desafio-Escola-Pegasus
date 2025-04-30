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

    /**
     * Lista todos os cursos
     *
     * @return CourseEntity[]
     */
    public function getAll(): array{
        $data = $this->pdo->query("SELECT * FROM courses ORDER BY courses.name");

        $courses = [];

        foreach ($data as $key => $course) {
            $courses[] = CourseEntity::fromArray( $course );
        }

        return $courses;
    }

    /**
     * Busca cursos por nome
     *
     * @return CourseEntity[]
     */
    public function getByName(string $name): array{
        $stmt = $this->pdo->prepare("SELECT * FROM courses WHERE courses.name LIKE ? ORDER BY courses.name");

        $stmt->execute([ '%'.$name.'%' ]);

        $data = $stmt->fetchAll();

        $courses = [];

        foreach ($data as $key => $course) {
            $courses[] = CourseEntity::fromArray( $course );
        }

        return $courses;
    }

    /**
     * Busca um curso por id
     *
     * @return ?CourseEntity
     */
    public function getByID(int $id): ?CourseEntity {
        $stmt = $this->pdo->prepare("SELECT * FROM courses WHERE courses.id = ?");

        $stmt->execute([ $id ]);

        $course = $stmt->fetch();

        if( $course ){
            return CourseEntity::fromArray( $course );
        }
        
        return null;
    }
}

?>