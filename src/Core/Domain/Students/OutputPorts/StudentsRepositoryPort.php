<?php
namespace Src\Core\Domain\Students\OutputPorts;

use Src\Core\Domain\Students\Entities\StudentEntity;

interface StudentsRepositoryPort{
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