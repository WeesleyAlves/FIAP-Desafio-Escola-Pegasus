<?php
namespace Src\Core\Students\Domain\OutputPorts;

use Src\Core\Students\Domain\Entities\ContactEntity;
use Src\Core\Students\Domain\Entities\StudentEntity;
use Src\Core\Students\Domain\Entities\AcademicHistoryEntity;

interface StudentsRepositoryPort {
    /**
     * Armazena um novo estudante e retorna um estudante completo;
     *
     * @param StudentEntity $student
     * @return StudentEntity
     */
    public function storeStudent( StudentEntity $student ): StudentEntity;

    /**
     * Armazena um novo contato e retorna um contato completo;
     *
     * @param ContactEntity $contact
     * @return ContactEntity
     */
    public function storeContact( ContactEntity $contact ): ContactEntity;

    /**
     * Armazena um novo historico academico e retorna um completo
     *
     * @param AcademicHistoryEntity $academicHistory
     * @return AcademicHistoryEntity
     */
    public function storeAcademicHistory( AcademicHistoryEntity $academicHistory ): AcademicHistoryEntity;
}

?>