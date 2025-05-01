<?php
namespace Src\Adapters\Driven\Database;

use PDO;
use Src\Core\Students\Domain\Entities\ContactEntity;
use Src\Core\Students\Domain\Entities\StudentEntity;
use Src\Core\Students\Domain\Entities\AcademicHistoryEntity;
use Src\Core\Students\Domain\OutputPorts\StudentsRepositoryPort;


class StudentsRepository implements StudentsRepositoryPort{
    public function __construct(private readonly PDO $pdo) {}

    /**
     * Armazena um novo estudante e retorna um estudante completo;
     *
     * @param StudentEntity $student
     * @return StudentEntity
     */
    public function storeStudent( StudentEntity $student ): StudentEntity{
        $stmt = $this->pdo->prepare("INSERT INTO students(academic_registry, name) VALUES ( ? , ? );");

        $created = $stmt->execute([
            $student->getAcademicRegistry(),
            $student->getName(),
        ]);

        if( $created ){
            $id = $this->pdo->lastInsertId();
            $student->setId( $id );

            $stmt = $this->pdo->prepare("SELECT created_at from students WHERE id = ?");
            $stmt->execute([ $id ]);
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $createdAt = $result['created_at'] ?? null;
            
            $student->setCreatedAt( $createdAt );
            $student->setModifiedAt( $createdAt );
        }

        return $student;
    }

    /**
     * Busca estudantes por nome;
     *
     * @return StudentEntity[]
     */
    public function searchStudentsByName( string $name ): array {
        $students = [];

        $stmt = $this->pdo->prepare("SELECT * from students WHERE name LIKE ? ORDER BY name");
        $stmt->execute([ '%'.$name.'%' ]);

        $results = $stmt->fetchAll();

        foreach ($results as $key => $student) {
            $students[] = StudentEntity::fromArray( $student );
        }

        return $students;
    }

    /**
     * Armazena um novo contato e retorna um contato completo;
     *
     * @param ContactEntity $contact
     * @return ContactEntity
     */
    public function storeContact( ContactEntity $contact ): ContactEntity {
        $stmt = $this->pdo->prepare("INSERT INTO students_contacts( academic_registry, phone, email ) VALUES ( ? , ? , ? );");

        $created = $stmt->execute([
            $contact->getStudentAcademicRegistry(),
            $contact->getPhone(),
            $contact->getEmail()
        ]);

        return $contact;
    }

    /**
     * Armazena um novo historico academico e retorna um completo
     *
     * @param AcademicHistoryEntity $academicHistory
     * @return AcademicHistoryEntity
     */
    public function storeAcademicHistory( AcademicHistoryEntity $academicHistory ): AcademicHistoryEntity {
        $stmt = $this->pdo->prepare('INSERT INTO students_academic_history(academic_registry, course_id, score, frequency) VALUES ( ? , ? , ? , ? );');

        $created = $stmt->execute([
            $academicHistory->getStudentAcademicRegistry(),
            $academicHistory->getCourseId(),
            $academicHistory->getScore(),
            $academicHistory->getFrequency(),
        ]);

        if( $created ){
            $id = $this->pdo->lastInsertId();
            $academicHistory->setId( $id );
        }

        return $academicHistory;
    }
}
?>