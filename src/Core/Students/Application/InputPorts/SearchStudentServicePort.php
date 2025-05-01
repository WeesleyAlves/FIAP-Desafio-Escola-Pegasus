<?php
namespace Src\Core\Students\Application\InputPorts;

use Src\Core\Students\Domain\Entities\StudentEntity;


interface SearchStudentServicePort {
    /**
     * Busca estudantes por nome
     *
     * @param string $name
     * @return StudentEntity[]
     */
    public function byName( string $name ): array;   
}
?>