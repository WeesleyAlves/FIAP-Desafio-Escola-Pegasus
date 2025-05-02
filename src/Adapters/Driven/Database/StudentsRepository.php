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
            $stmt = $this->pdo->prepare("SELECT created_at from students WHERE academic_registry = ?");
            $stmt->execute([ $student->getAcademicRegistry() ]);
            
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

        // $sql = "SELECT * from students ORDER BY name";

        $sql = "SELECT 
                students.academic_registry, students.name, students.created_at, students_contacts.phone, students_contacts.email
            FROM 
                students
            INNER JOIN
                students_contacts
            ON 
                students.academic_registry = students_contacts.academic_registry ";
        
        if( $name ){
            $sql .= "WHERE students.name LIKE ? ";
        }

        $sql .= "ORDER BY students.name";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute( $name ? [ '%'.$name.'%' ] : []);

        $results = $stmt->fetchAll();

        foreach ($results as $key => $student) {
            $studentEntity = StudentEntity::fromArray( $student );

            $contactEntity = ContactEntity::create(
                $student['academic_registry'],
                $student['phone'],
                $student['email']
            );

            $studentEntity->setContact( $contactEntity );

            $students[] = $studentEntity;
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

    /**
     * Deleta estudante e seus dados com base no RA;
     * Rola um DELETE ON CASCADE no banco...
     *
     * @param string $registryAcademic
     * @return boolean
     */
    public function deleteStudent( string $registryAcademic ): bool {
        $stmt = $this->pdo->prepare( "DELETE FROM students WHERE academic_registry = ?" );
        $stmt->execute([$registryAcademic]);

        if( $stmt->rowCount() ){
            return true;
        }

        return false;
    }


    /**
     * Atualiza um estudante com base no RA;
     *
     * @param StudentEntity $student
     * @return ?StudentEntity
     */
    public function updateStudent( StudentEntity $student ): ?StudentEntity {
        $stmt = $this->pdo->prepare("UPDATE students SET name = ? WHERE students.academic_registry = ?");
        $stmt->execute([
            $student->getName(),
            $student->getAcademicRegistry(),
        ]);

        $contact = $student->getContact();
        $stmt = $this->pdo->prepare("UPDATE students_contacts SET phone = ?, email = ? WHERE students_contacts.academic_registry = ?");
        $stmt->execute([
            $contact->getPhone(),
            $contact->getEmail(),
            $student->getAcademicRegistry(),
        ]);

        return $student;
    }
}
?>