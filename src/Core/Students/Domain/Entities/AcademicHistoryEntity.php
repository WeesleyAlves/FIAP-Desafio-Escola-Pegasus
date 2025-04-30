<?php
namespace Src\Core\Students\Domain\Entities;


class AcademicHistoryEntity{
    private int $id;
    private string $studentAcademicRegistry;
    private string $courseId;
    private float $score;
    private float $frequency;

    /**
     * Get the value of studentAcademicRegistry
     */ 
    public function getStudentAcademicRegistry()
    {
        return $this->studentAcademicRegistry;
    }

    /**
     * Get the value of courseId
     */ 
    public function getCourseId()
    {
        return $this->courseId;
    }

    /**
     * Get the value of score
     */ 
    public function getScore()
    {
        return $this->score;
    }

    /**
     * Get the value of frequency
     */ 
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}


?>