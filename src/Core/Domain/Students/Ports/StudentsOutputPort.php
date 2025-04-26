<?php
namespace Src\Core\Domain\Students\Ports;

interface StudentsOutputPort{
    public function listAll(): array;
    public function searchByName(string $name): array;
    public function searchByID(int $id): array;
}

?>