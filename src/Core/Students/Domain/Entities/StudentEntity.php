<?php
namespace Src\Core\Students\Domain\Entities;

use Src\Core\Students\Domain\Entities\ContactEntity;
use Src\Core\Students\Domain\Entities\AcademicHistoryEntity;


class StudentEntity{
    private int $id;
    private string $academicRegistry;
    private string $name;
    private string $createdAt;
    private string $modifiedAt;
    private ContactEntity $contact;
    private AcademicHistoryEntity $academicHistory;

    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Get the value of academicRegistry
     */ 
    public function getAcademicRegistry(){
        return $this->academicRegistry;
    }

    /**
     * Get the value of name
     */ 
    public function getName(){
        return $this->name;
    }

    /**
     * Get the value of createdAt
     */ 
    public function getCreatedAt(){
        return $this->createdAt;
    }

    /**
     * Get the value of modifiedAt
     */ 
    public function getModifiedAt(){
        return $this->modifiedAt;
    }

    /**
     * Get the value of contact
     */ 
    public function getContact(){
        return $this->contact;
    }

    /**
     * Get the value of academicHistory
     */ 
    public function getAcademicHistory(){
        return $this->academicHistory;
    }

    public static function create( string $name, string $academicRegistry ): self{
        $instace = new self();

        $instace->academicRegistry = $academicRegistry;
        $instace->name = $name;

        return $instace;
    }

    /**
     * Set the value of contact
     *
     * @return  self
     */ 
    public function setContact(ContactEntity $contact){
        $this->contact = $contact;

        return $this;
    }

    /**
     * Set the value of academicHistory
     *
     * @return  self
     */ 
    public function setAcademicHistory(AcademicHistoryEntity $academicHistory)
    {
        $this->academicHistory = $academicHistory;

        return $this;
    }
}

?>