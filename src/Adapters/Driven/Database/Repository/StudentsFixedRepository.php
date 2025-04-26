<?php
namespace Src\Adapters\Driven\Database\Repository;

use Src\Core\Domain\Students\Ports\StudentsOutputPort;

class StudentsFixedRepository implements StudentsOutputPort{
    private array $students = [
        ['id' => 1, 'name' => 'Mary Doe', 'age' => 20],
        ['id' => 2, 'name' => 'Jane Smith', 'age' => 22],
        ['id' => 3, 'name' => 'Sam Brown', 'age' => 19],
    ];

    public function listAll(): array {
        return $this->students;
    }

    public function searchByName(string $name): array {
        return array_filter($this->students, function($student) use ($name) {
            return stripos($student['name'], $name) !== false;
        });
    }

    public function searchByID(int $id): array {
        foreach ($this->students as $student) {
            if ($student['id'] === $id) {
                return $student;
            }
        }
        
        return [];
    }
}

?>