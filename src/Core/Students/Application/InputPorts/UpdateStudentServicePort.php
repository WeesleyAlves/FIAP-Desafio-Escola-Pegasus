<?php
namespace Src\Core\Students\Application\InputPorts;

use Src\Core\Students\Domain\Entities\StudentEntity;
use Src\Core\Students\Application\DTOs\UpdateStudentDTO;


interface UpdateStudentServicePort {
    /**
     * Executa edição de um estudante;
     *
     * @return ?StudentEntity
     */
    public function execute( UpdateStudentDTO $dto ): ?StudentEntity;
}
?>