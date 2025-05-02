<?php
namespace Src\Core\Students\Application\DTOs;


readonly class UpdateStudentDTO{
    private string $registryAcademic;
    private string $name;
    private string $phone;
    private string $email;

    public function __construct(
        string $registryAcademic,
        string $name,
        string $phone,
        string $email,
    ) {
        $this->registryAcademic = $registryAcademic;
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
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
     * Get the value of registryAcademic
     */ 
    public function getRegistryAcademic()
    {
        return $this->registryAcademic;
    }
}
?>