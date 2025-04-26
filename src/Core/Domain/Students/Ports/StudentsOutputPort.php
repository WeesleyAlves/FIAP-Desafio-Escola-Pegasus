<?php
namespace Src\Core\Domain\Students\Ports;

use Src\Core\Domain\Students\Entities\StudentEntity;

interface StudentsOutputPort{
    /**
     * Lista todos os studantes
     *
     * @return StudentEntity[]
     */
    public function getAll(): array;

    /**
     * Busca um estudante por nome
     * @param string $name
     * @return StudentEntity[]
     */
    public function searchByName(string $name): array;

    /**
     * Busca um estudante por ID
     * @param int $id
     * @return ?StudentEntity
     */
    public function searchByID(int $id): ?StudentEntity;
}

?>