<?php
namespace Src\Adapters\Driven\Database\Repository;

use Src\Core\Domain\Students\Entities\StudentEntity;
use Src\Core\Domain\Students\OutputPorts\StudentsRepositoryPort;



class StudentsMemRepository implements StudentsRepositoryPort{
    private array $students = [
        ['id' => 1, 'name' => 'Mary Doe', 'email' => 'mary@doe.com.br', 'address' => 'Rua X, nº Y Bairro Z'],
        ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@smith.com.br', 'address' => 'Rua A, nº C Bairro E'],
        ['id' => 3, 'name' => 'Sam Brown', 'email' => 'sam@brown.com.br', 'address' => 'Rua B, nº D Bairro F'],
    ];

    /**
     * Recupera todos os estudantes do banco.
     *
     * @return StudentEntity[]
     */
    public function getAll(): array {
        $studentsArray = [];

        foreach ( $this->students as $key => $studentData) {
            $studentsArray[] = StudentEntity::fromArray( $studentData );
        }

        return $studentsArray;
    }

    /**
     * Busca estudantes por nome
     *
     * @param string $name
     * @return StudentEntity[]
     */
    public function searchByName(string $name): array {
        $foundStudents = [];

        foreach ( $this->students as $key => $studentData ) {
            if( stripos($studentData['name'], $name) ){
                $foundStudents[] = StudentEntity::fromArray( $studentData );
            }
        }

        return $foundStudents;
    }

    /**
     * Busca estudantes por ID
     *
     * @param string $name
     * @return ?StudentEntity
     */
    public function searchByID(int $id): ?StudentEntity {

        foreach ($this->students as $studentData) {
            if ($studentData['id'] === $id) {
                return StudentEntity::fromArray( $studentData );
            }
        }
        
        return null;
    }
}

?>