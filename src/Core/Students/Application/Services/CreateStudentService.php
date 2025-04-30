<?php
namespace Src\Core\Students\Application\Services;

use Src\Core\Students\Domain\Entities\ContactEntity;
use Src\Core\Students\Domain\Entities\StudentEntity;
use Src\Core\Students\Domain\Entities\AcademicHistoryEntity;
use Src\Core\Students\Domain\ValueObjects\AcademicRegistryOV;
use Src\Core\Students\Application\InputPorts\CreateStudentServicePort;



class CreateStudentService implements CreateStudentServicePort{
    /**
     * Executa a criação e armazenamento de um estudante ao banco de dados;
     *
     * @param string $name
     * @param string $phone
     * @param string $email
     * @param integer $courseId
     * @return StudentEntity
     */
    public function execute( string $name, string $phone, string $email, int $courseId ): StudentEntity{        
        // TODO: adicionar conexão com o banco pra criar as coisas e adicionar o que ta abaixo na entity do estudante;
        // private string $createdAt; -- banco
        // private string $modifiedAt; -- banco

        $academicRegistry = AcademicRegistryOV::generate();

        $contact = ContactEntity::create( $academicRegistry, $phone, $email );

        $academicHistory = AcademicHistoryEntity::create( $academicRegistry, $courseId );

        $student = StudentEntity::create( $name, $academicRegistry );
        $student->setContact( $contact );
        $student->setAcademicHistory( $academicHistory );

        return $student;
    }
}
?>