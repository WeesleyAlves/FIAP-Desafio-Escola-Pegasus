<?php
namespace Src\Core\Students\Application\InputPorts;

use Src\Core\Students\Domain\Entities\StudentEntity;


interface CreateStudentServicePort{
    /**
     * Executa criação de um novo estudante;
     *
     * @return array
     */
    public function execute( string $name, string $phone, string $email, int $courseId ): StudentEntity;
}
?>