<?php

namespace Src\Core\Domain\Courses\Entities;


class CourseEntity {
    private $id;
    private $name;
    private $teacher;
    private $materials;
    private $schedule;

    public function __construct(){}


    /**
     * Get the value of id
     */ 
    public function getId(){
        return $this->id;
    }

    /**
     * Get the value of name
     */ 
    public function getName(){
        return $this->name;
    }

    /**
     * Get the value of teacher
     */ 
    public function getTeacher(){
        return $this->teacher;
    }

    /**
     * Get the value of materials
     */ 
    public function getMaterials(){
        return $this->materials;
    }

    /**
     * Get the value of schedule
     */ 
    public function getSchedule(){
        return $this->schedule;
    }

    public static function fromArray( array $data ){
        $instance = new self();

        $instance->id = isset($data['id']) ? $data['id'] : -1;
        $instance->name = isset($data['name']) ? $data['name'] : '';
        $instance->teacher = isset($data['teacher']) ? $data['teacher'] : '';
        $instance->materials = isset($data['materials']) ? $data['materials'] : '';
        $instance->schedule = isset($data['schedule']) ? $data['schedule'] : '';

        return $instance;
    }

    public function toArray(){
        return array(
            "id" => $this->id,
            "name" => $this->name,
            "teacher" => $this->teacher,
            "materials" => $this->materials,
            "schedule" => $this->schedule,
        );
    }
}

?>