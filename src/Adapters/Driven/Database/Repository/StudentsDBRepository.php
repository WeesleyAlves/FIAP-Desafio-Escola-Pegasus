<?php 


namespace Src\Adapters\Driven\Database\Repository;

use PDO;

use Src\Core\Domain\Students\Entities\StudentEntity;
use Src\Core\Domain\Students\OutputPorts\StudentsRepositoryPort;


class StudentsDBRepository implements StudentsRepositoryPort {
    protected $pdo;

    public function __construct( PDO $pdo ) {
        $this->pdo = $pdo;
    }

    /**
     * Lista todos os studantes
     *
     * @return StudentEntity[]
     */
    public function getAll(): array {
        $data = $this->pdo->query("SELECT * FROM students ORDER BY students.name");

        $students = [];

        foreach ($data as $key => $student) {
            $students[] = StudentEntity::fromArray( $student );
        }

        return $students;
    }

    /**
     * Busca um estudante por nome
     * @param string $name
     * @return StudentEntity[]
     */
    public function searchByName(string $name): array {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE students.name LIKE ?");

        $stmt->execute([ '%'.$name.'%' ]);

        $data = $stmt->fetchAll();

        $students = [];

        foreach ($data as $key => $student) {
            $students[] = StudentEntity::fromArray( $student );
        }

        return $students;
    }

    /**
     * Busca um estudante por ID
     * @param int $id
     * @return ?StudentEntity
     */
    public function searchByID(int $id): ?StudentEntity {
        $stmt = $this->pdo->prepare("SELECT * FROM students WHERE students.id = ?");

        $stmt->execute([ $id ]);

        $student = $stmt->fetch();

        if( $student ){
            return StudentEntity::fromArray( $student );
        }
        
        return null;
    }
}

?>