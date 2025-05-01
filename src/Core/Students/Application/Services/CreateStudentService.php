<?php
namespace Src\Core\Students\Application\Services;

use Src\Core\Students\Domain\Entities\ContactEntity;
use Src\Core\Students\Domain\Entities\StudentEntity;
use Src\Core\Students\Application\DTOs\CreateStudentDTO;
use Src\Core\Students\Domain\Entities\AcademicHistoryEntity;
use Src\Core\Students\Domain\ValueObjects\AcademicRegistryOV;
use Src\Core\Students\Application\InputPorts\CreateStudentServicePort;
use Src\Core\Students\Domain\OutputPorts\StudentsRepositoryPort;



class CreateStudentService implements CreateStudentServicePort{
    public function __construct( private readonly StudentsRepositoryPort $studentRepository ) {}

    /**
     * Executa a criação e armazenamento de um estudante e suas devidas dependencias ao banco de dados;
     *
     * @param CreateStudentDTO $dto
     * @return StudentEntity
     */
    public function execute( CreateStudentDTO $dto ): StudentEntity{        
        // TODO: adicionar conexão com o banco pra criar as coisas e adicionar o que ta abaixo na entity do estudante;
        // private string $createdAt; -- banco
        // private string $modifiedAt; -- banco

        $academicRegistry = AcademicRegistryOV::generate();

        $contact = ContactEntity::create( $academicRegistry, $dto->getPhone(), $dto->getEmail() );

        $academicHistory = AcademicHistoryEntity::create( $academicRegistry, $dto->getCourseId() );

        $contact = $this->studentRepository->storeContact( $contact );
        $academicHistory = $this->studentRepository->storeAcademicHistory( $academicHistory );

        $student = StudentEntity::create( $dto->getName(), $academicRegistry );
        $student->setContact( $contact );
        $student->setAcademicHistory( $academicHistory );

        $student = $this->studentRepository->storeStudent( $student );

        return $student;
    }
}

?>