<?php
namespace Src\Core\Students\Application\Services;

use Src\Core\Students\Domain\Entities\ContactEntity;
use Src\Core\Students\Domain\Entities\StudentEntity;
use Src\Core\Students\Application\DTOs\UpdateStudentDTO;
use Src\Core\Students\Domain\OutputPorts\StudentsRepositoryPort;
use Src\Core\Students\Application\InputPorts\UpdateStudentServicePort;


class UpdateStudentService implements UpdateStudentServicePort{
    public function __construct( private readonly StudentsRepositoryPort $studentsRepository){}

    /**
     * Executa edição de um estudante;
     *
     * @return ?StudentEntity
     */
    public function execute( UpdateStudentDTO $dto ): ?StudentEntity {

        $student = StudentEntity::create( 
            $dto->getName(),
            $dto->getRegistryAcademic(),
        );

        $contact = ContactEntity::create( 
            $dto->getRegistryAcademic(),
            $dto->getPhone(),
            $dto->getEmail()
        );

        $student->setContact( $contact );

        return $this->studentsRepository->updateStudent( $student );
    }
}
?>