<?php
namespace Src\Core\Students\Domain\Entities;


class ContactEntity {
    private string $studentAcademicRegistry;
    private string $phone;
    private string $email;

    /**
     * Get the value of phone
     */ 
    public function getPhone(){
        return $this->phone;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail(){
        return $this->email;
    }

    /**
     * Get the value of studentAcademicRegistry
     */ 
    public function getStudentAcademicRegistry(){
        return $this->studentAcademicRegistry;
    }

    public static function create( string $studentAcademicRegistry, string $phone, string $email ): self{
        $instace = new self();

        $instace->studentAcademicRegistry = $studentAcademicRegistry;
        $instace->email = $email;
        $instace->phone = $phone;

        return $instace;
    }
}

?>