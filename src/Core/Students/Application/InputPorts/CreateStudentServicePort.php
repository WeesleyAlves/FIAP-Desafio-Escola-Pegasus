<?php
namespace Src\Core\Students\Application\InputPorts;

use Src\Core\Students\Domain\Entities\StudentEntity;
use Src\Core\Students\Application\DTOs\CreateStudentDTO;


interface CreateStudentServicePort{
    /**
     * Executa criação de um novo estudante;
     *
     * @return array
     */
    public function execute( CreateStudentDTO $dto ): StudentEntity;
}
?>