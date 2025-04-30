<?php
namespace Src\Core\Students\Application\DTOs;


readonly class CreateStudentDTO{
    private string $name;
    private string $phone;
    private string $email;
    private int $courseId;

    public function __construct(
        string $name,
        string $phone,
        string $email,
        int $courseId,
    ) {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->courseId = $courseId;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Get the value of courseId
     */ 
    public function getCourseId()
    {
        return $this->courseId;
    }
}
?>