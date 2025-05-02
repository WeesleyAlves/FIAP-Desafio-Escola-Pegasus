<?php
namespace Src\Core\Students\Application\Services;

use Src\Core\Students\Domain\OutputPorts\StudentsRepositoryPort;
use Src\Core\Students\Application\InputPorts\DeleteStudentServicePort;



class DeleteStudentService implements DeleteStudentServicePort {
    public function __construct( private readonly StudentsRepositoryPort $studentsRepository ) {}

    public function execute( string $registryAcademic ): bool {
        return $this->studentsRepository->deleteStudent( $registryAcademic );
    }
}
?>